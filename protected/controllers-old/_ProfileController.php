<?php

class ProfileController extends SiteController
{
	
	function beforeAction($action)
	{
		if (Yii::app()->user->isGuest)
		{
			if($action->id == 'index')
				$this->redirect($this->createUrl('user/registration'));
			Yii::app()->user->loginRequired();
		}
		
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery.fileupload-ui.css');
	
		return parent::beforeAction($action);
	}	
	
	public function actionIndex()
	{
		$model = Users::model()->findByPk(Yii::app()->user->id);
		$model->scenario = 'profile';
		
		if(isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
				
			if($model->validate())
			{
				if($cUploadedFile = CUploadedFile::getInstance($model,'scan'))
					$model->scan = $cUploadedFile;
		
				if($model->save())
				{
					if($cUploadedFile)
						$cUploadedFile->saveAs('uploads/scans/'.$cUploadedFile);
		
					Yii::app()->user->setFlash('success', '<strong>Success!</strong> Saved.');
					$this->refresh();
				}
			}
		}		
		
		$this->render('index', compact('model'));
	}
	
	function actionlogin()
	{
		$user = Users::model()->findByPk(Yii::app()->user->id);
		$model = new ChangePasswordForm;
		if(isset($_POST['ChangePasswordForm']))
		{
			$model->attributes = $_POST['ChangePasswordForm'];
			if($model->validate())
			{
				$user = Users::model()->findByPk(Yii::app()->user->id);
				$user->user_password = CPasswordHelper::hashPassword($model->passwordNew);
				$user->save();
		
				Yii::app()->user->setFlash('success', 'Password updated');
				$this->refresh();
			}
		}
				
		$this->render('login', compact('model'));
	}
	
