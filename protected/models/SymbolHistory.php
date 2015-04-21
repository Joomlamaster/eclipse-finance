<?php

/**
 * This is the model class for table "symbol_history".
 *
 * The followings are the available columns in table 'symbol_history':
 * @property integer $symbol_id
 * @property integer $timestamp
 * @property double $symbol_value
 */
class SymbolHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'symbol_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('symbol_id, timestamp', 'numerical', 'integerOnly'=>true),
			array('symbol_value', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('symbol_id, timestamp, symbol_value', 'safe', 'on'=>'search'),
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
			'symbol' => array(self::BELONGS_TO, 'Symbols', 'symbol_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'symbol_id' => 'Symbol',
			'timestamp' => 'Timestamp',
			'symbol_value' => 'Symbol Value',
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

		$criteria->compare('symbol_id',$this->symbol_id);
		$criteria->compare('timestamp',$this->timestamp);
		$criteria->compare('symbol_value',$this->symbol_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function getSearchCriteria()
	{
		$criteria=new CDbCriteria();
		$criteria->order = 'timestamp DESC';
		$criteria->with = 'symbol';
		$criteria->params = array(); 
		if($symbol = Yii::app()->request->getQuery('symbol'))
		{
			$criteria->addCondition('t.symbol_id=:symbol');
			$criteria->params = array_merge($criteria->params, array(
				':symbol' => intval($symbol) 
			)); 
		}		
		if($from = Yii::app()->request->getQuery('from'))
		{ 
			$from = strtotime($from); //var_dump(date('d:m:Y h:i:s', $from)); 
			$criteria->addCondition('timestamp >= :from'); 
			$criteria->params = array_merge($criteria->params, array(
				':from' => intval($from)
			));			
		}
		if($to = Yii::app()->request->getQuery('to'))
		{
			$to = strtotime($to);
			$criteria->addCondition('timestamp <= :to');
			$criteria->params = array_merge($criteria->params, array(
				':to' => intval($to) + 24 * 60 * 60 
			));	
		}

		return $criteria; 
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SymbolHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
