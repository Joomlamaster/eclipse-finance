<?php
class IndexUrlRule extends CBaseUrlRule
{
	public $connectionID = 'db';
 	
	public function createUrl($manager,$route,$params,$ampersand)
	{
		return false;
	}

	public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
    	if($pathInfo == 'index/index' || $pathInfo == 'index' || $pathInfo=='')
    	{ 
    		if(Yii::app()->user->isGuest)
    			return 'index/index';
    		
    		return 'trade/index';
    	}
    	
    	return false; 
    }
}

?>