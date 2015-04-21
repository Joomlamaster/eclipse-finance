<?php 
error_reporting(E_ALL ^ E_NOTICE); 
date_default_timezone_set("UTC");
//ignore_user_abort(1);
set_time_limit(0);
/*
 *  statuses:
 *  	0 - rate is open(new)
 *  	1 - rate processing (thred is running)
 * 		2 - rate is closed and fail 
 * 	    3 - rate is closed and won
 * 		4 - !won !fail (strike == REST)
 * 		5, 6, 7 - error occurred
 */

//main config(DB, etc)
include( dirname(__FILE__).'/daemonConfig.php' );
//mysqli adapter
include( dirname(__FILE__).'/connector.php' ); 
//logs
include( dirname(__FILE__).'/logger.php' );
include( 'test.php' );

/* MODELS */ 
class Users extends DB
{
	public function getUser($user_id)
	{ 
		$result = self::query("SELECT * FROM users WHERE user_id={$user_id}");
		if( $result )  
		{   
			return $result->fetch_object();
		}  
		return false;    
	}  
	
	public function replenishBalance($user_id, $value)
	{ 
		return self::query("UPDATE users SET balance=balance + ".round($value)." WHERE user_id={$user_id}");
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}		
}

class Rates extends DB
{
	public function deleteById($rate_id)
	{
		return self::query("DELETE FROM rates WHERE rate_id={$rate_id}"); 
	}
	
	public function updateStatus($statusValue)
	{	
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	
}

class RatesClosed extends DB
{
	public function save($data = array())
	{
		$fieldNames = $fieldValues = array(); 
		foreach($data as $fieldName => $fieldValue)
		{
			$fieldNames[] = $fieldName; 
			$fieldValues[] = $fieldValue;
		}
		return self::query('INSERT INTO rates_closed ('.implode(',', $fieldNames).') VALUES (\''.implode("','", $fieldValues).'\')'); 
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	
}

/* MODELS END */
@file_put_contents(__DIR__ . '/daemonCron.txt', '['.date("d-m-Y G:i:sa").'] ' . "\r\n", FILE_APPEND);    
 
$result = DB::query(
	'SELECT * FROM rates 
		WHERE (rate_end_time - '.time().') <= 40 AND status=0'
);  
if($result) 
{   
	$stack = $rateIds = array();
	while($rate = $result->fetch_object())
	{
		$rateIds[] = $rate->rate_id;
		$stack[] = new RateHandler($rate);				 	
	}
	if( $rateIds ) //меняем статусы для ставок, чтобы не запускать потоки повторно
	{
		DB::query('UPDATE rates SET status=1 WHERE rate_id IN ('.implode(',', $rateIds).')');
		foreach($stack as $work)
			$work->start(); //запуск отсчета закрытия ставки
	}				
}


 
class RateHandler extends Thread
{
	function __construct($rate)
	{
		$this->rate = $rate;
	}
 
