<?php
class CashierController extends ProfileController
{
	function actionTest()
	{
		$this->render('test');
	}
	
	function actionDeposit()
	{
		$model = new DepositForm; 
		if(Yii::app()->user->currency_id)
		{
			$currency = Currencies::model()->findByPk(Yii::app()->user->currency_id);
			$model->CurrencyCode = $currency->currency_name;
		}	
		
		$this->render('deposit', compact('model'));
	}
	
	function actionTransaction_history()
	{
		$transactions = Transactions::model()->findAll('user_id='.Yii::app()->user->id);
		$this->render('transaction_history', compact('transactions'));
	}
	
	function actionTransactions_deposit()
	{
		$transactions = Transactions::model()->findAll('user_id='.Yii::app()->user->id);
		$this->render('transactions_deposit', compact('transactions'));		
	}
	
	function actionTransactions_bonus()
	{
		$transactions = BonusToUsers::model()->findAll('user_id='.Yii::app()->user->id);
		$this->render('transactions_bonus', compact('transactions'));
	}
	
	function actionTransactions_deduction()
	{
		$transactions = DeductionToUsers::model()->findAll('user_id='.Yii::app()->user->id);
		$this->render('transactions_deduction', compact('transactions'));
	}
	
	function actionWithdrawal_history()
	{
		$requests = WithdrawalRequests::model()->findAll('user_id=:user_id', array(':user_id' => Yii::app()->user->id)); 
		$this->render('withdrawal_history', compact('requests'));
	}	
	
	function actionSendRequest()
	{
		$model = new DepositForm;
		$signature = $encodedMessage = null;
		if(isset($_POST['DepositForm']))
		{
			$model->attributes = $_POST['DepositForm'];
			if($model->validate())
			{   
				$TransactionId = intval( "11" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9). rand(0,9) ); //"11895305"; //
				$MerchantId="100000403"; //"100000xxx";
				$TerminalId="10000740"; //"100003xxx";
				$ApiPassword="tKS3#5&2";
				$private_key="Md0F1gm97sVGlLADcEpIyReq"; 
				$signature_key=trim($private_key.$ApiPassword.$TransactionId);
				$ApiPassword_encrypt= hash('sha256',$ApiPassword); //'d2418bc7bf1a83229917b7077bf427280bf416cf30145eba5b2fdc3d1a0213af'; //
 
				$xmlReq='<?xml version="1.0" encoding="UTF-8" ?>
				<TransactionRequest xmlns="https://www.lamdaprocessing.com/securePayments/direct/v1/processor.php">
				<Language>ENG</Language>
				<Credentials>
					<MerchantId>'.$MerchantId.'</MerchantId>
				    <TerminalId>'.$TerminalId.'</TerminalId>
				    <TerminalPassword>'.$ApiPassword_encrypt.'</TerminalPassword>
				</Credentials>
				<TransactionType>'.$model->TransactionType.'</TransactionType>
				<TransactionId>'. $TransactionId.'</TransactionId>
				<ReturnUrl page="http://eclipse-finance.com/profile/cashier/return">
						<Param>
							<Key>inv</Key>
							<Value>'.$TransactionId.'</Value>
						</Param>
				
				</ReturnUrl>
				<CurrencyCode>'.$model->CurrencyCode.'</CurrencyCode>
				<TotalAmount>'.$model->TotalAmount.'</TotalAmount>
				<VirtualCard>1</VirtualCard>
				<ProductDescription>'.$model->ProductDescription.'</ProductDescription>
				<CustomerDetails>
						<FirstName>'.$model->FirstName.'</FirstName>
						<LastName>'.$model->LastName.'</LastName>
						<CustomerIP>'.$_SERVER['REMOTE_ADDR'].'</CustomerIP>
						<Phone>'.$model->Phone.'</Phone>
						<Email>'.$model->Email.'</Email>
					</CustomerDetails>
					<BillingDetails>
						<CardPayMethod>'.$model->CardPayMethod.'</CardPayMethod>
						<FirstName>'.$model->FirstName.'</FirstName>
						<LastName>'.$model->LastName.'</LastName>
						<Street>'.$model->Street.'</Street>
						<City>'.$model->City.'</City>
						<Region>'.$model->Region.'</Region>
						<Country>'.$model->Country.'</Country>
						<Zip>'.$model->Zip.'</Zip>
					</BillingDetails>
					<CardDetails>
						<CardHolderName>'.$model->CardHolderName.'</CardHolderName>
						<CardNumber>'.$model->CardNumber.'</CardNumber>
						<CardExpireMonth>'.$model->CardExpireMonth.'</CardExpireMonth>
						<CardExpireYear>'.$model->CardExpireYear.'</CardExpireYear>
						<CardType>'.$model->CardType.'</CardType>
						<CardSecurityCode>'.$model->CardSecurityCode.'</CardSecurityCode>
						<CardIssuingBank>UNKNOWN</CardIssuingBank>
						<CardIssueNumber></CardIssueNumber>
					</CardDetails>      
				</TransactionRequest>'; //var_dump($xmlReq); exit; 
				$signature=base64_encode(hash_hmac("sha256", trim($xmlReq), $signature_key, True));
				$encodedMessage=base64_encode($xmlReq);				
			}
			else 
			{
				//var_dump($model->getErrors()); 
			}
		}	
		 
