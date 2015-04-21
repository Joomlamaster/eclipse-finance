<?php 
class UserController extends AdminController
{
	public $user; 
	
	function beforeAction($action)
	{ 
		if($action->id == 'login')
		{
			if(Yii::app()->user->isDude())
				$this->redirect('/admin');
		}
		
		$this->adminMenu = array(
            array('label' => 'Admin Operations'),
            array('label' => 'All users', 'icon' => 'th-list', 'url' => array($this->createUrl('user/list')), 'active' => $this->action->id == 'list' ? true : false),
			array('label' => 'ATS users', 'icon' => 'th-list', 'url' => array($this->createUrl('user/ats')), 'active' => $this->action->id == 'ats' ? true : false),
			array('label' => 'RM users', 'icon' => 'th-list', 'url' => array($this->createUrl('user/rm')), 'active' => $this->action->id == 'rm' ? true : false, 'visible' => Yii::app()->user->checkAccess('pronik')),				
			array('label' => 'Withdrawal requests', 'icon' => 'th-list', 'url' => array($this->createUrl('user/withdrawal_requests')), 'active' => $this->action->id == 'withdrawal_requests' ? true : false),				
    	); 		
		
		Yii::app()->clientScript->registerPackage('jquery'); 
		Yii::app()->clientScript->registerPackage('bootstrap'); 
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery.fileupload-ui.css');
		if($action->id == 'addrate')
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
	
	function actionRm()
	{
		$model=new Users('search_rm');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
			
		$this->render('list', compact('model'));
	}	
	
	function actionProfile($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id);
		$this->render('profile', compact('user'));
	}	
	
	function actionBilling($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id);
		$this->render('profile', compact('user'));
	}
	
	function actionTransaction($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id);
		$model = new Transactions('search');
		$model->unsetAttributes();  // clear any default values
		$model->user_id = $user_id;
		if(isset($_GET['Transactions']))
			$model->attributes=$_GET['Transactions'];
				
		$this->render('transactions', compact('user', 'model'));
	}
	
	function actionRates($user_id)
	{
		$user = $this->user = Users::model()->findByPk($user_id);
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
		
		$this->render('rates', compact('user', 'rates', 'pages'));
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
				$model->bonus+=$model->bonus_manually; 
				$model->balance+=$model->bonus_manually;
				
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
	
	function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);		
	}
}
?>