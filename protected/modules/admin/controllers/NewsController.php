<?php
class NewsController extends AdminController
{
	
	public function beforeAction($action)
	{
		$this->adminMenu = array(
            array('label' => 'Admin Operations'),
            array('label' => 'Список', 'icon' => 'home', 'url' => array($this->createUrl('news/index')), 'active' => Yii::app()->controller->action->id == 'index' ? true : false),
            array('label' => 'Добавить', 'icon' => 'add', 'url' => array($this->createUrl('news/add')), 'active' => Yii::app()->controller->action->id == 'add' ? true : false),
    	); 
		return parent::beforeAction($action); 
	}

	
	public function actionIndex()
	{
	    $criteria=new CDbCriteria();
	    $criteria->order = 'date_unix DESC'; 
	    $count=News::model()->count($criteria);
	    $pages=new CPagination($count);
	
	    // results per page
	    $pages->pageSize=10;
	    $pages->applyLimit($criteria);
	    $news=News::model()->findAll($criteria);  
	
	    $this->render('index', compact('news', 'pages'));    		
	}
	
	function actionEdit($news_id)
	{
		if(!$model = News::model()->find('news_id=:news_id', array(':news_id' => intval($news_id))))
			throw new CHttpException(404,'Такая страница не существует');
		
		$current_image = $model->cover; 
		if($_POST['delete'])
		{
			@unlink('uploads/news/'.$current_image);
			$model->cover = null;
			$model->save(); 
			Yii::app()->user->setFlash('success', 'Изображение удалено');
			$this->refresh();
		}
		if($_POST['save'])
		{
			$model->attributes=$_POST['News'];
			$model->date_unix = $this->createDate($model->date);
			if($cUploadedFile = CUploadedFile::getInstance($model,'cover'))
				$model->cover = FileHelper::toHash($cUploadedFile);
			 
			if($model->save())
			{ 
				if(is_object($cUploadedFile))
				{
					@unlink('uploads/news/'.$current_image);
					$cUploadedFile->saveAs('uploads/news/'.$model->cover);
				}
					
				Yii::app()->user->setFlash('success', '<strong>Ок!</strong> Новость успешно сохранена.');
				$this->refresh(); 
			}
			else
			{
				$model->getErrors(); 
			}
		}
		
		$this->render('edit', compact('model'));  
	}
	
	function actionAdd()
	{
		$model = new News; 
		
		if($_POST['save'])
		{
			$model->attributes=$_POST['News'];
			$model->date_unix = $this->createDate($model->date);
			$model->cover = CUploadedFile::getInstance($model,'cover');

			if($model->save())
			{
				if(is_object($model->cover))
					$model->cover->saveAs('uploads/news/'.$model->cover);
								
				Yii::app()->user->setFlash('success', '<strong>Ок!</strong> Новость успешно сохранена.');
				$this->redirect($this->createUrl('/admin/news'));
			}
			else
			{
				$model->getErrors(); 
			}
		}	
		
		$this->render('edit', compact('model'));  		
	}
	
	function actionDelete($news_id)
	{
		if(!$model = News::model()->find('news_id=:news_id', array(':news_id' => intval($news_id))))
			throw new CHttpException(404,'Такая страница не существует');
		
		if($model->delete())
			Yii::app()->user->setFlash('success', 'Новость удалена.');
		else
			Yii::app()->user->setFlash('error', '<strong>Ошибка</strong> Произошла ошибка при удалении.');
		
		$this->redirect($this->createUrl('/admin/news'));		
	}
	
	function createDate($date)
	{
		if(list($m, $d, $y) = explode('/', $date))
			return mktime(0,0,0, $m, $d, $y);
		
		return null;
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