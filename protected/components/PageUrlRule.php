<?php 
class PageUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand)
    { 
        if($route==='page/show')
        {  
            if (isset($params['page_url']) && false == empty($params['page_url']))
                return 'page/'.CHtml::encode(trim($params['page_url']));
			//else if(isset($params['id']))
			return 'page/show/page_id/'.intval($params['page_id']); 
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    { 
        if(preg_match('%^page\/([\w\/\d+\-\_]+)$%', $pathInfo, $matches))
        {  
        	if($model = Pages::model()->findByUrl($matches[1]))
        	{
        		$_GET['page_id'] = $model->page_id; 
        		return 'page/show'; 
        	}
        }
        return false;  // this rule does not apply
    }
}

?>