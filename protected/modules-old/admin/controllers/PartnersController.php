<?php
class PartnersController extends AdminController
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
			array('label' => 'List', 'icon' => 'th-list', 'url' => array($this->createUrl('partners/index')), 'active' => Yii::app()->controller->action->id == 'index' ? true : false),
			array('label' => 'Add', 'icon' => 'plus', 'url' => array($this->createUrl('partners/add')), 'active' => Yii::app()->controller->action->id == 'add' ? true : false),
		);
	
		Yii::app()->clientScript->registerPackage('jquery');
		Yii::app()->clientScript->registerPackage('bootstrap');
		Yii::app()->clientScript->registerPackage('fancybox');
		//Yii::app()->clientScript->registerPackage('main');
	
		return parent::beforeAction($action);
	}

	
	public function actionIndex()
	{
		$criteria=new CDbCriteria();
		$criteria->condition = 'role="partner"';
		$count=Users::model()->count($criteria);
		$pages=new CPagination($count);
		
		// results per page
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$users=Users::model()->findAll($criteria);
				
		$this->render('index', compact('users', 'pages'));
	}
	
	function actionUsers($partner_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'partner_id=:partner_id';
		//$criteria->with = 'currency';
		$criteria->params = array(':partner_id' => $partner_id);
		$users = Users::model()->findAll($criteria);
		$partner = Users::model()->findByPk($partner_id); 
		$this->render('users', compact('partner', 'users'));		
	}
	
	function actionAdd()
	{ 
		$model = new Users('partners');
		if(isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users']; 
			$model->role = 'partner';
					
			if($model->validate())
			{
				if($model->save())
				{
					Yii::app()->user->setFlash('success', '<strong>Success!</strong> User saved.');
					$this->redirect($this->createUrl('/admin/partners/index'));
				}
			}
		}
		
		$this->render('edit', compact('model','partner'));
	}
	
	function actionEdit($user_id)
	{
		$model = Users::model()->findByPk($user_id);
		$model->scenario = 'partners';
		if(isset($_POST['delete']))
		{
			$model->delete();
			Yii::app()->user->setFlash('success', 'User deleted');		
			$this->redirect($this->createUrl('partners/index'));
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
		
		$this->render('edit', compact('model', 'partner'));
	}
	
	function actionPaid($user_id)
	{
		if($model = Users::model()->findByPk($user_id))
		{
			if($partner_id = $model->partner_id)
			{
				$model->partner_id=null;
				$model->save(false); 
			}
		}
		$this->redirect($this->createUrl('/admin/partners/users', array('partner_id' => $partner_id)));
	}

	function actionDelete($user_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 't.user_id=:user_id';
		$criteria->params = array(':user_id' => intval($user_id)); 
		if(!$model = Users::model()->find($criteria))
			throw new CHttpException(404, 'Page not found');		
		if($model->delete())
			Yii::app()->user->setFlash('success', 'User deleted');
		
		$this->redirect($this->createUrl('partners/index'));
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