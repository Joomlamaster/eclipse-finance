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
		<?php echo $form->labelEx($model,'name_given'); ?>
		<?php echo $form->textField($model,'name_given', array('class' => '')); ?>
		<?php echo $form->error($model,'name_given'); ?>	
	</div>		
	
	<div class="field">
		<?php echo $form->labelEx($model,'name_family'); ?>
		<?php echo $form->textField($model,'name_family', array('class' => '')); ?>
		<?php echo $form->error($model,'name_family'); ?>	
	</div>	
	
	
	<div class="field">
		<?php echo $form->labelEx($model,'address_street'); ?>
		<?php echo $form->textField($model,'address_street', array('class' => '')); ?>
		<?php echo $form->error($model,'address_street'); ?>	
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'address_zip'); ?>
		<?php echo $form->textField($model,'address_zip', array('class' => '')); ?>
		<?php echo $form->error($model,'address_zip'); ?>	
	</div>		
	
	<div class="field">
		<?php echo $form->labelEx($model,'address_city'); ?>
		<?php echo $form->textField($model,'address_city', array('class' => '')); ?>
		<?php echo $form->error($model,'address_city'); ?>	
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'address_state'); ?>
		<?php echo $form->dropDownList($model, 'address_state', CHtml::listData(Country::model()->findAll(), 'iso', 'name'), array('class' => '', 'prompt'=>'Select a country')); ?>
		<?php echo $form->error($model,'address_state'); ?>	
	</div>
	
	<div class="field">
		<?php echo $form->labelEx($model,'address_country'); ?>
		<?php echo $form->dropDownList($model, 'address_country', CHtml::listData(Country::model()->findAll(), 'iso', 'name'), array('class' => '', 'prompt'=>'Select a country')); ?>
		<?php echo $form->error($model,'address_country'); ?>	
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'contact_email'); ?>
		<?php echo $form->textField($model,'contact_email', array('class' => '')); ?>
		<?php echo $form->error($model,'contact_email'); ?>	
	</div>
	
	<div class="field">
		<?php echo $form->labelEx($model,'account_holder'); ?>
		<?php echo $form->textField($model,'account_holder', array('class' => '')); ?>
		<?php echo $form->error($model,'account_holder'); ?>
	</div>
	
	<div class="field">
		<?php echo $form->labelEx($model,'account_number'); ?>
		<?php echo $form->textField($model,'account_number', array('class' => '')); ?>
		<?php echo $form->error($model,'account_number'); ?>
	</div>	
		
	
	<div class="field">
		<?php echo $form->labelEx($model,'account_expiry_month'); ?>
		<?php echo $form->textField($model,'account_expiry_month', array('class' => '')); ?>
		<?php echo $form->error($model,'account_expiry_month'); ?>
	</div>		
	
	<div class="field">
		<?php echo $form->labelEx($model,'account_expiry_year'); ?>
		<?php echo $form->textField($model,'account_expiry_year', array('class' => '')); ?>
		<?php echo $form->error($model,'account_expiry_year'); ?>
	</div>	
	
	<div class="field">
		<?php echo $form->labelEx($model,'account_verification'); ?>
		<?php echo $form->textField($model,'account_verification', array('class' => '')); ?>
		<?php echo $form->error($model,'account_verification'); ?>
	</div>		
	

	<?php echo CHtml::submitButton('Save', array('class' => 'btn btn-large btn-primary')); ?>
<?php $this->endWidget(); ?>
</div>
<?php $this->endContent();?>