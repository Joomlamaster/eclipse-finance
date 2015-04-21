<?php 
class WithdrawalRequestsController extends UserController
{
	function actionIndex()
	{
		$model=new WithdrawalRequests('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['WithdrawalRequests']))
			$model->attributes=$_GET['WithdrawalRequests'];
				
		$this->render('list', compact('model'));
	}
}
?>