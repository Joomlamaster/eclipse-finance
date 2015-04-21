<?php 
class SiteController extends Controller
{
	
	public $layout = '//layouts/column2';
	
	function beforeAction($action)
	{
		$this->registerBaseScripts(); 
		return parent::beforeAction($action);
	}
	
	function registerBaseScripts()
	{
		$cs = Yii::app()->getClientScript();
		
		$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/style.css');
		$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap.css');
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/_main.js');
		
		if($this->id != 'trade')
			$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/option/module.timer.js'); 
		
		$cs->registerCoreScript( 'jquery.ui' );
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.livequery.js');
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/fixto.min.js');
	}
	
	function beforeRender($view)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'footer=1'; 
		if($pages = Pages::model()->getPagesTree($criteria))
			$this->renderPartial('//layouts/clips/_footer', compact('pages'));
		return $view;
	}	

}

?>