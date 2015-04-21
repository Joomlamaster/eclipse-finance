<?php
class PagesController extends AdminController
{
	public $pages_list = array(); 
	public $pages_tree_html = '';	
	
	public $pages = array();
	
	public function beforeAction($action)
	{
		$this->adminMenus = array(
			array(
				array('label' => 'Admin Operations'),
            	array('label' => 'Tree', 'icon' => 'home', 'url' => array($this->createUrl('pages/index')), 'active' => Yii::app()->controller->action->id == 'index' ? true : false),
           		array('label' => 'Add', 'icon' => 'plus', 'url' => array($this->createUrl('pages/add')), 'active' => Yii::app()->controller->action->id == 'add' ? true : false),
    		),
// 			array(
// 				array('label' => 'Custom Pages'),
// 				//array('label' => 'ATS', 'icon' => 'icon-align-justify', 'url' => array($this->createUrl('pages/ats')), 'active' => Yii::app()->controller->action->id == 'ats' ? true : false),
// 			),
			array(
				array('label' => 'Deposit pages'),
				array('label' => 'Neteller', 'icon' => 'icon-align-justify', 'url' => array($this->createUrl('pages/neteller')), 'active' => Yii::app()->controller->action->id == 'neteller' ? true : false),
				array('label' => 'Wire', 'icon' => 'icon-align-justify', 'url' => array($this->createUrl('pages/wire')), 'active' => Yii::app()->controller->action->id == 'wire' ? true : false),
			)
    	);
 
		return parent::beforeAction($action); 
	}
	
	public function actionIndex()
	{
		$this->pages = Pages::model()->getPagesTree();
		$this->render('index', array('pages' => $this->pages));
	}
	
	function actionAdd()
	{
		$model = new Pages; 
		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
			//$model->weight = $_POST['Pages']['weight']; 
			$model->page_type = 'htt'; 
			if($model->validate())
			{
				if($model->save())
				{ 
					Yii::app()->user->setFlash('success', '<strong>Ok!</strong> Saved.');
					$this->redirect($this->createUrl('pages/edit', array('page_id' => $model->page_id))); 
				}
				else
					$model->getErrors(); 
			}			
		}
		$this->render('edit', compact('model'));
	}
	
	function actionEdit($page_id)
	{
		if(!($model = Pages::model()->find('page_id=:page_id', array('page_id' => intval($page_id)))))
			throw new CHttpException(404,'Page not found.');

		if(isset($_POST['delete']))
		{
			if($model->delete())
			{
				Yii::app()->user->setFlash('success', '<strong>Ok!</strong> Page deleted.');
				$this->redirect($this->createUrl('pages/index'));
			}
		}
		if(isset($_POST['Pages']))
		{ 
			$model->attributes=$_POST['Pages']; 
			//$model->weight = $_POST['Pages']['weight']; 
			if($model->validate())
			{ 
				if($model->save())
				{ 
					Yii::app()->user->setFlash('success', '<strong>Ok!</strong> Saved.');
					$this->refresh(); 
				}
				else
					$model->getErrors(); 
			}			
		}
		$this->render('edit', compact('model'));
	}
	
	function actionAts()
	{
		$model = Pages::model()->getPageByActionId(); 
		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
			if($model->validate())
			{
				if($model->save())
				{
					Yii::app()->user->setFlash('success', '<strong>Ok!</strong> Saved.');
					$this->refresh();
				}
				else
					$model->getErrors();
			}
		}		
		$this->render('edit', compact('model'));
	}
	
	function actionNeteller()
	{
		$model = Pages::model()->getPageByType('neteller_page');
		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
			if($model->validate())
			{
				if($model->save())
				{
					Yii::app()->user->setFlash('success', '<strong>Ok!</strong> Saved.');
					$this->refresh();
				}
				else
					$model->getErrors();
			}
		}
		$this->render('edit', compact('model'));
	}	
	
	function actionWire()
	{
		$model = Pages::model()->getPageByType('wire_page');
		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
			if($model->validate())
			{
				if($model->save())
				{
					Yii::app()->user->setFlash('success', '<strong>Ok!</strong> Saved.');
					$this->refresh();
				}
				else
					$model->getErrors();
			}
		}
		$this->render('edit', compact('model'));
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