	function actionCustomer()
	{  
		$pg_url = "https://test.solidpayments.net/frontend/payment.prc"; 
		$model = new CustomerRegistrationForm;
		if($_POST['CustomerRegistrationForm'])
		{
			$model->attributes = $_POST['CustomerRegistrationForm'];
			$model->IDENTIFICATION_TRANSACTIONID = microtime(TRUE); 
			//$model->CONTACT_IP = $_SERVER['REMOTE_ADDR']; 
			if($model->validate())
			{
				$params = $model->createParams(); //var_dump($params); 
				$ch = curl_init();
				
				curl_setopt($ch, CURLOPT_URL, $pg_url);
				curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Tester');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // This is only for testing, make sure you have the SSL connection verified when in production!
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
				// PG expect UTF-8 encoding
				curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
						));
				
				$curl_result = curl_exec($ch); // Call PG
				
				$curl_error = curl_error($ch); // Collect errors
				$curl_info = curl_getinfo($ch);
				curl_close($ch);
				
				// Debug CURL
				var_dump('ERROR', $curl_error);
				var_dump('INFO', $curl_info);
				var_dump('RESULT', $curl_result);
				
				// Parse the response from payment gateway
				parse_str($curl_result,$pg_response);
				var_dump('RESPONSE', $pg_response); 
				// TOKEN will be in $pg_response['IDENTIFICATION_UNIQUEID'];
				
				// Make sure the transaction was successful with no errors (see POST_Transactions docs for error codes etc)
				
				echo $pg_response['PROCESSING_REASON'];				
				
			}
		}
		$this->render('customer', compact('model'));
	}

	function actionPayout()
	{
		$pg_url = "https://test.solidpayments.net/frontend/payment.prc";
		$model = new PaymentForm; 
		if(isset($_POST['PaymentForm']))
		{
			$model->attributes = $_POST['PayoutForm'];
			if($model->validate())
			{
				$params = $model->createParams(); //var_dump($params);
				$ch = curl_init();
				
				curl_setopt($ch, CURLOPT_URL, $pg_url);
				curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Tester');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // This is only for testing, make sure you have the SSL connection verified when in production!
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
				// PG expect UTF-8 encoding
				curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
				));
				
				$curl_result = curl_exec($ch); // Call PG
				
				$curl_error = curl_error($ch); // Collect errors
				$curl_info = curl_getinfo($ch);
				curl_close($ch);
				
				// Debug CURL
				var_dump($curl_error);
				var_dump($curl_info);
				var_dump($curl_result);
				
				// Parse the response from payment gateway
				parse_str($curl_result,$pg_response);
				
				echo $pg_response['PROCESSING_REASON'];				
			}			
		}
		
		$this->render('payout', compact('model'));
	}
	
	function actionRates()
	{
		$criteria=new CDbCriteria();
		$criteria->order = 'rate_end_time DESC';
		$criteria->condition = 'user_id=:user_id';
		$criteria->params = array(':user_id' => Yii::app()->user->id);
		$count=RatesClosed::model()->count($criteria);
		$pages=new CPagination($count);
			
		// results per page
		$pages->pageSize=15;
		$pages->applyLimit($criteria);
		$rates=RatesClosed::model()->findAll($criteria);
				
		$this->render('rates', compact('rates', 'pages', 'statuses')); 
	}
	
	function actionCashier()
	{
		$this->render('cashier');
	}
	
	function actionDeposit()
	{
		// The payment gateway URL
		$pg_url = "https://test.solidpayments.net/frontend/payment.prc";
		
		// Debug POST
		//echo serialize($_POST);
		
		if(isset($_POST['regform'])){
		
			// POST parameters
			$params=array(
					"REQUEST.VERSION"=>"1.0",
		
					"SECURITY.SENDER"=>'',
		
					"USER.LOGIN"=>'',
					"USER.PWD"=>'',
		
					"TRANSACTION.CHANNEL"=>'',
		
					"TRANSACTION.MODE"=>'INTEGRATOR_TEST',
					"TRANSACTION.RESPONSE"=>'SYNC',
					"IDENTIFICATION.TRANSACTIONID"=>microtime(TRUE), // microtime is not unique-proof when you have parallell transactions so make sure to change it in production
		
					"PAYMENT.CODE"=>'CC.RG',
		
					"NAME.GIVEN"=>'Joe',
					"NAME.FAMILY"=>'Doe',
		
					"ADDRESS.STREET"=>'Leopoldstr. 1',
					"ADDRESS.ZIP"=>'80798',
					"ADDRESS.CITY"=>'München',
					"ADDRESS.STATE"=>'BY',
					"ADDRESS.COUNTRY"=>'DE',
		
					"CONTACT.EMAIL"=>'info@provider.com',
					"CONTACT.IP"=>'123.123.123.123',
		
					"ACCOUNT.HOLDER"=>'Joe Doe',
					"ACCOUNT.NUMBER"=>$_POST['ccnumber'],
					"ACCOUNT.BRAND"=>'VISA',
					"ACCOUNT.EXPIRY_MONTH"=>'12',
					"ACCOUNT.EXPIRY_YEAR"=>'2013',
					"ACCOUNT.VERIFICATION"=>'123'
		
			);
			var_dump($params); 
		
			// Actuall call to payment gateway
			$ch = curl_init();
		
			curl_setopt($ch, CURLOPT_URL, $pg_url);
			curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Tester');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // This is only for testing, make sure you have the SSL connection verified when in production!
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			// PG expect UTF-8 encoding
			curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
					));
		
			$curl_result = curl_exec($ch); // Call PG
		
			$curl_error = curl_error($ch); // Collect errors
			$curl_info = curl_getinfo($ch);
			curl_close($ch);
		
			// Debug CURL
			//var_dump($curl_error);
			//var_dump($curl_info);
			//var_dump($curl_result);
		
			// Parse the response from payment gateway
			parse_str($curl_result,$pg_response);
			var_dump($pg_response); 
			// TOKEN will be in $pg_response['IDENTIFICATION_UNIQUEID'];
		
			// Make sure the transaction was successful with no errors (see POST_Transactions docs for error codes etc)
		
			echo $pg_response['PROCESSING_REASON'];
		
		} // if post
				
		$this->render('deposit');
	}
	
	function actionWithdraw()
	{

		// The payment gateway URL
		$pg_url = "https://test.solidpayments.net/frontend/payment.prc";
		
		// Debug POST
		//echo serialize($_POST);
		
		if(isset($_POST['payform'])){
		
			// POST parameters
			$params=array(
					"REQUEST.VERSION"=>"1.0",
		
					"SECURITY.SENDER"=>'',
		
					"USER.LOGIN"=>'',
					"USER.PWD"=>'',
		
					"TRANSACTION.CHANNEL"=>'',
		
					"TRANSACTION.MODE"=>'INTEGRATOR_TEST',
					"TRANSACTION.RESPONSE"=>'SYNC',
					"IDENTIFICATION.TRANSACTIONID"=>microtime(TRUE),
		
					"PAYMENT.CODE"=>'CC.DB',
		
					"PRESENTATION.AMOUNT"=>$_POST['amount'],
					"PRESENTATION.CURRENCY"=>'USD',
					"PRESENTATION.USAGE"=>'Test payment',
					"ACCOUNT.REGISTRATION"=>$_POST['uniqueid'] // IDENTIFICATION.UNIQUEID in registration response
			); 
		
			// Actuall call to payment gateway
			$ch = curl_init();
		
			curl_setopt($ch, CURLOPT_URL, $pg_url);
			curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Tester');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // This is only for testing, make sure you have the SSL connection verified when in production!
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			// PG expect UTF-8 encoding
			curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
					));
		
			$curl_result = curl_exec($ch); // Call PG
		
			$curl_error = curl_error($ch); // Collect errors
			$curl_info = curl_getinfo($ch);
			curl_close($ch);
		
			// Debug CURL
			var_dump($curl_error);
			var_dump($curl_info);
			var_dump($curl_result);
		
			// Parse the response from payment gateway
			parse_str($curl_result,$pg_response);
		
			echo $pg_response['PROCESSING_REASON'];
		
		} // if post		
		$this->render('withdraw');
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