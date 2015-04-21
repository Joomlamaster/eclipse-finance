<?php 
class PaymentForm extends CFormModel
{
	public $REQUEST_VERSION = "1.0";
	
	public $SECURITY_SENDER = 'ff80808141e49f6b014208ac912a2e2b';
	
	public $USER_LOGIN = 'ff80808141e49f6b014208ac912b2e2f';
	public $USER_PWD = 'bQXS72Bb';
	
	public $TRANSACTION_CHANNEL ='ff80808141e49f6b014208ad17e22e31';
	
	public $TRANSACTION_MODE = 'INTEGRATOR_TEST';
	public $TRANSACTION_RESPONSE = 'SYNC';
	public $IDENTIFICATION_TRANSACTIONID;
	
	public $PAYMENT_CODE = 'CC.DB';
	
	public $PRESENTATION_AMOUNT;
	public $PRESENTATION_CURRENCY = 'USD';
	public $PRESENTATION_USAGE = 'Test payment';
	public $ACCOUNT_REGISTRATION; // IDENTIFICATION.UNIQUEID in registration response	
	
	
	public function rules()
	{
		return array(
			array('ACCOUNT_REGISTRATION, PRESENTATION_AMOUNT', 'required')
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'ACCOUNT_REGISTRATION' => 'Select card',
			'PRESENTATION_AMOUNT' => 'Amount'
		);
	}
	
	public function createParams()
	{
		$params = array();
		foreach($this->attributes as $key => $value)
		{
			$key = str_replace('_', '.', $key);
			$params[$key] = $value;
		}
		return $params;
	}	
}
?>