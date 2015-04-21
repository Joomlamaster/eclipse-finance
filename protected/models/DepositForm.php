<?php 
class DepositForm extends CFormModel
{
	public $TransactionType;
	public $CustomerIP;
	public $CurrencyCode;
	public $TotalAmount;
	public $ProductDescription;
	public $CardPayMethod;
	
	public $FirstName;
	public $LastName;
	public $Phone;
	public $Email;
	
	public $Street;
	public $City;
	public $Region;
	public $Country;
	public $Zip;
	
	public $CardHolderName;
	public $CardNumber;
	public $CardExpireMonth; 
	public $CardExpireYear;
	public $CardType;
	public $CardSecurityCode;
	public $VirtualCard;
	
	public function rules()
	{
		return array(
			array('FirstName, LastName, Phone, Email, Street, City, Region, Country, 
				   Zip, CardHolderName, CardNumber, CardExpireMonth, CardExpireYear, CardType, CardSecurityCode
				   TotalAmount, CurrencyCode', 'required'),
			array('TotalAmount', 'numerical'),
			array('Email', 'email'),
			array('TransactionType, CustomerIP, CurrencyCode, TotalAmount, ProductDescription, CardPayMethod', 'safe')
		);
	} 
	 
	function beforeValidate()
	{
		if(!$this->VirtualCard)
			$this->VirtualCard = 0;
		
		$this->TransactionType = 'LP001';
		$this->CustomerIP = $_SERVER['REMOTE_ADDR'];
		//$this->CurrencyCode = 'USD';
		//$this->TotalAmount = '15050'; 
		$this->ProductDescription = 'Global Investment';
		$this->CardPayMethod = '2'; 
		
		return parent::beforeValidate(); 
	}
	
	function afterValidate()
	{
		$this->TotalAmount*=100;   
		return parent::afterValidate();
	} 
	
	public function attributeLabels()
	{
		return array(
			'VirtualCard' => 'Apply for Lamda Virtual MasterCard (+$2) :'
		);
	}	
}

?>