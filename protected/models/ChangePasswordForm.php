<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ChangePasswordForm extends CFormModel
{
	public $password;
	public $passwordNew;
	public $passwordRepeat;
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('password, passwordNew, passwordRepeat', 'required'),
			array('password', 'access'),
			array('passwordNew', 'compare',  'compareAttribute'=>'passwordRepeat')
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>'Password',
		);
	}
	
	function access($attribute,$params)
	{
		if(!$this->hasErrors())
		{
   			$record=Users::model()->findByPk(Yii::app()->user->id);  
        	if($record->user_password!==crypt($this->password,$record->user_password))
            	$this->addError('password','Password incorrect.');
		}		
	}
}