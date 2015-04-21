<?php 
class ActionController extends UserController
{
	function beforeAction($action)
	{
		if(strtolower($action->id) == 'addrate')
		{
			Yii::app()->clientScript->registerPackage('dxfeed');
		}		
		return parent::beforeAction($action); 
	}
	
	function actionChancgeWithdrawalRequests($status_id, $request_id)
	{ 
		$model = WithdrawalRequests::model()->find('request_id=:request_id', array(':request_id' => intval($request_id)));
		if($model) {  
			$model->status_id = intval($status_id);
			$model->save(false); 
			echo CJSON::encode(array('status' => 'OK')); 
		} else {
			echo CJSON::encode(array('status' => 'ERR', 'msg' => 'User not found')); 
		}
	}
	
	function actionAddRate()
	{		
		$model = new RatesClosed;
		$model->scenario = 'ats';
		if(isset($_POST['RatesClosed']))
		{
			$model->attributes = $_POST['RatesClosed'];
			if($model->validate())
			{ 
				$criteria = new CDbCriteria;
				$criteria->addInCondition('ats_group', $model->ats_group); 
				$atsUsers = Users::model()->findAll($criteria); 
				if($atsUsers)
				{
					foreach($atsUsers as $user)
					{
						$model = new RatesClosed('ats'); 
						$model->attributes = $_POST['RatesClosed'];
	
						$model->user_id = $user->user_id; 
						if($_POST['RatesClosed']['win'] == 1) {
							$model->status = 3; 
							$user->balance += round($model->rate_value * 0.85); 
						} else {
							$model->status = 2;
							$user->balance -= round($model->rate_value);
						}
						
						$model->save(false); 
						$user->save(false);
						
						Yii::app()->user->setFlash('success', 'Rates added'); 
					}			
				} 
				else
					Yii::app()->user->setFlash('error', 'Users not found'); 
				
				$this->refresh(); 
			}
		}
		
		$this->render('rate', compact('model'));
	}
		
	
	function actionEdit($user_id)
	{
		$model = Users::model()->findByPk($user_id);
		$model->scenario = 'control';
		if(isset($_POST['delete']))
		{
			if($model->delete())
			{
				Yii::app()->user->setFlash('success', 'User deleted');
				$this->redirect($this->createUrl('user/list'));
			}
		}
		if(isset($_POST['Users']))
		{
			$tmpPassword = $model->user_password;
			$model->attributes = $_POST['Users'];
			$model->user_password = trim($model->user_password) == '' ? $tmpPassword : CPasswordHelper::hashPassword($model->user_password);
				
			if($model->validate())
			{
				if($cUploadedFile = CUploadedFile::getInstance($model,'scan'))
					$model->scan = $cUploadedFile;
	
				if($model->save())
				{
					if($cUploadedFile)
						$cUploadedFile->saveAs('uploads/scans/'.$cUploadedFile);
	
					Yii::app()->user->setFlash('success', '<strong>Success!</strong> User saved.');
					$this->refresh();
				}
			}
		}
	
		$this->render('edit', compact('model'));
	} 		
	
	function actionDelete($user_id)
	{
		if(!$model = Users::model()->find('user_id=:user_id', array(':user_id' => intval($user_id))))
			throw new CHttpException(404, 'Page not found');
		if($model->delete())
			Yii::app()->user->setFlash('success', 'User deleted');
	
		$this->redirect($this->createUrl('user/list'));
	}
	
	public function actionLogin()
	{
		if(isset($_POST['enter']))
		{
			$identity=new UserIdentity($_POST['login'],$_POST['pass']);
			if($identity->authenticate())
			{
				Yii::app()->user->login($identity, 0);
				if(!in_array(Yii::app()->user->role, array('admin', 'manager')))
				{
					Yii::app()->user->setFlash('error', 'Access denied');
					$this->refresh();
				}
				else
					$this->redirect('/admin');
			}
			else
				Yii::app()->user->setFlash('error', 'Input data error');
		}
		Yii::app()->clientScript->render($clientScripts);
		$this->renderPartial('login', compact('clientScripts'));
	}	
	
	function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}	
}

?>