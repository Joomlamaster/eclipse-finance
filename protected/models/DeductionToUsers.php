<?php

/**
 * This is the model class for table "deduction_to_users".
 *
 * The followings are the available columns in table 'deduction_to_users':
 * @property integer $deduction_id
 * @property integer $user_id
 * @property integer $deduction_timestamp
 * @property double $deduction_value
 */
class DeductionToUsers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'deduction_to_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, deduction_timestamp', 'numerical', 'integerOnly'=>true),
			array('deduction_value', 'numerical'),
			array('comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('deduction_id, user_id, deduction_timestamp, deduction_value', 'safe', 'on'=>'search'),
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
			'deduction_id' => 'Deduction',
			'user_id' => 'User',
			'deduction_timestamp' => 'Deduction Timestamp',
			'deduction_value' => 'Deduction Value',
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

		$criteria->compare('deduction_id',$this->deduction_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('deduction_timestamp',$this->deduction_timestamp);
		$criteria->compare('deduction_value',$this->deduction_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeductionToUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
