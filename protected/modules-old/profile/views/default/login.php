<!-- <h3 class="title">Change password</h3> -->

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
	<?php echo $form->passwordFieldRow($model, 'password'); ?>
	<?php echo $form->passwordFieldRow($model, 'passwordNew'); ?>
	<?php echo $form->passwordFieldRow($model, 'passwordRepeat'); ?>
	
		
	<div class="field submit">
		<?php echo CHtml::submitButton('save changes', array('name' => 'save', 'class' => 'btn btn-brown')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
