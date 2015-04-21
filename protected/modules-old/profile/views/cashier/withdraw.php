<?php $this->beginContent('container'); ?>
<style>
form{
	padding-top:20px;
}
legend{
	color:#E9E9E9;
}
.table th, .table td {
    padding: 8px;
    line-height: 20px;
    text-align: left;
    vertical-align: top;
    border-top: 1px solid #dddddd;
}
</style>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'horizontalForm',
	'type' => 'horizontal',
	'inlineErrors' => false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
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
<legend>Request withdraw </legend>
	<?php echo $form->errorSummary($model); ?>
	<?php if($model->scenario == 'bank_wire'): ?>
	<table>
		<tr>
			<td>
				<fieldset>
					<?php echo $form->textFieldRow($model,'amount'); ?>		
					<?php echo $form->dropDownListRow($model,'payment_method', array(
							'bank_wire' => 'Bank Wire', 
							'credit_card' => 'Credit Card', 
							'other' => 'Other'
					), array('onchange' => 'location.href="/profile/cashier/withdraw/?scenario=" + this.value')); ?>	
					<?php echo $form->textFieldRow($model,'bank_wire_account'); ?>
					<?php echo $form->textFieldRow($model,'comments'); ?>
					<?php echo $form->textFieldRow($model,'customer_name'); ?>
					<?php echo $form->textFieldRow($model,'bank_name'); ?>
					<?php echo $form->textFieldRow($model,'bank_code'); ?>
				</fieldset>		
				
				<fieldset>
					<?php echo $form->textFieldRow($model,'branch_address'); ?>		
					<?php echo $form->textFieldRow($model,'account_number'); ?>
					<?php echo $form->textFieldRow($model,'iban'); ?>
					<?php echo $form->textFieldRow($model,'swift'); ?>
					<?php echo $form->textFieldRow($model,'currency'); ?>
				</fieldset>						
			</td>
			<td>
				
			</td>
		</tr>
	</table>

	<?php elseif($model->scenario == 'credit_card'): ?>
			<?php echo $form->textFieldRow($model,'amount'); ?>		
			<?php echo $form->dropDownListRow($model,'payment_method', array(
					'bank_wire' => 'Bank Wire', 
					'credit_card' => 'Credit Card', 
					'other' => 'Other'
			), array('onchange' => 'location.href="/profile/cashier/withdraw/?scenario=" + this.value')); ?>	
			<?php echo $form->textFieldRow($model,'comments'); ?>	
	<?php else: //other?>
			<?php echo $form->textFieldRow($model,'amount'); ?>		
			<?php echo $form->dropDownListRow($model,'payment_method', array(
					'bank_wire' => 'Bank Wire', 
					'credit_card' => 'Credit Card', 
					'other' => 'Other'
			), array('onchange' => 'location.href="/profile/cashier/withdraw/?scenario=" + this.value')); ?>
			<?php echo $form->textFieldRow($model,'other_account'); ?>	
			<?php echo $form->textFieldRow($model,'comments'); ?>		
	<?php endif; ?>

	
	
	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

<?php $this->endContent();?>