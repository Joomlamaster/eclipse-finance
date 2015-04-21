<?php
class IndexController extends SiteController
{
	public $layout = '//layouts/main';

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	function beforeAction($action)
	{ 
		if(parent::beforeAction($action))
		{
			$cs = Yii::app()->getClientScript();
			$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/index.css');
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/flot/jquery.flot.js');
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/flot/jquery.flot.time.js');
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/option/module.timer.js');
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/index.js', CClientScript::POS_END);
			
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/index/jquery.news.js');
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/index/jquery.line.js');
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/index/jquery.trends.js');
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/index/jquery.tradeChoice.js');
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.swfobject.1-1-1.min.js');
			
			$cs->registerPackage('dxfeed'); 		
		}
		return true; 
	}

	
	public function actionIndex()
	{
		$model = new Users('registration');
		$topfinstories = @file_get_contents('http://finance.yahoo.com/rss/topfinstories');
		$news = array();
		if($topfinstories)
			$news = simplexml_load_string($topfinstories);
		$symbolGroups = SymbolGroups::model()->findAll();	
			
		$this->render('index', compact('model', 'news', 'symbolGroups'));
	}
	
	public function actionUnderConstruction()
	{
		echo "Under Construction";
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->renderPartial('error', $error);
		}
	}




}