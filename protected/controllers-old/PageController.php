<?php

class PageController extends SiteController
{
	public $layout = '//layouts/column1';
	public $pages=array();
	public $section;
	public $page; 
	
	
	function beforeAction($action)
	{
		if(parent::beforeAction($action))
		{
			$this->pages = Pages::model()->getPagesTree(); 
			return true;
		}
	}	
	
	public function actionIndex()
	{
		$page = $this->page = Pages::model()->findByPk(1);
		$this->render('show', compact('page'));
	}
	
	public function actionShow($page_id)
	{
		$page = $this->page = Pages::model()->findByPk($page_id);
		if(in_array($page_id, array(20, 14)))
			$this->layout = '//layouts/column2'; 
		$this->render('show', compact('page'));
	}
	
	function actionFaq()
	{
		$page = Pages::model()->findByPk(2);
		$this->render('show', compact('page'));		
	}
	
	function actionContact_us()
	{
		$model = new FeedbackForm;
		if(isset($_POST['FeedbackForm']))
		{
			$model->attributes = $_POST['FeedbackForm'];
			if($model->validate())
			{
				$mail = new YiiMailer();
				$mail->setView('feedback');
				$mail->setData($model->attributes);
				$mail->setFrom('info@eclipse-finance.com', 'FeedBack'); //Yii::app()->params['adminEmail']
				$mail->setTo(Yii::app()->params['adminEmail']);
				$mail->setSubject($model->subject);
				//$mail->setBody($activation_url);
				$mail->send();
					
				Yii::app()->user->setFlash('success', 'Message has been sent successfully.');
		
				$this->refresh(true, '#verticalForm');
			}
		}
		$this->layout = 'main'; 
		$this->render('contuctus', compact('model'));
	}
	
	function beforeRender($view)
	{
		parent::beforeRender($view); 
		$this->section = 'options'; 
		if($this->page)
		{
			if($page = Pages::model()->findByPk($this->page->pid))
				$this->section = $page->section_name; 
		} 
		return true; 
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