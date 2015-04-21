<?php 
class ExpiryRateWidget extends CWidget
{
	function init()
	{
		
	}
	
	function run()
	{
		Yii::import('application.models.Symbols'); 
		$model = new Symbols;
		
		$criteria = SymbolHistory::model()->getSearchCriteria(); 
		
		$count = SymbolHistory::model()->count($criteria);
		
		$pages = new CPagination($count);
			
		// results per page
		$pages->pageSize=15;
		$pages->applyLimit($criteria);
		$list=SymbolHistory::model()->findAll($criteria);
				
		$this->render('ExpiryRateWidget/form', compact('model', 'list', 'pages'));
	}
}

?>