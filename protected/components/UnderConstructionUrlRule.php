<?php
class UnderConstructionUrlRule extends CBaseUrlRule
{
	public $connectionID = 'db';
 	
	public function createUrl($manager,$route,$params,$ampersand)
	{
		return false;
	}

	public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {

    	
    	return "index/underConstruction"; 
    }
}

?>