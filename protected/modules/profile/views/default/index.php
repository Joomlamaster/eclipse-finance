<style>
input#Users_user_phone {
float: left;
}
.profile-container {
   padding: 1px 40px !important;
}
.container-head {
   background: url("../../images/logo-personal-2.png") no-repeat scroll 0 0 #17181b;
}
/*h1.heading.profile, h1.heading.login, h1.heading.invest {
      background: url("../../images/logo-personal-2.png") no-repeat scroll 0 4px #17181b !important;
}*/
h1.heading.profile, h1.heading.login, h1.heading.invest {
   background: url("/assets/1e83dde4/img/head-bg.png") no-repeat scroll 0 0 / 100% auto rgba(0, 0, 0, 0) !important;
}
</style>
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
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'horizontalForm',
	'type' => 'horizontal',
	//'class' => 'form-horizontal',
	'inlineErrors' => false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>	
<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model, 'first_name', ['disabled' => 'disabled']); ?>
	<?php echo $form->textFieldRow($model, 'last_name', ['disabled' => 'disabled']); ?>
 

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
	
	<div class="control-group ">
		<label class="control-label required" for="Users_last_name">Scan of document</label>
		<div class="controls">
		     <span class="btn btn-primary fileinput-button">       
		    	<i class="icon-plus icon-white"></i> <span>Add scan of document</span>
		    	<?php echo $form->fileField($model, 'scan', array('style' => 'margin: 0 0 16px;')); ?>       
		   	</span>		
			<span class="help-block error" id="Users_last_name_em_" style="display: none"></span>
			<?php echo $form->error($model,'scan'); ?>	
		</div>
	</div>	

	<?php echo $form->textFieldRow($model, 'user_email', ['disabled' => 'disabled']); ?>
	<?php echo $form->dropDownListRow($model, 'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 'name'), array('class' => '', 'prompt'=>'Select a country')); ?>
	<?php echo $form->textFieldRow($model, 'city'); ?>
	<?php echo $form->textFieldRow($model, 'house'); ?>
 	<?php echo $form->textFieldRow($model, 'user_phone'); ?>
       
    
    <div class="field submit" style="padding-left: 180px;">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-brown', 'style' => 'margin-top:20px;')); ?>
        <?php if(Yii::app()->controller->action->id == 'edit'): ?>
        	<?php echo CHtml::submitButton('Delete', array('name' => 'delete', 'class' => 'btn btn-danger', 'style' => 'margin-top:20px;', 'onClick' => 'return _confirm("Confirm action", "Delete user?", this)')); ?>
        <?php endif; ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->