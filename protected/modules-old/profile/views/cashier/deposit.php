<style>
legend{
	color:#999; 
}
</style>
<?php $this->beginContent('container'); ?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'horizontalForm',
	'action' => '/profile/cashier/sendRequest',
	'type' => 'horizontal',
	//'class' => 'form-horizontal',
	'inlineErrors' => false,
	'htmlOptions' => array(
	),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>



<div class="accordion" id="accordion2">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
				<span class="indicate">&gt;</span> Credit Card
			</a>
		</div>
		<div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
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
				<table>
					<tr>
						<td></td>
						<td></td>
					</tr>
				</table>
				
				
				<fieldset>
				 
				    <legend>Customer Details</legend>
				    <?php echo $form->textFieldRow($model, 'FirstName'); ?>
				    <?php echo $form->textFieldRow($model, 'LastName'); ?>
				    <?php echo $form->textFieldRow($model, 'Phone'); ?>
				    <?php echo $form->textFieldRow($model, 'Email'); ?>
				    
				    <legend>Billing Details. Card will be sent to this address</legend>
					<?php echo $form->textFieldRow($model, 'FirstName'); ?>
				    <?php echo $form->textFieldRow($model, 'LastName'); ?>   
				    <?php echo $form->textFieldRow($model, 'Street'); ?> 
				    <?php echo $form->textFieldRow($model, 'City'); ?> 
				    <?php echo $form->textFieldRow($model, 'Region'); ?> 
				    <?php echo $form->dropDownListRow($model, 'Country', CHtml::listData(Country::model()->findAll(), 'iso', 'name'), array('empty' => 'Select country')); ?> 
				    <?php echo $form->textFieldRow($model, 'Zip'); ?> 
				    
				    <legend>Card Details</legend>
				    <?php echo $form->textFieldRow($model, 'CardHolderName'); ?>
				    <?php echo $form->textFieldRow($model, 'CardNumber'); ?>
				    <?php echo $form->textFieldRow($model, 'CardExpireMonth'); ?>
				    <?php echo $form->textFieldRow($model, 'CardExpireYear'); ?>
				    <?php echo $form->dropDownListRow($model, 'CardType', array('VI' => 'Visa', 'MC' => 'Mastercard')); ?>
				    <?php echo $form->textFieldRow($model, 'CardSecurityCode'); ?>
				    <?php echo $form->checkBoxRow($model, 'VirtualCard'); ?>
				    
				    <legend></legend>
				    <?php if(Yii::app()->user->currency_id): ?>
						<?php echo $form->hiddenField($model, 'CurrencyCode'); ?>
						<?php echo $form->dropDownListRow($model, 'CurrencyCode', CHtml::listData(Currencies::model()->findAll(), 'currency_name', 'currency_name'), array("disabled"=> true)); ?>
				    <?php else: ?>
				    	<?php echo $form->dropDownListRow($model, 'CurrencyCode', CHtml::listData(Currencies::model()->findAll(), 'currency_name', 'currency_name')); ?>
				    <?php endif; ?>
				   
					
				    <?php echo $form->textFieldRow($model, 'TotalAmount'); ?>
				    
					<div class="form-actions">
					    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
					    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
					</div>    
				</fieldset>
				
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
	
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#neteller">
				<span class="indicate">&gt;</span> Neteller
			</a>
		</div>
		<div id="neteller" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
				<?php echo $netellerPage->page_body; ?>
			</div>
		</div>	
	</div>
	
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#wire">
				<span class="indicate">&gt;</span> Wire
			</a>
		</div>
		<div id="wire" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
				<?php echo $wirePage->page_body; ?>
			</div>
		</div>	
	</div>	
</div>


<?php $this->endContent();?>
<script>
	$('.accordion-toggle.active').click(function () {
		
	});
	$('.accordion-toggle').click(function () {
		if($(this).hasClass('active')){
			$(this).removeClass('active');	
		} else {
			$(this).addClass('active');
		}
	});
</script>