<?php $this->beginContent('container'); ?>
<div class="form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'verticalForm',
		'type'=>'vertical',
		//'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),		
	));  ?> 


	<h2 class="form-signin-heading"></h2>
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
	<?php echo $form->errorSummary($model); ?>	
	
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

	<div class="field">
		<?php echo $form->labelEx($model,'USER_LOGIN'); ?>
		<?php echo $form->textField($model,'USER_LOGIN', array('class' => '')); ?>
		<?php echo $form->error($model,'USER_LOGIN'); ?>	
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'USER_PWD'); ?>
		<?php echo $form->passwordField($model,'USER_PWD', array('class' => '')); ?>
		<?php echo $form->error($model,'USER_PWD'); ?>	
	</div>				

	

	<div class="field">
		<?php echo $form->labelEx($model,'PRESENTATION_AMOUNT'); ?>
		<?php echo $form->textField($model,'PRESENTATION_AMOUNT', array('class' => '')); ?>
		<?php echo $form->error($model,'PRESENTATION_AMOUNT'); ?>	
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'ACCOUNT_REGISTRATION'); ?>
		<?php echo $form->passwordField($model,'ACCOUNT_REGISTRATION', array('class' => '')); ?>
		<?php echo $form->error($model,'ACCOUNT_REGISTRATION'); ?>	
	</div>	
		
	

	

	<?php echo CHtml::submitButton('Pay', array('class' => 'btn btn-large btn-primary')); ?>
<?php $this->endWidget(); ?>
</div>
<?php $this->endContent();?>