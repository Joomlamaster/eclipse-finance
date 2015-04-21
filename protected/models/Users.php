<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $email
 * @property string $password
 */
class Users extends CActiveRecord
{
	
	public $password_repeat;
	public $password_plain;
	
	public $user_password_repeat;
	public $user_password_new;	
	
	public $manager_name; 
	
	public $agree; 
	
	public $bonus_manually; 
	
	public $user_regdate; 
	
	public $verifyCode; 
	
	public $ats_groups = array(
		'1-14',
		'15-24',
		'25-49',
		'50-99',
		'100 - 249',
		'250-1000'
	);	
	
	public $experience = array(
		0 => 'No experience',
		1 => 'Less than 1 year',
		2 => 'More than 1 year',
		3 => 'More than 2 year',
		4 => 'More than 3 year',
		5 => 'More than 4 year'
	); 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/*
	 * scenarios [
	 * 	registration,
	 * 	profile,
	 * 	recovery,
	 * 	
	 * 	//dashboard
	 * 	managment 
	 * 	control
	 * ]
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, user_address, user_email, user_password', 'length', 'max'=>255),
			
                       
			array('user_email, country_id, first_name, last_name', 'required'),
			
			array('agree', 'required', 'on' => 'registration'),
				
			array('manager_name, user_regdate, user_lastvisit, experience_id, ats, rm, ats_group, country_id, user_phone_code, user_phone, city, house', 'safe'),
				
			array('bonus, bonus_manually', 'numerical'),
				
			array('verifyCode', 'captcha',
				// авторизованным пользователям код можно не вводить
				'allowEmpty'=>!Yii::app()->user->isGuest || !CCaptcha::checkRequirements(),
			),				
				
			array('scan', 'file', 'types'=>'jpg, gif, png', 'allowEmpty' => true),
			//array('scan', 'required', 'on' => 'registration'), //profile
				
			array('user_password', 'required',  'on'=>'registration, recovery, management, partners'),
			array('user_password','length', 'min'=>6),	
			array('user_password_new, user_password_repeat', 'required', 'on' => 'recovery'),
			array('user_password_new', 'compare',  'compareAttribute'=>'user_password_repeat', 'on' => 'recovery'),				

			array('user_password', 'compare',  'compareAttribute'=>'password_repeat', 'on' => 'registration'),
			array('user_id, manager_id, partner_id, url_referrer, first_name, last_name, user_birthday, user_address, user_email, partner_percent, password_repeat, role, balance, currency_id', 'safe'),
			array('user_email', 'email'),	
			array('user_email', 'available', 'on' => 'registration, management, partners, partners, control, profile'),
		);
	}
	
	public function available($attribute,$params)
	{
		if($attribute == 'user_email')
		{
			$user = $this->find('user_email=:user_email AND user_id != :user_id', array(
					':user_email' => CHtml::encode($this->user_email),
					':user_id' => $this->user_id
			));
			if($user)
				$this->addError('user_email','Email address not available.');
		}
	}
	
	private $fullName;
	
	public function getFullName()
	{
		return $this->first_name.' '.$this->last_name;
	}	
	
	public function getManager_name()
	{
		return $this->manager->first_name.' '.$this->manager->last_name; 
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'manager' => array(self::BELONGS_TO, 'Users', 'manager_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User ID',
			'ats' => 'ATS Group',
			'rm' => 'Risk Managment',
			'agree' => 'I agree to the Terms and Conditions',
			'bonus_manually' => 'Bonus',
			'user_regdate' => 'Added',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'user_address' => 'Country',
			'country_id' => 'Country',
			'manager_id' => 'Manager',
			'user_email' => 'E-mail',
			'house' => 'House/Flat number',
			'user_phone' => 'Primary phone',
			'user_password' => 'Password',
			'password_repeat' => 'Repeat',
			'verifyCode' => 'Please type the characters',
		);
	}
	
	public function beforeSave()
	{
		if(parent::beforeSave() && $this->isNewRecord)
		{
			$this->password_plain = $this->user_password;
			$this->user_regdate = time();  
			$this->user_password = CPasswordHelper::hashPassword($this->user_password);
		}
		if(trim($this->user_birthday) != '')
		{
			$this->user_birthday = strtotime($this->user_birthday);
		}
		return true;
	}	
	
	public function afterFind()
	{
		if(is_numeric($this->user_birthday))
			$this->user_birthday = date('m/d/Y', $this->user_birthday);
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
	public function search($ats = false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
			$criteria->condition = 't.role="user"';
			$criteria->order ='t.user_id DESC';
			switch($this->scenario) {
			case 'search_ats': 
				$criteria->condition.= ' AND t.ats_group IN ('.implode(',',array_keys($this->ats_groups)).')';
			break; 
			case 'search_rm': 
				$criteria->condition.= ' AND t.rm=1';
			break; 
		}
		$criteria->with = 'manager';
		
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('t.user_regdate',$this->user_regdate);
		$criteria->compare('t.first_name',$this->first_name,true);
		$criteria->compare('t.last_name',$this->last_name,true);
		$criteria->compare('t.user_address',$this->user_address,true);
		$criteria->compare('t.user_email',$this->user_email,true);
		$criteria->compare('t.balance',$this->balance,true);
		$criteria->compare('t.user_password',$this->user_password,true);
		
		//ats groups
		$criteria->compare('t.ats_group',$this->ats_group,true);
		
		$criteria->compare('manager.first_name',$this->manager_name,true);
		$criteria->compare('manager.last_name',$this->manager_name,true, 'OR');
		//$criteria->compare('manager.last_name',$this->manager_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>15,
				),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}