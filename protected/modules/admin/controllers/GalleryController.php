<?php
class GalleryController extends AdminController
{
	
	public function actions() 
	{
		return array(
			'upload' => array(
				'class' => 'xupload.actions.CXUploadAction', 
				'path' => Yii::app()->getBasePath() . "/../uploads/gallery", 
				"publicPath" => Yii::app()->getBaseUrl()."/uploads/gallery",
			), 
		);
	}	
		
	public function beforeAction($action)
	{
		$this->adminMenu = array(
            array('label' => 'Admin Operations'),
            array('label' => 'Главная', 'icon' => 'home', 'url' => array($this->createUrl('gallery/index')), 'active' => Yii::app()->controller->action->id == 'index' ? true : false),
            array('label' => 'Фото галерея', 'icon' => 'add', 'url' => array($this->createUrl('gallery/photo')), 'active' => Yii::app()->controller->action->id == 'photo' ? true : false),
            array('label' => 'Видео галерея', 'icon' => 'add', 'url' => array($this->createUrl('gallery/video')), 'active' => Yii::app()->controller->action->id == 'video' ? true : false),
            array(
            	'label' => 'Категории', 
            	'icon' => 'categories', 
            	'url' => array($this->createUrl('gallery/categories_list')), 
            	'active' => Yii::app()->controller->action->id == 'categories_list' ||  
            				Yii::app()->controller->action->id == 'category_edit' || 
            				Yii::app()->controller->action->id == 'category_add' ? true : false),
		); 
		Yii::app()->clientScript->registerPackage('fancybox');
		return parent::beforeAction($action); 
	}
		
	public function actionIndex()
	{
		$this->render('index');
	}
	
	function actionAddVideoCode($cat_id=null)
	{
		$category = new GalleryCategories; 
		if($cat_id)
		{
			$category = GalleryCategories::model()->find(array('condition' => 'is_video=1 AND category_id='.intval($cat_id)));
			if(!$category)
				throw new CHttpException(404, 'Категория не сущесвует');
		}
		$model = new Gallery;
		if(isset($_POST['Gallery']))
		{
			$model->player_code = $_POST['Gallery']['player_code'];
			$model->is_youtube = 1; 
			$model->is_video = 1;
			$model->category_id = $cat_id;
			
			if($model->save())
			{
				Yii::app()->clientScript->render($clientScripts); 
				echo $clientScripts; 				
				echo '<script>$(function(){ parent.$.fancybox.closeEv = true; parent.$.fancybox.close(); }); </script>'; 
			}
		}

		$this->renderPartial('addVideoCode', compact('model'));
	}

	function actionPhoto($cat_id = null)
	{
		$category = new GalleryCategories; 
		$criteria = new CDbCriteria;
		$criteria->condition = 'is_photo=1';
		$criteria->order = 'file_id DESC';			
		if($cat_id)
		{
			$category = GalleryCategories::model()->find(array('condition' => 'is_photo=1 AND category_id='.intval($cat_id)));
			if(!$category)
				throw new CHttpException(404, 'Категория не сущесвует');
			$criteria->addCondition('category_id='.intval($cat_id)); 
		}
		Yii::import("xupload.models.PhotoXUploadForm");
		$model = new PhotoXUploadForm;
		
		$categories = GalleryCategories::model()->findAll('is_photo=1');  		
		
		$dataProvider=new CActiveDataProvider('Gallery', array(
		    'criteria'=>$criteria,
		    'countCriteria'=>$criteria,
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));		
		
		if($_POST['delete'])
		{
			if(false == empty($_POST['files']))
			{
				$criteria = new CDbCriteria();
				$criteria->addInCondition("file_id", $_POST['files']);
				$result = Gallery::model()->findAll($criteria);
				foreach($result as $value)
				{
					@unlink('uploads/gallery/photo/small_'.$value->filename); 
					@unlink('uploads/gallery/photo/'.$value->filename);
					$value->delete(); 
				}
				Yii::app()->user->setFlash('success', 'Файлы успешно удалены');
			}
			else
			{
				Yii::app()->user->setFlash('warning', 'Нет выбранных файлов');
			}
		}
		if($_POST['save'])
		{
			if(Yii::app( )->user->hasState('xuploadFiles'))
			{
				$files = Yii::app( )->user->getState('xuploadFiles'); 
				foreach($files as $filename => $file)
				{
					$model = new Gallery;
					$model->category_id = $category->category_id; 
					$model->filename = $filename; 
					$model->size = $file['size']; 
					$model->mime = $file['mime']; 
					$model->is_photo = 1; 
					$model->save(); 
				}
				
				Yii::app( )->user->setState('xuploadFiles', null); 
				Yii::app()->user->setFlash('success', 'Файлы успешно сохранены');
				$this->refresh();
			}
			else
			{ 
				Yii::app()->user->setFlash('warning', 'Нет загруженных файлов');
			}
		}
		//var_dump(Yii::app( )->user->getState('xuploadFiles')); 
		
		//echo CFileHelper::getExtension(Yii::app()->getBasePath()."/../uploads/gallery/EPD_1.jpg");
		
		//$image = Yii::app()->image->load(Yii::app()->getBasePath()."/../uploads/gallery/EPD_1.jpg");
		//$image->resize(700, 700)->rotate(-45)->quality(75)->sharpen(20);
		//$image->resize(700, null)->quality(100);
		//$image->save(Yii::app()->getBasePath()."/../uploads/gallery/small.jpg");	
			
		$this->render('upload', compact('model', 'gallery', 'dataProvider', 'categories'));			
	}
	
