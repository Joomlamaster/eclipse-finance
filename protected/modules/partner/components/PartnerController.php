<?php

/**
 * AdminController class file.
 *
 * @author Matt Skelton
 * @date 16-May-2013
 */

/**
 * Base class for all admin controllers.
 */
class PartnerController extends Controller
{
    /**
     * @var string the default layout for the controller view. Defaults to '/layouts/column1',
     * meaning using a single column layout. See 'protected/modules/admin/views/layouts/column1.php'.
     */
    public $layout = '/layouts/column2';

    
    public $subFolder; 
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * @var array admin context menu items. This property will be assigned to {@link TbMenu::items}.
     */
    public $adminMenu = array();
    
    public $adminMenus = array();

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('@'),
            //'expression' => 'Yii::app()->user->isAdmin'
            ),
            /*
            array('deny', // deny all users
                'users' => array('*'),
            ),
           */ 
        );
    }

    public function beforeRender($view)
    {
    	$cs = Yii::app()->getClientScript();
    	$cs->registerScriptFile($this->getModule('admin')->getAssetsUrl().'/js/admin.js');  
    	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-tmpl-master/jquery.tmpl.min.js');
    	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.livequery.js'); 
    	$cs->registerCoreScript( 'jquery.ui' );
    	
        if (($this->adminMenu || $this->adminMenus) && !Yii::app()->user->isGuest)
            $this->renderPartial('/layouts/clips/_admin_clip');

        return parent::beforeRender($view);
    }
}
?>
