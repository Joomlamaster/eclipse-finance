<?php 
class CustomerRegistrationForm extends CFormModel
{
	public $REQUEST_VERSION = "1.0";
	
	public $SECURITY_SENDER = 'ff80808141e49f6b014208ac912a2e2b';
	
	public $USER_LOGIN = 'ff80808141e49f6b014208ac912b2e2f';
	public $USER_PWD = 'bQXS72Bb'; 
	public $TRANSACTION_CHANNEL = 'ff80808141e49f6b014208ad17e22e31';
	public $TRANSACTION_MODE = 'INTEGRATOR_TEST';
	public $TRANSACTION_RESPONSE = 'SYNC';
	public $IDENTIFICATION_TRANSACTIONID; //=microtime(TRUE) // microtime is not unique-proof when you have parallell transactions so make sure to change it in production
	
	public $PAYMENT_CODE = 'CC.RG';
		
	public $NAME_GIVEN = 'Joe';
	public $NAME_FAMILY = 'Doe';
		
	public $ADDRESS_STREET = 'Leopoldstr. 1';
	public $ADDRESS_ZIP = '80798';
	public $ADDRESS_CITY = 'München';
	public $ADDRESS_STATE = 'BY';
	public $ADDRESS_COUNTRY = 'DE';
		
	public $CONTACT_EMAIL = 'info@provider.com';
	public $CONTACT_IP = '123.123.123.123';
		
	public $ACCOUNT_HOLDER = 'Joe Doe';
	public $ACCOUNT_NUMBER = '4444333322221111';
	//public $ACCOUNT_BRAND = 'VISA';
	public $ACCOUNT_EXPIRY_MONTH = '10';
	public $ACCOUNT_EXPIRY_YEAR = '2014';
	public $ACCOUNT_VERIFICATION = '123';
		
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('ACCOUNT_HOLDER, ACCOUNT_NUMBER, ACCOUNT_EXPIRY_MONTH, 
				   ADDRESS_STREET, ADDRESS_ZIP, ADDRESS_CITY, ADDRESS_STATE, ADDRESS_COUNTRY,
				   ACCOUNT_EXPIRY_YEAR, ACCOUNT_VERIFICATION,
				   NAME_GIVEN, NAME_FAMILY', 'required'),
				
			array('CONTACT_EMAIL', 'email'),
			array('ACCOUNT_EXPIRY_MONTH', 'safe')
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'CONTACT_EMAIL' => 'E-mail address'
		);
	}	
	
	public function createParams()
	{
		$params = array(); 
		foreach($this->attributes as $key => $value)
		{
			$key = preg_replace('/\_/', '.', $key, 1); 
			$params[$key] = $value;
		} 
		return $params; 
	}
}

?>