<?php 
class RatesController extends UserController
{
	function actionHistory($user_id)
	{
		$criteria=new CDbCriteria();
		$criteria->order = 'rate_end_time DESC';
		$criteria->condition = 'user_id=:user_id';
		$criteria->params = array(':user_id' => $user_id);
		$count=RatesClosed::model()->count($criteria);
		$pages=new CPagination($count);
			
		// results per page
		$pages->pageSize=15;
		$pages->applyLimit($criteria);
		$rates=RatesClosed::model()->findAll($criteria);		
		$this->render('rates', compact('rates', 'pages', 'statuses'));
	}

}

?>