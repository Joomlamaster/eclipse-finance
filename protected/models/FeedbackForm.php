<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class FeedbackForm extends CFormModel
{
	public $name;
	public $email;
	public $skype;
	public $department;
	public $phone; 
	public $subject;
	public $message;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, phone, subject, message', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
				
			array('skype, department', 'safe')
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
			'verifyCode'=>'Verification Code',
			'body' => 'Message',
			'name' => 'Your Name',
			'email' => 'Your Email',
			'skype' => 'Your Skype'
		);
	}
}