		$this->render('request', compact('xmlReq', 'signature', 'encodedMessage'));
	}
	
	function actionReturn()
	{
		if (!isset($HTTP_RAW_POST_DATA))
			$HTTP_RAW_POST_DATA = file_get_contents("php://input");
		
		$data = $this->parseString($HTTP_RAW_POST_DATA);
		$lec_encodedMessage = $data['encodedMessage'];
		$lec_decodedMessage = base64_decode($lec_encodedMessage);
		
		libxml_use_internal_errors(false);
		$xml = simplexml_load_string($lec_decodedMessage);
		//var_dump($xml); 
		//1001   
		if($xml) 
		{
			$xml->TotalAmount/=100;
			if(intval($xml->Code) == 1001)
			{ 
				$user = Users::model()->findByPk(Yii::app()->user->id);
				$user->balance+=$xml->TotalAmount;
				$user->deposit+=$xml->TotalAmount;
				if(!$user->deposit_first)
					$user->deposit_first = $xml->TotalAmount;
				if(!$user->currency_id)
				{
					if($currency = Currencies::model()->find('currency_name=:currency_name', array(':currency_name' => $xml->CurrencyCode)))
						$user->currency_id = $currency->currency_id;
				}
				$user->save(false);
				
				$transaction = new Transactions;
				$transaction->user_id = $user->user_id;
				$transaction->timestamp = time();
				$transaction->deposit_type = 1;
				$transaction->amount = $xml->TotalAmount;
				//$transaction->processing_reason_code = $pg_response['PROCESSING_REASON_CODE'];
				$transaction->save(false); 
				//var_dump($pg_response);
				Yii::app()->user->setFlash('success', $xml->Description);
				$this->refresh();		
			}
			else 
				Yii::app()->user->setFlash('error', $xml->Description);
		} 
		
		$this->render('return', compact('xml'));
	}
	
	function parseString($str) {
		$op = array();
		$pairs = explode("&", $str);
		foreach ($pairs as $pair) {
			list($k, $v) = array_map("urldecode", explode("=", trim($pair)));
			$op[$k] = $v;
		}
		return $op;
	}	
	
	
	function actionTest2()
	{
		$TransactionId = intval( "11" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9). rand(0,9) );
		$MerchantId="100000xxx";
		$TerminalId="100003xxx";
		$ApiPassword="Lgq/.xx";
		$private_key="Zir54ghlfsBAUMFNLOTxxxx";
		$signature_key=trim($private_key.$ApiPassword.$TransactionId);
		$ApiPassword_encrypt=hash('sha256',$ApiPassword);
		if(!isset($_POST['VirtualCard'])){$_POST['VirtualCard']='0';}
		
		$xmlReq='<?xml version="1.0" encoding="UTF-8" ?>
			<TransactionRequest xmlns="https://test.lamdaprocessing.com/api/direct/v1/processor">
			<Language>ENG</Language>
			<Credentials>
				<MerchantId>'.$MerchantId.'</MerchantId>
			    <TerminalId>'.$TerminalId.'</TerminalId>
			    <TerminalPassword>'.$ApiPassword_encrypt.'</TerminalPassword>
			</Credentials>
			<TransactionType>'.$_POST['TransactionType'].'</TransactionType>
			<TransactionId>'. $TransactionId.'</TransactionId>
			<ReturnUrl page="http://eclipse-finance.com/profile/cashier/return">
					<Param> 
						<Key>inv</Key>
						<Value>'.$TransactionId.'</Value>
					</Param>
					
			</ReturnUrl>
			<CurrencyCode>'.$_POST['CurrencyCode'].'</CurrencyCode>
			<TotalAmount>'.$_POST['TotalAmount'].'</TotalAmount>
			<VirtualCard>1</VirtualCard>
			<ProductDescription>'.$_POST['ProductDescription'].'</ProductDescription>
			<CustomerDetails>
					<FirstName>'.$_POST['FirstName'].'</FirstName>
					<LastName>'.$_POST['LastName'].'</LastName>
					<CustomerIP>'.$_SERVER['REMOTE_ADDR'].'</CustomerIP>
					<Phone>'.$_POST['Phone'].'</Phone>
					<Email>'.$_POST['Email'].'</Email>
				</CustomerDetails>
				<BillingDetails>
					<CardPayMethod>'.$_POST['CardPayMethod'].'</CardPayMethod>
					<FirstName>'.$_POST['FirstName'].'</FirstName>
					<LastName>'.$_POST['LastName'].'</LastName>
					<Street>'.$_POST['Street'].'</Street>
					<City>'.$_POST['City'].'</City>
					<Region>'.$_POST['Region'].'</Region>
					<Country>'.$_POST['Country'].'</Country>
					<Zip>'.$_POST['Zip'].'</Zip>
				</BillingDetails>
				<CardDetails>
					<CardHolderName>'.$_POST['CardHolderName'].'</CardHolderName>
					<CardNumber>'.$_POST['CardNumber'].'</CardNumber>
					<CardExpireMonth>'.$_POST['CardExpireMonth'].'</CardExpireMonth>
					<CardExpireYear>'.$_POST['CardExpireYear'].'</CardExpireYear>
					<CardType>'.$_POST['CardType'].'</CardType>
					<CardSecurityCode>'.$_POST['CardSecurityCode'].'</CardSecurityCode>
					<CardIssuingBank>UNKNOWN</CardIssuingBank>
					<CardIssueNumber></CardIssueNumber>
				</CardDetails>
					
					
			</TransactionRequest>';
		$signature=base64_encode(hash_hmac("sha256", trim($xmlReq), $signature_key, True));
		$encodedMessage=base64_encode($xmlReq);		
 
		$this->render('test2', compact('signature', 'encodedMessage'));
	}
	
	
	function actionWithdraw($scenario='bank_wire')
	{
		if(!in_array($scenario, $scenarios = array(1 => 'bank_wire', 2 => 'credit_card', 3 => 'other')))
			throw new CHttpException(404,'Page not found.');

		$model = new WithdrawalRequests; 
		$model->scenario = $model->payment_method = $scenario; 
		
		if(isset($_POST['WithdrawalRequests']))
		{
			$model->attributes = $_POST['WithdrawalRequests']; 
			$model->payment_method_id = array_search($scenario, $scenarios); 
			if($model->validate())
			{
				$model->timestamp = time();
				$model->user_id = Yii::app()->user->id;
				$model->status_id = 1; //pending
				$model->save(); 
				Yii::app()->user->setFlash('success', 'Your request is being processed');
				$this->refresh();
			}
		} 

		$this->render('withdraw', compact('model'));
	}
}