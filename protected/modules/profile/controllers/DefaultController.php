<?php
class DefaultController extends ProfileController
{
	public $layout = 'main'; 
	function beforeAction($action)
	{
		if (Yii::app()->user->isGuest)
		{
			if($action->id == 'index')
				$this->redirect($this->createUrl('user/registration'));
			Yii::app()->user->loginRequired();
		}
		
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery.fileupload-ui.css');
	
		return parent::beforeAction($action);
	}	
	
	public function actionIndex()
	{
		$model = Users::model()->findByPk(Yii::app()->user->id);
		$model->scenario = 'profile';
		
		if(isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
				
			if($model->validate())
			{
				if($cUploadedFile = CUploadedFile::getInstance($model,'scan'))
					$model->scan = $cUploadedFile;
		
				if($model->save())
				{
					if($cUploadedFile)
						$cUploadedFile->saveAs('uploads/scans/'.$cUploadedFile);
		
					Yii::app()->user->setFlash('success', '<strong>Success!</strong> Saved.');
					$this->refresh();
				}
			}
		}		
		
		$this->render('index', compact('model'));
	}
	
	function actionlogin()
	{
		$user = Users::model()->findByPk(Yii::app()->user->id);
		$model = new ChangePasswordForm;
		if(isset($_POST['ChangePasswordForm']))
		{
			$model->attributes = $_POST['ChangePasswordForm'];
			if($model->validate())
			{
				$user = Users::model()->findByPk(Yii::app()->user->id);
				$user->user_password = CPasswordHelper::hashPassword($model->passwordNew);
				$user->save();
		
				Yii::app()->user->setFlash('success', 'Password updated');
				$this->refresh();
			}
		}
				
		$this->render('login', compact('model'));
	}
	
	function actionRates()
	{
		$criteria=new CDbCriteria();
		$criteria->order = 'rate_end_time DESC';
		$criteria->condition = 'user_id=:user_id';
		$criteria->params = array(':user_id' => Yii::app()->user->id);
		$count=RatesClosed::model()->count($criteria);
		$pages=new CPagination($count);
			
		// results per page
		$pages->pageSize=15;
		$pages->applyLimit($criteria);
		$rates=RatesClosed::model()->findAll($criteria);
				
		$this->render('rates', compact('rates', 'pages', 'statuses')); 
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}