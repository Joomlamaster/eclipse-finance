<?php 
class ListController extends UserController
{
	//public $layout = 'column3';
	
	function actionIndex()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
				
		$this->render('list', compact('model'));
	}		

	
	function actionList()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];		
		
	    $this->render('list', compact('model'));    		
	}
	
	function actionAts()
	{
		$model=new Users('search_ats');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
			
		$this->render('list', compact('model'));
	}	
	
	
	function actionWithdrawal_requests()
	{
		$model = new WithdrawalRequests('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['WithdrawalRequests']))
			$model->attributes=$_GET['WithdrawalRequests'];		
		
		if(isset($_POST['delete_requests']))
		{
			if($ids = $_POST['request_ids'])
			{
				$criteria = new CDbCriteria;
				$criteria->addInCondition('request_id', $ids);
				WithdrawalRequests::model()->deleteAll($criteria);
								
				Yii::app()->user->setFlash('success', 'Requests deleted');
				$this->refresh();
			}
		}
		
		$this->render('withdrawal_requests', compact('model'));
	}
	
	function actionBilling($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id);
		$this->render('profile', compact('user'));
	}
	
	function actionTransaction($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id);
		$this->render('profile', compact('user'));
	}
	
	function actionRates($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id);
		$criteria=new CDbCriteria();
		$criteria->order = 'expiration_time DESC';
		$criteria->condition = 'user_id=:user_id';
		$criteria->params = array(':user_id' => $user_id);
		$count=RatesClosed::model()->count($criteria);
		$pages=new CPagination($count);
			
		// results per page
		$pages->pageSize=15;
		$pages->applyLimit($criteria);
		$rates=RatesClosed::model()->findAll($criteria);
		
		$this->render('rates', compact('user', 'rates', 'pages'));
	}
	
// 	function actionAddRate()
// 	{		
// 		$model = new RatesClosed;
// 		if(isset($_POST['RatesClosed']))
// 		{
// 			$model->attributes = $_POST['RatesClosed'];
// 			if($model->validate())
// 			{ 
// 				$atsUsers = Users::model()->findAll('ats=1'); 
// 				foreach($atsUsers as $user)
// 				{
// 					$model = new RatesClosed('ats'); 
// 					$model->attributes = $_POST['RatesClosed'];

// 					$model->user_id = $user->user_id; 
// 					if($_POST['RatesClosed']['win'] == 1) {
// 						$model->status = 3; 
// 						$user->balance += round($model->price_value * 0.85); 
// 					} else {
// 						$model->status = 2;
// 						$user->balance -= round($model->price_value);
// 					}
					
// 					$model->save(false); 
// 					$user->save(false);
					
// 					Yii::app()->user->setFlash('success', 'Rates added'); 
// 				}			
				
// 				$this->refresh(); 
// 			}
// 		}
		
// 		$this->render('rate', compact('model'));
// 	}
	
// 	function actionEdit_ats()
// 	{
		
// 	}
	
// 	function actionEdit($user_id)
// 	{
// 		$model = Users::model()->findByPk($user_id);
// 		$model->scenario = 'control';
// 		if(isset($_POST['delete']))
// 		{
// 			if($model->delete())
// 			{
// 				Yii::app()->user->setFlash('success', 'User deleted');		
// 				$this->redirect($this->createUrl('user/list'));
// 			}
// 		}
// 		if(isset($_POST['Users']))
// 		{
// 			$tmpPassword = $model->user_password;
// 			$model->attributes = $_POST['Users']; 
// 			$model->user_password = trim($model->user_password) == '' ? $tmpPassword : CPasswordHelper::hashPassword($model->user_password);
			
// 			if($model->validate())
// 			{ 
// 				$model->bonus+=$model->bonus_manually; 
// 				$model->balance+=$model->bonus_manually;
				
// 				if($cUploadedFile = CUploadedFile::getInstance($model,'scan'))
// 					$model->scan = $cUploadedFile;
				
// 				if($model->save())
// 				{
// 					if($cUploadedFile)
// 						$cUploadedFile->saveAs('uploads/scans/'.$cUploadedFile);
		
// 					Yii::app()->user->setFlash('success', '<strong>Success!</strong> User saved.');
// 					$this->refresh();
// 				}
// 			}
// 		}
		
// 		$this->render('edit', compact('model'));
// 	}
	

}
?>