	function actionVideo($cat_id = null)
	{
		$category = new GalleryCategories; 
		$criteria = new CDbCriteria;
		$criteria->condition = 'is_video=1';
		$criteria->order = 'file_id DESC';			
		if($cat_id)
		{
			$category = GalleryCategories::model()->find(array('condition' => 'is_video=1 AND category_id='.intval($cat_id)));
			if(!$category)
				throw new CHttpException(404, 'Такая страница не существует');
			$criteria->addCondition('category_id='.intval($cat_id)); 
		}		
		Yii::import("xupload.models.VideoXUploadForm");
		$model = new VideoXUploadForm;
		
		$categories = GalleryCategories::model()->findAll('is_video=1'); 
		
		$dataProvider=new CActiveDataProvider('Gallery', array(
		    'criteria'=>$criteria,
		    'countCriteria'=>$criteria,
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));		
		
		if($_POST['delete'])
		{
			if(false == empty($_POST['files']))
			{
				$criteria = new CDbCriteria();
				$criteria->addInCondition("file_id", $_POST['files']);
				$result = Gallery::model()->findAll($criteria);
				foreach($result as $value)
				{
					@unlink('uploads/gallery/video/covers/'.$value->cover);
					@unlink('uploads/gallery/video/'.$value->filename);
					$value->delete(); 
				}
				Yii::app()->user->setFlash('success', 'Файлы успешно удалены');
			}
			else
			{
				Yii::app()->user->setFlash('warning', 'Нет выбранных файлов');
			}
		}
		if($_POST['save'])
		{
			if(Yii::app( )->user->hasState('xuploadFiles'))
			{
				$files = Yii::app( )->user->getState('xuploadFiles'); 
				foreach($files as $filename => $file)
				{
					$model = new Gallery;
					$model->category_id = $category->category_id; 
					$model->filename = $filename; 
					$model->size = $file['size']; 
					$model->mime = $file['mime']; 
					$model->is_video = 1; 
					$model->save(); 
				}
				
				Yii::app()->user->setState('xuploadFiles', null); 
				Yii::app()->user->setFlash('success', 'Файлы успешно сохранены');
				$this->refresh();
			}
			else
			{ 
				Yii::app()->user->setFlash('warning', 'Нет загруженных файлов');
			}
		}	
			
		$this->render('upload', compact('model', 'gallery', 'dataProvider', 'categories'));		
	}
	
	function actionAdd_comment($id = null)
	{
		$model = Gallery::model()->find('file_id=:file_id', array(':file_id' => $id));
		$current_image = $model->cover; 
		
		$categories = new GalleryCategories; 
		if($model->is_video)
			$categories = GalleryCategories::model()->findAll('is_video=1');
		elseif($model->is_photo)
			$categories = GalleryCategories::model()->findAll('is_photo=1');  
		
		if(isset($_POST['Gallery']))
		{ 
			if($model->validate())
			{
				$model->setAttributes($_POST['Gallery'], false);
				if($cUploadedFile = CUploadedFile::getInstance($model,'cover'))
					$model->cover = FileHelper::toHash($cUploadedFile);
								
				if($model->save())
				{
					if(is_object($cUploadedFile))
					{
						@unlink('uploads/gallery/video/covers/'.$current_image);
						$cUploadedFile->saveAs('uploads/gallery/video/covers/'.$model->cover);
					}					
					$this->refresh();
				} 
			}
		}
		
		$this->renderPartial('add_comment', compact('model', 'categories')); 
	}
	
	
	
	
	function actionCategories_list($type = null)
	{
		$criteria = new CDbCriteria; 
		$criteria->order = 'is_photo DESC'; 
		if($type)
		{
			if($type == 'photo')
				$criteria->condition='is_photo=1';
			elseif($type == 'video')
				$criteria->condition='is_video=1';
		}
		$items = GalleryCategories::model()->findAll($criteria);
		$this->render('categories_list', compact('items', 'type'));
	}
	
	function actionCategory_add()
	{
		$model = new GalleryCategories;
		if(isset($_POST['GalleryCategories']))
		{
			$model->attributes = $_POST['GalleryCategories'];
			if($model->validate())
			{
				$model->is_video = intval($_POST['GalleryCategories']['type'] == 'video');
				$model->is_photo = intval($_POST['GalleryCategories']['type'] == 'photo');
				if($model->save())
				{
					Yii::app()->user->setFlash('success', '<strong>Поздравляем! </strong> Категория успешно добавлена');
					$this->redirect($this->createUrl('gallery/categories_list'));
				}
				else
					Yii::app()->user->setFlash('error', 'Произошла ошибка при записи в базу');
			}	
		}
		
		$this->render('category_edit', compact('model'));
	}
	
	function actionCategory_edit($cat_id)
	{
		$model = GalleryCategories::model()->findByPk($cat_id);
		$model->type = $model->is_video ? 'video' : 'photo';
		if(isset($_POST['GalleryCategories']))
		{
			$model->attributes = $_POST['GalleryCategories'];
			if($model->validate())
			{
				$model->is_video = intval($_POST['GalleryCategories']['type'] == 'video');
				$model->is_photo = intval($_POST['GalleryCategories']['type'] == 'photo');
				if($model->save())
				{
					Yii::app()->user->setFlash('success', '<strong>Поздравляем! </strong> Категория успешно добавлена');
					$this->refresh();
				}
				else
					Yii::app()->user->setFlash('error', 'Произошла ошибка при записи в базу');
			}	
		}		
		$this->render('category_edit', compact('model'));
	}
	
	function actionCategory_delete($cat_id)
	{
		if($model = GalleryCategories::model()->findByPk($cat_id))
		{
			Yii::app()->user->setFlash('success', 'Категория удалена');
			$model->delete();
		}
		$this->redirect($this->createUrl('gallery/categories_list'));	
	}
	
}