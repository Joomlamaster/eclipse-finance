<?php 
class InfoController extends UserController
{
	function actionBilling($user_id)
	{
		//$this->render('billing'); 
	}
		
	function actionIndex($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id); 
		$this->render('profile', compact('user'));		
	}
	
	function actionProfile($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id);
		$this->render('profile', compact('user'));
	}	
	
	function actionWithdrawal_request($request_id)
	{
		$request = WithdrawalRequests::model()->findByPk($request_id); 
		
		$this->render('withdrawal_request', compact('request'));
	}
}

?>