<?php
function employModuleRules($event)
{
	$route=Yii::app()->getRequest()->getPathInfo();
	$module=substr($route,0,strpos($route,'/'));
 
	if(Yii::app()->hasModule($module))
	{ 
		$module=Yii::app()->getModule($module);
		if(isset($module->urlRules))
		{ 
			$urlManager=Yii::app()->getUrlManager();
			$urlManager->addRules($module->urlRules, false);
		}
	}
	return true;
} 
// uncomment the following to define a path alias
//Yii::setPathOfAlias('local','eclipse');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=> dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Eclipse Finance',

	'sourceLanguage' =>'en_US',
	'language' =>'en',

	'defaultController' => 'index',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap'
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
		'ext.YiiMailer.YiiMailer',
			
		'ext.eoauth.*',
		'ext.eoauth.lib.*',
		'ext.lightopenid.*',
		'ext.eauth.services.*',
	),
	
	'aliases' => array(
		'xupload' => 'ext.xupload'
	),		

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1', '25.213.254.23', '192.168.188.1', '192.168.100.31', '25.72.240.70'),
     		'generatorPaths' => array(
          		'bootstrap.gii'
			),	
		),
		
		'admin',
		
		'profile',
		
		'partner' 
		
	),
	'controllerMap'=>array(
			//'min'=>array(
			//		'class'=>'ext.minScript.controllers.ExtMinScriptController',
			//),
	),
	// application components
	'components'=>array(
		'authManager' => array(
				// Будем использовать свой менеджер авторизации
				'class' => 'PhpAuthManager',
				// Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
				'defaultRoles' => array('guest'),
		),		
		
		/*
		'report' => array(
			'class' => 'Report'
		),
		*/
 		'request'=>array(
			// Возможно это и костыль, но без него никуда не поехать, тут мы определяем базовый URL нашего приложения.
			'baseUrl'=>$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'] != $_SERVER['SCRIPT_FILENAME'] ? 'http://'.$_SERVER['HTTP_HOST'] : '',	
		),	
		'session' => array(
				'class' => 'CHttpSession',
				'autoStart' => true
		),
		'bootstrap' => array(
			'class' => 'ext.bootstrap.components.Bootstrap',
			'responsiveCss' => true,
		),			
		'user'=>array(
			// enable cookie-based authentication
  			'class'=>'WebUser',
			'loginUrl'=>array('/user/login'),
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'identityCookie' => array(
				'domain' => '.example.com'
			)
			//'allowAutoLogin'=>true,
		),
			
		
		'clientScript'=>array(
// 			'class' => 'application.vendors.yii-EClientScript.EClientScript',
// 			'combineScriptFiles' => true, // By default this is set to true, set this to true if you'd like to combine the script files
// 			'combineCssFiles' => true, // By default this is set to true, set this to true if you'd like to combine the css files
// 			'optimizeScriptFiles' => false, // @since: 1.1
// 			'optimizeCssFiles' => false, // @since: 1.1
// 			'optimizeInlineScript' => false, // @since: 1.6, This may case response slower
// 			'optimizeInlineCss' => false, // @since: 1.6, This may case response slower	
// 			'refresh' => false,	
			//'class'=>'ext.minScript.components.ExtMinScript',
			//'optionName'=>'optionValue',
		    'packages' => array(
				//'jquery'=>array(
				//	'baseUrl'=>Yii::app()->request->baseUrl . '/js',
				//	'js'=>array('jquery-1.7.js')
				//),						
		        'fancybox' => array(
		        	'baseUrl' => '/js/fancybox/',
		        	'js' => array(
		        		'jquery.fancybox.pack.js'
		        	),
		        	'css' => array(
		        		'jquery.fancybox.css',
		        		'jquery.fancybox.prototype.css'
		        	)
		        ),	 	   
    			'dxfeed' => array(
	    			'baseUrl' => '/js/dx/',
	    			'js' => array(
						'cometd.js',
						'jquery.cometd.js',
						'dxfeed.context.js',
						'dxfeed.cometd.js',
						'dxfeed-ui.qtable.js'	
	    			),		        	
		        )
		    )
		),			
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'appendParams' => false,
			'caseSensitive'=>false, 
			'rules'=>array(
				array(
					'class' => 'application.components.IndexUrlRule',
					'connectionID' => 'db',
				),	
				array(
						'class' => 'application.components.PageUrlRule',
						'connectionID' => 'db',
				),						
				'<_c:index|trade|page>'=>'<_c>/index',
				'page/<page_id:\d+>' => 'page/show'
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=eclipsef_eclipse',
			'class'=>'application.extensions.PHPPDO.CPdoDbConnection',
		    	'pdoClass' => 'PHPPDO',
			'emulatePrepare' => true,
			'username' => 'eclipsef_admin',
			'password' => 'admin@123',
			'charset' => 'utf8',
		),  
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'index/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					 'levels' => 'error, warning, trace, notice',
					//'levels'=>'error, warning',
					'categories' => 'system.db.CDbCommand',
					'logFile' => 'db.log',					
				),
				array(   
					'class'=>'CFileLogRoute',  
					'levels'=>'error, warning',    
					//'levels'=>'error, warning',  
					//'categories' => 'system.db.CDbCommand, system.web.CController',
					'logFile' => 'application.log', 
				),				
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'request' => array(
            'baseUrl' => '',
        ),		
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page 
		'adminEmail'=>'binaryoptionpro77@gmail.com',
	),
);