<?php 
date_default_timezone_set("UTC");
/*
$now = time();
$need = mktime(date("H"), date("i") + 1, 0, date("n"), date("j"), date("Y"));
$diff = $need - $now;// - 1;
sleep($diff);     
*/
//main config(DB, etc)
include( dirname(__FILE__).'/daemonConfig.php' );
//mysqli adapter
include( dirname(__FILE__).'/connector.php' ); 
//logs
include( dirname(__FILE__).'/logger.php' ); 
/*
if(!array_key_exists('SHLVL', $_SERVER))
{
	die('access denied'); 
} 

*/
/*** model USERS ****/
class Users extends DB
{
	function getAll()
	{
		return self::query('SELECT * FROM users'); 
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	
}

class Symbols extends DB
{
	public function getAll()
	{    
		$r = self::query('SELECT * FROM symbols');  
		if( $r )
			return $r->fetch_all (MYSQLI_ASSOC); 
		return array(); 
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	
}

class SymbolHistory extends DB
{
	public function save($data)
	{
		return self::query(
			"INSERT INTO symbol_history (symbol_id, timestamp, symbol_value) 
			 VALUES ('{$data['symbol_id']}', '{$data['timestamp']}', '{$data['symbol_value']}')"
		); 
		
	}
	
	public function deleteOld()
	{
		//delete older than 7 days
		return self::query(
			"DELETE FROM symbol_history WHERE timestamp < ".(time()-604800)
		);
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	
}

/* new 

class SymbolData extends DB
{
	public static function getLastPoint($symbol_id)
	{
		$result = self::query("SELECT * FROM symbol_data WHERE symbol_id={$symbol_id} ORDER BY `timestamp` DESC LIMIT 1");
		if( $result )
		{
			return $result->fetch_object();
		}
		return false;
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}*/
/* / */
//delete older than 7 days
SymbolHistory::model()->deleteOld(); 

class SymbolsWorker extends Worker
{
	function run()
	{     
		$symbols = Symbols::model()->getAll();   
		$symbolThreads = array(); 
		foreach($symbols as $symbol)
		{ 
			$symbolThreads[] = new SymbolThread($symbol);
		}
		foreach($symbolThreads as $t)
		{
			$t->start(); 
		}
	}
}

$symbols = new SymbolsWorker;
$symbols->start();

class SymbolThread extends Thread
{
	function __construct($storage)
	{  
		$this->storage = $storage; 
	}
	
	function run()
	{  
		Logger::log('this is symbolThread', 'run symbolThread');
		$res = false; 
		$service_url = 'http://104.238.118.236:8080/webservice/rest/events.json?event=Quote&symbol='.$this->storage['symbol'].'&indent';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			Logger::error('SYMBOLS: error occured during curl exec. Additioanl info: ' . var_export($info));
			die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}
		curl_close($curl);
		$decoded = json_decode($curl_response); // var_dump($decoded);
		
		if($decoded) {
			Logger::log('this is symbolThread', 'if decode');
			if($decoded->status == "OK")
			{	
				Logger::log('this is symbolThread', 'events: ' . $this->storage['symbol'] );
				$askPrice = $decoded->Quote->{$this->storage['symbol']}->askPrice; 
      			$bidPrice = $decoded->Quote->{$this->storage['symbol']}->bidPrice; 
      			$res = ($askPrice + $bidPrice) / 2; 
			} else {
				Logger::log('this is symbolThread', 'not events');
				Logger::error('No currency:' . $symbol);
				die;
			}
			
			/*if($events = $decoded->events)
			{	
				Logger::log('this is symbolThread', 'events');
				if($event = array_shift($events))
				{
					$res = ($event->askPrice + $event->bidPrice) / 2;
				}
			} else {
				Logger::log('this is symbolThread', 'not events');
				Logger::error('No currency:' . $symbol);
				die;
			} */
		} else {
			
			Logger::error('No currency:' . $this->storage['symbol']);
		}	 
		if($res) 
		{	Logger::log('this is symbolThread', ' my res');
			SymbolHistory::model()->save(array(
				'symbol_id' => $this->storage['symbol_id'],
				'timestamp' => round(time()/60) * 60,
				'symbol_value' => (float)number_format($res, 5, '.', '')
			));
		} 
	}
}
 




?>