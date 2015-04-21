<?php

class PartnerModule extends CWebModule
{
    /**
     * @var string the path to this modules published asset directory
     */
    protected $assetsUrl;

    /**
     * @var boolean indicates whether assets should be republished on every request.
     */
    public $forceCopyAssets = true;

    
    public $urlRules = array(
    	
    );

    public function preinit()
    {
        $this->checkDependencies();

        //Yii::setPathOfAlias('bootstrap', 'protected/modules/admin/library/bootstrap');

        // Reset the front-end's client script because we don't want
        // both front-end styles being applied in this module.
       // Yii::app()->clientScript->reset();
    }
    
	public function beforeControllerAction($controller, $action) {

        if(parent::beforeControllerAction($controller, $action)) 
        {
            $route = $controller->id . '/' . $action->id;

            $publicPages = array(
                    'user/login',
            );

			if (!(Yii::app()->user->isDude() || Yii::app()->user->role == 'partner') && !in_array($route, $publicPages)) 
				Yii::app()->getModule('partner')->user->loginRequired();
            
           return true;
        }
        else
            return false;
    }    

    public function init()
    {
        $this->setImport(array(
            'partner.models.*',
            'partner.components.*',
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
                'user' => array(
					'class'=>'WebUser',
					'loginUrl'=>array('partner/user/login'),
                )
            )
        ));

        $this->registerCoreCss();
        //$this->registerBootstrap();
    }

    /**
     * Registers the published admin CSS
     */
    protected function registerCoreCss()
    {
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/partner.css');
    }   

    /**
     * Publishes and returns the URL to the assets folder.
     * @return string the URL
     */
    public function getAssetsUrl()
    {
        if (!isset($this->assetsUrl))
        {
            $assetsPath = Yii::getPathOfAlias('partner.assets');
            $this->assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
        }

        return $this->assetsUrl;
    }

    /**
     * Checks if the Bootstrap extension is installed and verifies it is capable
     */
    protected function checkDependencies()
    {

    }
}