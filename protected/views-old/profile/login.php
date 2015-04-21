<?php $this->beginContent('container'); ?>

<h3 class="title">Change password</h3>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
	<?php 
	$this->widget('bootstrap.widgets.TbAlert', array(
	    'block'=>true, // display a larger alert block?
	    'fade'=>true, // use transitions?
	    'closeText'=>'×', // close link text - if set to false, no close link is displayed
	    'alerts'=>array( // configurations per alert type
		    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
			'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
	    )
	));
	?>
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'verticalForm',
		'type'=>'vertical',
		//'enableClientValidation'=>true,
		'clientOptions'=>array(
		//	'validateOnSubmit'=>true,
		),
	)); ?>
	<div class="field">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="field">
		<?php echo $form->labelEx($model,'passwordNew'); ?>
		<?php echo $form->passwordField($model,'passwordNew'); ?>
		<?php echo $form->error($model,'passwordNew'); ?>
	</div>

	<div class="field">
		<?php echo $form->labelEx($model,'passwordRepeat'); ?>
		<?php echo $form->passwordField($model,'passwordRepeat'); ?>
		<?php echo $form->error($model,'passwordRepeat'); ?>
	</div>
		
	<div class="field">
		<?php echo CHtml::submitButton('save changes', array('name' => 'save', 'class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php $this->endContent();?>