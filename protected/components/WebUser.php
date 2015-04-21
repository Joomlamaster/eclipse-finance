<?php 
class WebUser extends CWebUser
{
	public $model; 

	public function __get($name) {
        try {
            return parent::__get($name);
        } catch (CException $e) { 
            $m = $this->getModel(); 
            if($m->__isset($name))
                return $m->{$name};
            elseif(is_callable(array($m, $name)))
            	return $m->{$name};
            else throw $e;
        }
	}	
	
	public function __set($name, $value) {
        try {
            return parent::__set($name, $value);
        } catch (CException $e) {
            $m = $this->getModel();
            $m->{$name} = $value;
        }
    }
  
	public function getModel()
    {  
        if(!isset($this->id)) 
        	$this->model = new Users;  
        if($this->model === null)
            $this->model = Users::model()->findByPk($this->id);
        return $this->model;
    }   

    function getRole() 
    {
    	if($user = $this->getModel()){
    		return $user->role;
    	}
    }    
    
    function inRMGroup()
    {
    	return $this->rm == 1;
    }    
    
    function getAccountName()
    {
    	if($this->balance < 100)
    		return "No account";
    	if($this->balance>=100 && $this->balance<=749)
    		return "Discovery account";
    	if($this->balance>=750 && $this->balance<=3499)
    		return "Standart account";
    	if($this->balance>=3500 && $this->balance<=14999)
    		return "Pro trader account";
    	if($this->balance>=15000 && $this->balance<=99000)
    		return "Excellency account";
    	if($this->balance>=100000)
    		return "V.I.P account";
    }
 	
    function isDude()
    {
    	return $this->checkAccess('admin') || $this->checkAccess('manager'); 
    }
    
    function isPartner()
    {
    	return $this->checkAccess('partner');
    }    
    
    public function name()
    {
    	if($this->first_name || $this->last_name)
    		return $this->first_name.' '.$this->last_name;

    	return $this->user_nickname; 
    }
 
    public function login($identity, $duration = 0) 
    { 
        parent::login($identity, $duration);
    }
    
}
?>