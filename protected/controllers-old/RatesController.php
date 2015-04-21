<?php
class RatesController extends Controller
{
	function beforeAction($action)
	{	
		if(parent::beforeAction($action))
		{
			date_default_timezone_set("UTC");
		}
		return true; 
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionRatesStatistics($symbol)
	{
		if(Yii::app()->request->isAjaxRequest)
		{		
			$st = RatesClosed::model()->getStatistics($symbol); 
			echo CJSON::encode($st); 
		}
	}
	
	function actionTest() 
	{
	}
	
	function actionTime()
	{
		date_default_timezone_set("UTC");
		echo CJSON::encode(array(
			'datetime' => time() * 1000 //microseconds
		)); 		
	}
	
	function actionCheck($rate_id)
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			if($rate = RatesClosed::model()->getByRateId($rate_id)) //Rates findByPk
			{
				echo CJSON::encode($rate); 
				Yii::app()->end(); 	
			}
		}
	}
	
	public function actionGetBalance()
	{
		if($model = Users::model()->findByPk(Yii::app()->user->id))
		{
			echo CJSON::encode(array(
				'status' => 'OK',
				'value' => $model->balance
			));
			Yii::app()->end(); 
		}
		echo CJSON::encode(array('status' => 'ERR'));
	}
	
	function actionSetBalance($value)
	{
		if($user = Users::model()->findByPk(Yii::app()->user->id))
		{
			$user->balance = $value; 
			$user->save();
			echo CJSON::encode(array('status' => 'OK'));
			Yii::app()->end(); 
		}
		echo json_encode(array('status' => 'ERR')); 
	}
	
	function actionAdd()
	{ 
		date_default_timezone_set("UTC");
		$rateData = CJSON::decode($_POST['rateData'], false);
		$rates = new Rates;
		$rates->user_id 		= Yii::app()->user->id;
		$rates->rate_currency 	= $rateData->currency; 
		$rates->rate_type 		= $rateData->type; 
		$rates->rate_value 		= $rateData->price;
		$rates->strike_value 	= $rateData->strike;
		$rates->rate_start_time = time();
		$rates->rate_end_time 	= intval($rateData->expires);
		if(in_array($rateData->expires / 60, array(1, 2, 5))) //1, 2 , 5 minutes period
			$rates->rate_end_time = time() + intval($rateData->expires);
		
		if(Yii::app()->user->inRMGroup())
			$rateData->type == 'above' ? $rates->strike_value += Globals::RMValue : $rates->strike_value -= Globals::RMValue;		
		
		if($rates->save(false))
		{ 
			$user = Users::model()->findByPk(Yii::app()->user->id);
			$user->balance-= $rates->rate_value;
			$user->save(false);
			
			echo CJSON::encode(array(
				'status' => 'OK',
				'balance' => $user->balance,
				'row' => array(array(
					'rate_id' 		   => $rates->rate_id,
					'currency' 		   => $rates->rate_currency,
					'type' 			   => $rates->rate_type,
					'rate' 			   => $rates->strike_value,
					'rate_date'		   => date('d-m-Y H:i:s', $rates->rate_start_time),
					'rate_timestamp'   => $rates->rate_start_time, 
					'expiry_date' 	   => date('d-m-Y H:i:s', $rates->rate_end_time),
					'expiry_timestamp' => $rates->rate_end_time,
					'priceValue' 	   => $rates->rate_value,
					'returnValue' 	   => $rates->rate_value * 1.85
				))
			));
			Yii::app()->end(); 
		}
		echo json_encode(array('status' => 'ERR')); 
	}
	
	function actionClosed()
	{
		if(Yii::app()->request->isAjaxRequest)
		{		
			$criteria=new CDbCriteria();
			$criteria->order = 'rate_end_time DESC';
			//$criteria->condition = 'user_id=:user_id AND status IN(2,3,4)';
			$criteria->condition = 'user_id=:user_id';
			$criteria->params = array(':user_id' => Yii::app()->user->id);
			$count=RatesClosed::model()->count($criteria);
			$pages=new CPagination($count);
			
			// results per page
			$pages->pageSize=10;
			$pages->applyLimit($criteria);
			$rates=RatesClosed::model()->findAll($criteria);
					
			$this->renderPartial('closed', compact('rates', 'pages', 'statuses'));
		}
		else
			throw new CHttpException(404,'The specified post cannot be found.');
	}
	
	function actionOpened()
	{
		$model = Rates::model()->findAll('user_id=:user_id AND status IN(0,1)', array(':user_id' => Yii::app()->user->id)); 
		$rows = array(); 
		if($model)
		{
			foreach($model as $row)
			{
				$rows[] = array(
					'rate_id' 		   => $row->rate_id,
					'currency' 		   => $row->rate_currency,	
					'type' 			   => $row->rate_type,
					'rate' 			   => $row->strike_value,
					'rate_date'		   => date('d-m-Y H:i:s', $row->rate_start_time),
					'rate_timestamp'   => $row->rate_start_time,
					'expiry_date' 	   => date('d-m-Y H:i:s', $row->rate_end_time),
					'expiry_timestamp' => $row->rate_end_time,
					'priceValue' 	   => $row->rate_value,
					'returnValue' 	   => $row->rate_value * 1.85					
				);
			}
		}
		echo CJSON::encode(array('rows' => $rows));
	}
	
	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}


// class AsyncOperation extends Thread {

// 	public function __construct($arg) {


// 		$this->time = $arg;
// 	}

// 	public function run() {
// 		if ($this->time) 
// 		{
// 			while(true)
// 			{
// 				if(time() >= $this->time)
// 				{
// 					$link = mysql_connect('localhost', 'root', '');
// 					mysql_select_db('moon', $link) or die('Could not select database.');
	
// 					if(mysql_query("INSERT INTO test (thread_id, test, date_str) VALUES (".Thread::getCurrentThreadId().", 'test', '".date('d-m-Y', $this->time)."')"))
// 						echo 1;
// 					else
// 						var_dump(mysql_error());	
					
// 					break; 
// 				}
// 				sleep(100);
// 			}
// 		}
// 	}
// }