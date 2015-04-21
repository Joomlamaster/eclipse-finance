<?php
class TradeController extends SiteController
{
	public $layout = 'column2'; 
	
	function beforeAction($action)
	{
		if(parent::beforeAction($action))
		{
			if($action->id == 'index'){			
				$cs = Yii::app()->getClientScript();
				
				$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/extended/pager.css');
				$cs->registerCssFile('http://cdn.jsdelivr.net/animatecss/3.1.0/animate.css');

				$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/flot/jquery.flot.trade.js');
				$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/flot/jquery.flot.time.js');
				$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/flot/jquery.flot.label.js');
				
				$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-tmpl-master/jquery.tmpl.min.js');
				$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/main.js?'.time(), CClientScript::POS_END);	
				$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/anijs-min.js', CClientScript::POS_END);
				$cs->registerPackage('dxfeed'); 				
			}		
		}
		return true;
	}	
	
	public function actionIndex()
	{
		$symbolGroups = SymbolGroups::model()->findAll();
		$this->render('index', compact('symbolGroups'));
	}
}