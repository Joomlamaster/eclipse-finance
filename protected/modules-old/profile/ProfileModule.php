<?php

class ProfileModule extends CWebModule
{
	protected $assetsUrl;
	    
    public $urlRules = array(
    	
    );
    
    /**
     * @var boolean indicates whether assets should be republished on every request.
     */
    public $forceCopyAssets = true;    

    public function preinit()
    {
  
    }
    
	public function beforeControllerAction($controller, $action) {

        if(parent::beforeControllerAction($controller, $action)) 
        {
            
			if (Yii::app()->user->isGuest) 
				Yii::app()->user->loginRequired();
            
           return true;
        }
        else
            return false;
    }    

    public function init()
    {
        $this->setImport(array(
            'profile.models.*',
            'profile.components.*',
           // 'admin.library.*',
        ));

        
        $this->configure(array(

            'components' => array(
        /*
	        	'urlManager' => array(
        			'urlFormat'=>'path',
	        		'rules' => array( 
        				'admin/aaa' => 'admin/news/index',
	        			//'news/<page:\d+>' => 'news/index'
	        		)
	        	),        
	        	*/ 
        /*
                'bootstrap' => array(
                    'class' => 'AdminBootstrap',
                    'forceCopyAssets' => $this->forceCopyAssets
                ),
                */ 
//                 'user' => array(
// 					'class'=>'WebUser',
// 					'loginUrl'=>array('admin/user/login'),
//                 )
            )
        ));

        $this->registerCoreCss();
    }

    /**
     * Registers the published profile CSS
     */
    protected function registerCoreCss()
    {
    	Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/profile.css');
    }

    /**
     * Publishes and returns the URL to the assets folder.
     * @return string the URL
     */
    public function getAssetsUrl()
    {
        if (!isset($this->assetsUrl))
        {
            $assetsPath = Yii::getPathOfAlias('profile.assets');
            $this->assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
        }

        return $this->assetsUrl;
    }
        public function registerImage($file)
    {
    return $this->getAssetsUrl().'/img/'.$file;
    }
}