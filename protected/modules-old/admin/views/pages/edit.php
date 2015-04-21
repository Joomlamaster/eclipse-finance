<?php
/* @var $this PagesController */

$this->breadcrumbs=array(
	'Page edit',
);
?>

<div class="form">
<?php 
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'×', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
	    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
    )
));
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'verticalForm',
		'type'=>'vertical',
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	));  ?> 
<?php echo $form->errorSummary($model); ?>

 
 
    <div class="field">
        <?php echo $form->label($model,'page_name'); ?>
        <?php echo $form->textField($model,'page_name', array('style' => 'width:500px')) ?>
    </div>
 
    <div class="field">
        <?php echo $form->label($model,'page_title'); ?>
        <?php echo $form->textField($model,'page_title'); ?>
    </div>         
    <div class="field">
        <?php echo $form->label($model,'page_url'); ?>
        <?php echo $form->textField($model,'page_url', array('style' => 'width:500px')) ?>
    </div>      
    <?php if($this->id == 'edit' || Yii::app()->controller->action->id == 'add'): ?>
    <div class="field">
        <?php echo $form->label($model,'pid'); ?>
        <?php echo $form->dropDownList($model, 'pid', CHtml::listData(Pages::model()->findAll('pid=:pid', array(':pid' => 0)), 'page_id', 'page_name'), array('empty'=>'--Root--')); ?>
    </div>  
    
    
    <div class="field">
        <?php echo $form->checkboxRow($model,'footer') ?>
    </div>           
   <?php endif; ?>
    <div class="field">
       	<?php echo $form->ckEditorRow($model, 'page_body', array(
       		'options'=>array(
       			//'toolbar' => 'MyToolbar',
       	
       			'fullpage'=>'js:true', 
       			'width'=>'100%', 
       			'resize_maxWidth'=>'100%',
       			'filebrowserBrowseUrl' => Yii::app()->bootstrap->getAssetsUrl().'/js/ckeditor/filemanager/browser/default/browser.html?Connector='.Yii::app()->bootstrap->getAssetsUrl().'/js/ckeditor/filemanager/connectors/php/connector.php',
       			//'filebrowserImageBrowseUrl ' => Yii::app()->bootstrap->getAssetsUrl().'/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&amp;Connector='.Yii::app()->bootstrap->getAssetsUrl().'/js/ckeditor/filemanager/connectors/php/connector.php',
       			'filebrowserUploadUrl' => Yii::app()->bootstrap->getAssetsUrl().'/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
       			//'filebrowserBrowseUrl' => Yii::app()->bootstrap->getAssetsUrl().'/js/ckeditor/filemanager/connectors/php/connector.php',
        		//'filebrowserUploadUrl' => Yii::app()->bootstrap->getAssetsUrl().'/js/ckeditor/filemanager/connectors/php/connector.php',
        		//filebrowserImageWindowWidth : '640',
        		//filebrowserImageWindowHeight : '480'
       			//'resize_minWidth'=>'320'
       	)));?> 
    </div>
    
    <div class="field submit">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn', 'style' => 'margin-top:20px;')); ?>
        <?php if(Yii::app()->controller->action->id == 'edit'): ?>
        	<?php echo CHtml::submitButton('Delete', array('name' => 'delete', 'class' => 'btn btn-danger', 'style' => 'margin-top:20px;', 'onClick' => 'return confirm("Delete page?")')); ?>
        <?php endif; ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->