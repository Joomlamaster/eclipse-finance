<?php
/* @var $this PagesController */

$this->breadcrumbs=array(
	'User edit',
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
        <?php echo $form->labelEx($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name') ?>
    </div>
 
    <div class="field">
        <?php echo $form->labelEx($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name'); ?>
    </div>      
    
    <div class="field">
    	<?php echo $form->labelEx($model,'ats_group'); ?>
    	<?php echo $form->dropDownList($model, 'ats_group', $model->ats_groups, array('class' => '', 'prompt'=>'Select ats group')); ?>
        <?php //echo $form->checkboxRow($model,'ats'); ?>
    </div>    
    <?php if(Yii::app()->user->checkAccess('pronik')): ?>
    <div class="field">
    	<?php echo $form->checkboxRow($model, 'rm'); ?>
    </div>           
    <?php endif; ?>
    
	<?php echo $form->datepickerRow(
		$model,
		'user_birthday',
		array(
			//'options' => array('language' => 'es'),
			'hint' => '',
			'style' => 'width:100px',
			'prepend' => '<i class="icon-calendar"></i>'
		)
	); ?>    
	<?php if($model->scan): ?>
	<div class="row-fluid">
		<ul class="thumbnails">
			<li class="span3">
				<a href="#" class="thumbnail">
					<img src="/uploads/scans/<?php echo $model->scan; ?>" alt=""/>
				</a>
			</li>
		</ul>
	</div>	
	<?php endif; ?>
	<div class="field" style="margin-bottom:10px;">
		<?php //echo $form->labelEx($model, 'scan'); ?>    
	     <span class="btn btn-primary fileinput-button">       
	    	<i class="icon-plus icon-white"></i> <span>Add scan of document</span>
	    	<?php echo $form->fileField($model, 'scan', array('style' => 'margin: 0 0 16px;')); ?>       
	   	</span>   	
    	<?php echo $form->error($model,'scan'); ?>	
    </div> 	

    <div class="field">
        <?php echo $form->labelEx($model,'user_email'); ?>
        <?php echo $form->textField($model,'user_email'); ?>
    </div>   
    
    <div class="field">
        <?php echo $form->labelEx($model,'balance'); ?>
        <?php echo $form->textField($model,'balance', array('readonly' => true)); ?>
    </div>  
 
    <div class="field">
        <?php echo $form->labelEx($model,'bonus_manually', array('style' => 'color:red;')); ?>
        <?php echo $form->textField($model,'bonus_manually'); ?>
    </div>   
    
    <div class="field">
        <?php echo $form->labelEx($model,'manager_id'); ?>
        <?php echo $form->dropDownList($model, 'manager_id', CHtml::listData(Users::model()->findAll('role=:role', array(':role' => 'manager')), 'user_id', 'fullName')); ?>
    </div>          
    
    <div class="field">
        <?php echo $form->labelEx($model,'user_address'); ?>
        <?php echo $form->textarea($model,'user_address'); ?>
    </div>           
  
    <div class="field">
        <?php echo $form->labelEx($model,'user_password'); ?>
        <?php echo $form->textField($model,'user_password', array('value' => '')); ?>
    </div>
    
    <div class="field submit">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn', 'style' => 'margin-top:20px;')); ?>
        <?php if(Yii::app()->controller->action->id == 'edit'): ?>
        	<?php echo CHtml::submitButton('Delete', array('name' => 'delete', 'class' => 'btn btn-danger', 'style' => 'margin-top:20px;', 'onClick' => 'return _confirm("Confirm action", "Delete user?", this)')); ?>
        <?php endif; ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->