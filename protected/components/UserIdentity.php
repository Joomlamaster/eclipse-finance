<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public $_id;
	
    public function authenticate()
    { 
    	if($this->username && $this->password)
    	{
	    	$record=Users::model()->find('user_email=:username', array(':username' => $this->username));    	 
	        if($record===null)
	            $this->errorCode=self::ERROR_USERNAME_INVALID;
	        else if(!CPasswordHelper::verifyPassword($this->password, $record->user_password))
	            $this->errorCode=self::ERROR_PASSWORD_INVALID;
	        else
	        {
	            $this->_id=$record->user_id;
	            $this->errorCode=self::ERROR_NONE;
	        } 
    	}
    	else
    	{
    		$this->errorCode=self::ERROR_USERNAME_INVALID;
    	}
    	
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}