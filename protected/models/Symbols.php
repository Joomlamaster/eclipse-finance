<?php

/**
 * This is the model class for table "symbols".
 *
 * The followings are the available columns in table 'symbols':
 * @property integer $symbol_id
 * @property integer $group_id
 * @property string $symbol
 */
class Symbols extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	//public $group; 
	
	public function tableName()
	{
		return 'symbols';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id', 'numerical', 'integerOnly'=>true),
			array('symbol', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('symbol_id, group_id, symbol_name, symbol', 'safe', 'on'=>'search'),
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
			'group' => array(self::BELONGS_TO, 'SymbolGroups', 'group_id')
		);
	}
	
	public function getCategoryOptions()
	{
		$result = array(); 
		$all = $this->with('group')->findAll();
		foreach($all as $symbol)
		{
			$result[]=array(
				'id' => $symbol->symbol_id,
				'text' => $symbol->symbol_name,
				'group' => $symbol->group->group_name
			); 
		}
		return $result; 
	}	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'symbol_id' => 'Symbol',
			'group_id' => 'Group',
			'symbol' => 'Symbol',
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('symbol',$this->symbol,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Symbols the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
