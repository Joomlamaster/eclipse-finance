<?php

/**
 * This is the model class for table "withdrawal_requests".
 *
 * The followings are the available columns in table 'withdrawal_requests':
 * @property integer $request_id
 * @property integer $timestamp
 * @property integer $user_id
 * @property double $amount
 */
class WithdrawalRequests extends CActiveRecord
{
	public $user_email; 
	//public $payment_method_id;
	public $statuses = array(
		1 => 'pending',
		2 => 'approved',
		3 => 'canceled'
	);
	
	public $payment_method; 
	public $payment_methods = array(
		1 => 'Bank Wire',
		2 => 'Credit Card',
		3 => 'Other'
	);
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'withdrawal_requests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timestamp, user_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('amount, payment_method_id', 'required'),
				
			array('payment_method_id, bank_wire_account, bank_wire_account, customer_name, bank_name, bank_code
					branch_address, account_number, iban, swift, currency, other_account, comments', 'safe'),
				
				
			//array('', 'required'),	
				
				
			// The following rule is used by search().
			array('amount', 'amountAvailable'),
			// @todo Please remove those attributes that should not be searched.
			array('request_id, user_email, timestamp, user_id, amount, status_id', 'safe', 'on'=>'search'),
		);
	}
	
	function amountAvailable($attribute,$params)
	{
		$criteria = new CDbCriteria;
		$criteria->select ='SUM(amount) AS amount';
		$criteria->condition = 'user_id=:user_id';
		$criteria->params = array(':user_id' => Yii::app()->user->id);
		$pendingSum = $this->find($criteria);  
		
		if($this->$attribute > Yii::app()->user->balance) 
			$this->addError($attribute, 'Not enough money'); 
		else if( $this->$attribute + (float)$pendingSum->amount > Yii::app()->user->balance)
			$this->addError($attribute, 'Sum of pending more than your balance');
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'request_id' => 'Request',
			'timestamp' => 'Date',
			'user_id' => 'User',
			'amount' => 'Amount',
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
		$criteria->with = 'user';
		//$criteria->order = 'timestamp DESC'; 

		$criteria->compare('t.status_id',$this->status_id);
		$criteria->compare('t.request_id',$this->request_id);
		$criteria->compare('t.timestamp',$this->timestamp);
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('t.amount',$this->amount);
		
		$criteria->compare('user.user_email',$this->user_email, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
					'pageSize'=>20,
			),				
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WithdrawalRequests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
