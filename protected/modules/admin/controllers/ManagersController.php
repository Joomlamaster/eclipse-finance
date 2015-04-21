<?php

class ManagersController extends AdminController
{
	
	public function filters()
	{
		return array(
				'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
					'roles'=>array('admin'),
			),
			array('deny',
					'roles'=>array('manager'),
					'users' => array('*')
			),				
		);
	}	
	
	function beforeAction($action)
	{
		if($action->id == 'login')
		{
			if(Yii::app()->user->isAdmin())
				$this->redirect('/admin');
		}
	
		$this->adminMenu = array(
			array('label' => 'Admin Operations'),
			array('label' => 'List', 'icon' => 'th-list', 'url' => array($this->createUrl('managers/index')), 'active' => Yii::app()->controller->action->id == 'index' ? true : false),
			array('label' => 'Add', 'icon' => 'plus', 'url' => array($this->createUrl('managers/add')), 'active' => Yii::app()->controller->action->id == 'add' ? true : false),
		);
	
		Yii::app()->clientScript->registerPackage('jquery');
		Yii::app()->clientScript->registerPackage('bootstrap');
		//Yii::app()->clientScript->registerPackage('main');
	
		return parent::beforeAction($action);
	}

	
	public function actionIndex()
	{
		$criteria=new CDbCriteria();
		$criteria->condition = 'role="manager"';
		$count=Users::model()->count($criteria);
		$pages=new CPagination($count);
		
		// results per page
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$users=Users::model()->findAll($criteria);
				
		$this->render('index', compact('users', 'pages'));
	}
	
	function actionAdd()
	{ 
		$model = new Users('management');
		if(isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users']; 
			$model->role = 'manager';
		
			if($model->validate())
			{
				if($model->save())
				{
					Yii::app()->user->setFlash('success', '<strong>Success!</strong> User saved.');
					$this->refresh();
				}
			}
		}
		
		$this->render('edit', compact('model'));
	}
	
	function actionEdit($user_id)
	{
		$model = Users::model()->findByPk($user_id);
		$model->scenario = 'management';
		if(isset($_POST['delete']))
		{
			if($model->delete())
			{
				Yii::app()->user->setFlash('success', 'User deleted');		
				$this->redirect($this->createUrl('managers/index'));
			}
		}
		if(isset($_POST['Users']))
		{
			$tmpPassword = $model->user_password;
			$model->attributes = $_POST['Users']; 
			$model->user_password = trim($model->user_password) == '' ? $tmpPassword : CPasswordHelper::hashPassword($model->user_password);
		
			if($model->validate())
			{
				if($model->save())
				{
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
		
		$this->redirect($this->createUrl('managers/index'));
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