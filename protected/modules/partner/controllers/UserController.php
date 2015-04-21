<?php

class UserController extends PartnerController
{
	
	function beforeAction($action)
	{
		if(strtolower($action->id) == 'login')
		{
			if(Yii::app()->user->role == 'partner')
				$this->redirect('/partner');
		}
		return parent::beforeAction($action);
	}	

	function actionList()
	{
		$criteria = new CDbCriteria; 
		$criteria->condition = 'partner_id=:partner_id';
		//$criteria->with = 'currency';
		$criteria->params = array(':partner_id' => Yii::app()->user->id);
		$users = Users::model()->findAll($criteria); 
		$this->render('list', compact('users'));
	}	
	
	public function actionLogin()
	{
		if(isset($_POST['enter']))
		{
			$identity=new UserIdentity($_POST['login'],$_POST['pass']);
			if($identity->authenticate())
			{
				Yii::app()->user->login($identity, 0);
				if(!in_array(Yii::app()->user->role, array('admin', 'manager', 'partner')))
				{
					Yii::app()->user->setFlash('error', 'Access denied');
					$this->refresh();
				}
				else
					$this->redirect('/partner');
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
		Yii::app()->user->clearStates();
		Yii::app()->request->cookies->clear();
		
		$this->redirect(Yii::app()->homeUrl);		
	}	
	
	
}