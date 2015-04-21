<?php

/**
 * This is the model class for table "rates_closed".
 *
 * The followings are the available columns in table 'rates_closed':
 * @property integer $row_id
 * @property integer $rate_id
 * @property string $rate_currency
 * @property integer $user_id
 * @property integer $status
 * @property double $rate_value
 * @property integer $rate_start_time
 * @property integer $rate_end_time
 * @property string $rate_type
 */
class RatesClosed extends CActiveRecord
{
	
	public $striketime; 
	public $expiry; 
	public $return; 
	//public $result;  
	public $win; 
	
	public $ats_group;	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rates_closed';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rate_id, user_id, status, rate_start_time, rate_end_time', 'numerical', 'integerOnly'=>true),
			array('expiry, striketime, rate_value, strike_value, expiration_value, return', 'required'),
				
			array('ats_group', 'requiredAtsGroups', 'on' => 'ats'),
				
			array('rate_value', 'numerical'),
				
				
			array('rate_currency', 'length', 'max'=>255),
			array('rate_type', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('row_id, rate_id, rate_currency, user_id, status, rate_value, rate_start_time, rate_end_time, rate_type', 'safe', 'on'=>'search'),
		);
	}
	
	function requiredAtsGroups($attribute, $params)
	{
		if(empty($this->$attribute))
			$this->addError($attribute, 'Ats groups must be specified');
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
	
	public function getStatistics($symbol)
	{
		//SELECT COUNT(rate_type) AS `count`, rate_type FROM rates_closed WHERE rate_currency='eur/usd' GROUP BY rate_type
		$command = Yii::app()->db->createCommand()
		->select('COUNT(rate_type) AS strike_count, rate_type')
		->from('rates_closed rc')
		->andWhere('rc.rate_currency=:symbol')
		->group('rc.rate_type');
		$command->params = array(
			':symbol' => $symbol
		);
	
		return $command->queryAll();
	}	
	
	public function getByRateId($rateId)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'rate_id=:rate_id';
		$criteria->params = array(':rate_id' => $rateId);
		return $this->find($criteria);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'row_id' => 'Row',
			'rate_id' => 'Rate',
			'rate_currency' => 'Rate Currency',
			'user_id' => 'User',
			'status' => 'Status',
			'rate_value' => 'Amount',
			'rate_start_time' => 'Rate Start Time',
			'rate_end_time' => 'Expiry',
			'expiration_value' => 'Expiration rate',
			'rate_type' => 'Order',
		);
	}
	
	function beforeSave()
	{
		if(parent::beforeSave()) 
		{
			if($this->scenario == 'ats')
			{  
				$this->rate_start_time = $this->getTimeFromString($this->striketime);
				$this->rate_end_time = $this->getTimeFromString($this->expiry);			
			}
			
			return true;
		}	
		return false;
	}
	
	function getTimeFromString($string)
	{
		preg_match('/([\d]+)\:([\d]+) (PM|AM)/i', $string, $match); 
		list($time, $hour, $minute, $format) = $match;
		$format == 'PM' && $hour += 12;
		
		return mktime($hour, $minute, 0, date("m"), date("d"), date("Y"));
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

		$criteria->compare('row_id',$this->row_id);
		$criteria->compare('rate_id',$this->rate_id);
		$criteria->compare('rate_currency',$this->rate_currency,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('rate_value',$this->rate_value);
		$criteria->compare('rate_start_time',$this->rate_start_time);
		$criteria->compare('rate_end_time',$this->rate_end_time);
		$criteria->compare('rate_type',$this->rate_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RatesClosed the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
