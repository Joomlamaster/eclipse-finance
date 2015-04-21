<?php

/**
 * This is the model class for table "rates".
 *
 * The followings are the available columns in table 'rates':
 * @property integer $rate_id
 * @property string $rate_currency
 * @property integer $user_id
 * @property integer $is_open
 * @property double $rate_value
 * @property integer $rate_start_time
 * @property integer $rate_end_time
 */
class Rates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	public function tableName()
	{
		return 'rates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, rate_start_time, rate_end_time', 'numerical', 'integerOnly'=>true),
			array('rate_value', 'numerical'),
			array('rate_currency', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rate_id, rate_currency, user_id, rate_value, rate_start_time, rate_end_time', 'safe', 'on'=>'search'),
		);
	}
	
	public function getProximateRates($seconds = 60)
	{
		$command = Yii::app()->db->createCommand()
		//->select('*')
		->from('rates r')
		->andWhere('rate_end_time >= :from AND rate_end_time <= :to AND status=0');
		$command->params = array(
			':from' => time(),
			':to'   => time() + $seconds
		); 
		
		return $command->queryAll(); 
	}
	
	public function getStatistics($symbol)
	{
		//SELECT COUNT(rate_type) AS `count`, rate_type FROM rates WHERE rate_currency='eur/usd' GROUP BY rate_type
		$command = Yii::app()->db->createCommand()
		->select('COUNT(rate_type) AS strike_count, rate_type')
		->from('rates r')
		->andWhere('rate_currency=:symbol')
		->group('rate_type');
		$command->params = array(
			':symbol' => $symbol
		);
// 		$criteria = new CDbCriteria;
// 		$criteria->select = 'COUNT(rate_type) AS ccc, rate_type';
// 		$criteria->condition = 'rate_currency=:symbol';
// 		$criteria->group = 'rate_type'; 
// 		$criteria->params = array(':symbol' => $symbol);
		
		return $command->queryAll(); 
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
			'rate_id' => 'Rate',
			'rate_currency' => 'Rate Currency',
			'user_id' => 'User',
			'rate_value' => 'Rate Value',
			'rate_start_time' => 'Rate Start Time',
			'rate_end_time' => 'Rate End Time',
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

		$criteria->compare('rate_id',$this->rate_id);
		$criteria->compare('rate_currency',$this->rate_currency,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('is_open',$this->is_open);
		$criteria->compare('rate_value',$this->rate_value);
		$criteria->compare('rate_start_time',$this->rate_start_time);
		$criteria->compare('rate_end_time',$this->rate_end_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
