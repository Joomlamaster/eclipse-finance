<style>
legend{
	color:#999; 
}
#accordion2 {margin-bottom: 0 !important;}

#horizontalForm a.accordion-toggle:hover, #horizontalForm a.accordion-toggle.active {
background: #000;
color: #fff;
}
#horizontalForm a.accordion-toggle {
background: #fff;
color: #000;
}
.form-actions {
background-color: transparent; 
border-top: 0 none; 
text-align: right;
width: 220px;
}
.three-items{
clear: both;
overflow: hidden;}

.three-items span.indicate {
float: left; }

.three-items span.title {
float: left;
display: inline-block;
}


.three-items span.desc {
float: left;
display: inline-block;
word-wrap: break-word;
width: 465px;
margin-left: 10px;
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

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Select your withdrawal method',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>


<div class="accordion" id="accordion2">
	
	
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle three-items" data-toggle="collapse" data-parent="#accordion2" href="#neteller">
				<span class="indicate">&gt;</span> <span class="title">Credit Card</span><span class="desc"> (Only initial investment can be withdrawn, profit can only be withdrwan using a Bank Wire  transfer)</span>
			</a>
		</div>
		<div id="neteller" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
				<?php echo $form->textFieldRow($model,'amount'); ?>		
				<?php echo $form->textFieldRow($model,'comments'); ?>
				<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
	</div>
			</div>
		</div>	
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
				<span class="indicate">&gt;</span> Bank Wire
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
					<?php echo $form->textFieldRow($model,'amount'); ?>		
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
				<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
	</div>
   
   
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
	<!--<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#wire">
				<span class="indicate">&gt;</span> Neteller
			</a>
		</div>
		<div id="wire" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
				<?php echo $form->textFieldRow($model,'amount'); ?>		
			<?php echo $form->textFieldRow($model,'neteller_account'); ?>	
			<?php echo $form->textFieldRow($model,'comments'); ?>
			<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
	</div>
			</div>
		</div>	
	</div>	-->
	
</div>


<?php $this->endWidget();?>

<?php $this->endContent();?>
<script>
	
	$('.accordion-toggle').click(function () {
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).css('background', '#fff').css('color', '#000');
		} else {
			$(this).addClass('active');
			$(this).css('background', '#000').css('color', '#fff');
		}
	});
</script>