	function run()
	{   
		while(true) 
		{
			if($this->rate->rate_end_time <= time()) //ждем пока не пришло время закрыть ставку
			{
				//не закрывать ставку если разница во времени больше CLOSE_TIME_DIFFERENCE
				if((time() - $this->rate->rate_end_time) > CLOSE_TIME_DIFFERENCE)
				{
					Logger::error('RATE (rate_id '.$this->rate->rate_id.') DIFFERENCE MORE THAN ' . CLOSE_TIME_DIFFERENCE);
					Users::model()->replenishBalance($this->rate->user_id, $this->rate->rate_value);
					$this->closeRate(array(
						'status' => 8, //error
					)); 					
					die(); 
				}
				$service_url = 'http://104.238.118.236:8080/webservice/rest/events.json?event=Quote&symbol='.$this->rate->rate_currency.'&indent=';
				$curl = curl_init($service_url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$curl_response = curl_exec($curl);
				if ($curl_response === false) {
					$info = curl_getinfo($curl);
					curl_close($curl);
					Logger::error('error occured during curl exec. Additioanl info: ' . var_export($info)); //money back!!!!!!!!!!!1
					Users::model()->replenishBalance($this->rate->user_id, $this->rate->rate_value);
					$this->closeRate(array(
						'status' => 9, //error
					));					
					die('error occured during curl exec. Additioanl info: ' . var_export($info));
				} 
				curl_close($curl);
				$decoded = json_decode($curl_response);
				if($decoded) {
					if($decoded->status == "OK"){
						
						$askPrice = $decoded->Quote->{$this->rate->rate_currency}->askPrice; 
      						$bidPrice = $decoded->Quote->{$this->rate->rate_currency}->bidPrice; 
      						$mid = ($askPrice + $bidPrice) / 2; 
					}
					else{
						Logger::error('No symbol events:' . $this->rate->rate_currency);
						Users::model()->replenishBalance($this->rate->user_id, $this->rate->rate_value);
						$this->closeRate(array(
							'status' => 10, //error
						));
						die;
					}
				//if($events = $decoded->events)
					//{
				//		if($event = array_shift($events))
				//		{
				//			$mid = ($event->askPrice + $event->bidPrice) / 2;
				//		}
				//	} else {
				//		Logger::error('No symbol events:' . $this->rate->rate_currency);
				//		Users::model()->replenishBalance($this->rate->user_id, $this->rate->rate_value);
				//		$this->closeRate(array(
				//			'status' => 10, //error
				//		));
				//		die;
				//	}					
					
					
// 					$quote = $decoded->{$this->rate->rate_currency}->Quote;
// 					$mid = ($quote->askPrice + $quote->bidPrice) / 2; 
				} else {
					Logger::error('No currency:' . $this->rate->rate_currency);
					Users::model()->replenishBalance($this->rate->user_id, $this->rate->rate_value);
					$this->closeRate(array(
						'status' => 11, //error
					));
					die; 					
				}
				
				$won = $draw = false; 
				$status = 2; //fail default 
				if(
					($this->rate->strike_value < $mid && $this->rate->rate_type == 'above') || 
					($this->rate->strike_value > $mid && $this->rate->rate_type == 'below')
				) 
				{
					$won = true;
					$status = 3; //status win
				}
				else if($this->rate->strike_value == $mid)
				{
					$draw = true;
					$status = 4;
				}	
				$this->closeRate(array(
					'status' => $status,
					'expiration_value' => $mid
				)); 
	
				if($status === 3 || $status === 4) //if won - update balance
				{  
					$r = $status === 3 ? 1.85 : 1; 
					Users::model()->replenishBalance($this->rate->user_id, $r * $this->rate->rate_value); 				
				} 
				Logger::info('Ставка #'.$this->rate->rate_id.' Значение через REST API '.$mid);
				Logger::info('Ставка #'.$this->rate->rate_id.' закрыта в '.date("d-m-Y G:i:sa").'('.date("d-m-Y G:i:sa", $this->rate->rate_end_time).')'); 
				break;
			}
			sleep(1);
		}
	}  
	
	function closeRate($params = array())
	{
		$defaults = array(
			'rate_id' 		   => $this->rate->rate_id,
			'rate_currency'    => $this->rate->rate_currency,
			//'symbol_id'		   => $this->rate->symbol_id,
			'user_id' 		   => $this->rate->user_id,
			'status' 		   => null,
			'rate_value' 	   => $this->rate->rate_value,
			'strike_value' 	   => $this->rate->strike_value ,
			'expiration_value' => null,
			'rate_start_time'  => $this->rate->rate_start_time,
			'rate_end_time'    => $this->rate->rate_end_time,
			'rate_type' 	   => $this->rate->rate_type			
		); 
		$result = RatesClosed::model()->save(array_merge($defaults, $params));
		if( $result )
			Rates::model()->deleteById($this->rate->rate_id);	
	}
}