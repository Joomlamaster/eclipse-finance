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
		<?php echo $form->labelEx($model,'NAME_GIVEN'); ?>
		<?php echo $form->textField($model,'NAME_GIVEN', array('class' => '')); ?>
		<?php echo $form->error($model,'NAME_GIVEN'); ?>	
	</div>		
	
	<div class="field">
		<?php echo $form->labelEx($model,'NAME_FAMILY'); ?>
		<?php echo $form->textField($model,'NAME_FAMILY', array('class' => '')); ?>
		<?php echo $form->error($model,'NAME_FAMILY'); ?>	
	</div>	
	
	
	<div class="field">
		<?php echo $form->labelEx($model,'ADDRESS_STREET'); ?>
		<?php echo $form->textField($model,'ADDRESS_STREET', array('class' => '')); ?>
		<?php echo $form->error($model,'ADDRESS_STREET'); ?>	
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'ADDRESS_ZIP'); ?>
		<?php echo $form->textField($model,'ADDRESS_ZIP', array('class' => '')); ?>
		<?php echo $form->error($model,'ADDRESS_ZIP'); ?>	
	</div>		
	
	<div class="field">
		<?php echo $form->labelEx($model,'ADDRESS_CITY'); ?>
		<?php echo $form->textField($model,'ADDRESS_CITY', array('class' => '')); ?>
		<?php echo $form->error($model,'ADDRESS_CITY'); ?>	
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'ADDRESS_STATE'); ?>
		<?php echo $form->textField($model,'ADDRESS_STATE', array('class' => '')); ?>
		<?php echo $form->error($model,'ADDRESS_STATE'); ?>	
	</div>
	
	<div class="field">
		<?php echo $form->labelEx($model,'ADDRESS_COUNTRY'); ?>
		<?php echo $form->textField($model,'ADDRESS_COUNTRY', array('class' => '')); ?>
		<?php echo $form->error($model,'ADDRESS_COUNTRY'); ?>	
	</div>	
	
	
	<div class="field">
		<?php echo $form->labelEx($model,'CONTACT_EMAIL'); ?>
		<?php echo $form->textField($model,'CONTACT_EMAIL', array('class' => '')); ?>
		<?php echo $form->error($model,'CONTACT_EMAIL'); ?>	
	</div>
	
	<div class="field">
		<?php echo $form->labelEx($model,'ACCOUNT_HOLDER'); ?>
		<?php echo $form->textField($model,'ACCOUNT_HOLDER', array('class' => '')); ?>
		<?php echo $form->error($model,'ACCOUNT_HOLDER'); ?>
	</div>
	
	<div class="field">
		<?php echo $form->labelEx($model,'ACCOUNT_NUMBER'); ?>
		<?php echo $form->textField($model,'ACCOUNT_NUMBER', array('class' => '')); ?>
		<?php echo $form->error($model,'ACCOUNT_NUMBER'); ?>
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'ACCOUNT_BRAND'); ?>
		<?php echo $form->textField($model,'ACCOUNT_BRAND', array('class' => '')); ?>
		<?php echo $form->error($model,'ACCOUNT_BRAND'); ?>
	</div>		
	
	<div class="field">
		<?php echo $form->labelEx($model,'ACCOUNT_EXPIRY_MONTH'); ?>
		<?php echo $form->textField($model,'ACCOUNT_EXPIRY_MONTH', array('class' => '')); ?>
		<?php echo $form->error($model,'ACCOUNT_EXPIRY_MONTH'); ?>
	</div>		
	
	<div class="field">
		<?php echo $form->labelEx($model,'ACCOUNT_EXPIRY_YEAR'); ?>
		<?php echo $form->textField($model,'ACCOUNT_EXPIRY_YEAR', array('class' => '')); ?>
		<?php echo $form->error($model,'ACCOUNT_EXPIRY_YEAR'); ?>
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'ACCOUNT_VERIFICATION'); ?>
		<?php echo $form->textField($model,'ACCOUNT_VERIFICATION', array('class' => '')); ?>
		<?php echo $form->error($model,'ACCOUNT_VERIFICATION'); ?>
	</div>		
	
	
	<label class="checkbox">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</label>	
	

	<?php echo CHtml::submitButton('Registration', array('class' => 'btn btn-large btn-primary')); ?>
<?php $this->endWidget(); ?>
</div>
<?php $this->endContent();?>