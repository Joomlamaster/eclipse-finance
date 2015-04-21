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
        <?php echo $form->labelEx($model,'user_email'); ?>
        <?php echo $form->textField($model,'user_email'); ?>
    </div>  
    
    <div class="field">
        <?php echo $form->labelEx($model,'partner_percent'); ?>
        <?php echo $form->textField($model,'partner_percent'); ?>
    </div>            
  
    <div class="field">
        <?php echo $form->labelEx($model,'user_password'); ?>
        <?php echo $form->textField($model,'user_password', $this->action->id == 'edit' ? array('value' => '') : array()); ?>
    </div>
    <!--  
	<div class="field">
		<?php echo $form->labelEx($model,'password_repeat'); ?>
		<?php echo $form->textField($model,'password_repeat'); ?>
	</div>
	-->    
    <div class="field submit">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn', 'style' => 'margin-top:20px;')); ?>
        <?php if(Yii::app()->controller->action->id == 'edit'): ?>
        	<?php echo CHtml::submitButton('Delete', array('name' => 'delete', 'class' => 'btn btn-danger', 'style' => 'margin-top:20px;', 'onClick' => "return _confirm('Confirm action', 'Delete user?', this)")); ?>
        <?php endif; ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->