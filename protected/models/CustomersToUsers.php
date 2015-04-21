<?php

/**
 * This is the model class for table "customers_to_users".
 *
 * The followings are the available columns in table 'customers_to_users':
 * @property integer $customer_id
 * @property string $uniqueid
 */
class CustomersToUsers extends CActiveRecord
{
			
	public $payment_code = 'CC.RG';
	
	public $name_given = 'Joe';
	public $name_family = 'Doe';
	
	public $address_street = 'Leopoldstr. 1';
	public $address_zip = '80798';
	public $address_city = 'München';
	public $address_state = 'BY';
	public $address_country = 'DE';
	
	public $contact_email = 'info@provider.com';
	public $contact_ip = '123.123.123.123';
	
	public $account_holder = 'Joe Doe';
	public $account_number = '4444333322221111';
	//public $ACCOUNT_BRAND = 'VISA';
	public $account_expiry_month = '10';
	public $account_expiry_year = '2014';
	public $account_verification = '123';	
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customers_to_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, uniqueid, payment_code, name_given, name_family, address_street, 
				   address_zip, address_city, address_state, address_country, 
				   address_country, contact_email, contact_ip, account_holder, 
				   account_number, account_expiry_month, account_expiry_year, account_verification', 'safe'),
				
			array('uniqueid', 'length', 'max'=>32),
				
			array('account_holder, account_number, account_expiry_month,
			   	   address_street, address_zip, address_city, address_state, address_country,
			   	   account_expiry_year, account_verification,
			   	   name_given, name_family', 'required'),
			
			array('contact_email', 'email'),
			array('account_expiry_month', 'safe'),				
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('customer_id, uniqueid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customer_id' => 'Customer',
			'uniqueid' => 'Uniqueid',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('uniqueid',$this->uniqueid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getRequestParams()
	{
		$defaults = array(
			'REQUEST.VERSION' => "1.0",
			'SECURITY.SENDER' => 'ff80808141e49f6b014208ac912a2e2b',
			
			'USER.LOGIN' => 'ff80808141e49f6b014208ac912b2e2f',
			'USER.PWD' => 'bQXS72Bb',
			'TRANSACTION.CHANNEL' => 'ff80808141e49f6b014208ad17e22e31',
			'TRANSACTION.MODE' => 'INTEGRATOR_TEST',
			'TRANSACTION.RESPONSE' => 'SYNC',
			'IDENTIFICATION.TRANSACTIONID' => microtime(TRUE), //=microtime(TRUE) // microtime is not unique-proof when you have parallell transactions so make sure to change it in production
			
			'PAYMENT.CODE' => 'CC.RG',
			
			'NAME.GIVEN' => 'Joe',
			'NAME.FAMILY' => 'Doe',
			
			'ADDRESS.STREET' => 'Leopoldstr. 1',
			'ADDRESS.ZIP' => '80798',
			'ADDRESS.CITY' => 'München',
			'ADDRESS.STATE' => 'BY',
			'ADDRESS.COUNTRY' => 'DE',
			
			'CONTACT.EMAIL' => 'info@provider.com',
			'CONTACT.IP' => '123.123.123.123',
			
			'ACCOUNT.HOLDER' => 'Joe Doe',
			'ACCOUNT.NUMBER' => '4444333322221111',
			//public $ACCOUNT_BRAND = 'VISA';
			'ACCOUNT.EXPIRY_MONTH' => '10',
			'ACCOUNT.EXPIRY_YEAR' => '2014',
			'ACCOUNT.VERIFICATION' => '123'			
		); 
		
		foreach($this->attributes as $name => $value)
		{
			$name = strtoupper(preg_replace('/\_/', '.', $name, 1));  
			if(array_key_exists($name, $defaults))
				$defaults[$name] = $value; 
		}
		return $defaults; 
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomersToUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
