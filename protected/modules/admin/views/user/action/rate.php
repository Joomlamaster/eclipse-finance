<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'horizontalForm',
	'type' => 'horizontal',
	//'class' => 'form-horizontal',
	'inlineErrors' => false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<script>
$(function() {
	var changed = true; 
	var sub = dx.feed.createSubscription("Quote"); 
	var loading = $('#loadingImg'); 

	var rateCurrency 	= 'select[name="RatesClosed[rate_currency]"]',
		rateValue 		= 'input[name="RatesClosed[rate_value]"]',
		_return 		= 'input[name="RatesClosed[return]"]',
		rateType 		= 'select[name="RatesClosed[rate_type]"]',
		strikeValue 	= 'input[name="RatesClosed[strike_value]"]',
		expirationValue = 'input[name="RatesClosed[expiration_value]"]',
		winValue		= 'input[name="RatesClosed[win]"]';
		
	$('form')
		.on('change', rateCurrency, function(e) {
			changed = true; 
			updateSymbol(); 
		})
		.on('change', rateValue, function(e) {
			var val = $(this).val();
			if($.isNumeric(val)) {
				$(_return).val(Math.round(1.85 * val)); 
			} 
		})
		.on('change', function(e) {
			var strike = $(strikeValue).val(); 
			var expirationRate = $(expirationValue).val(); 
			var order = $(rateType).val();
			if( strike && expirationRate ) {  
				var win = order == 'above' && strike < expirationRate;
				win = win || order == 'below' && strike > expirationRate;
				$('#result').text(win ? 'You win !' : 'You lose !'); 

				$(winValue).prop( "checked", win );
			}
		});
	updateSymbol(); 
	function updateSymbol() {
		var symbol = $(rateCurrency).val(); 
		dx.symbols = {}; 
		sub.addSymbols(symbol);
		changed = true; 
		loading.show(); 
	}
	sub.onEvent = function(quote) {
		if(quote.eventSymbol == $(rateCurrency).val() && changed) {
			y = (quote.bidPrice + quote.askPrice) / 2;
			var val = y.toFixed(5);

			$(expirationValue).val(val); 
			$(strikeValue).val(val);
			changed = false; 
			loading.hide(); 
		} 
	};	                    	
})
</script> 

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
<?php echo $form->errorSummary($model); ?> 
<fieldset>
 
    <legend>Add rate <img id="loadingImg" src="/images/spinner_small.gif" alt=""/></legend>
    
	<?php echo $form->checkBoxListInlineRow($model, 'ats_group', Yii::app()->user->ats_groups); ?>    
 
	<?php echo $form->dropDownListRow($model, 'rate_currency', Globals::$symbols); ?>
	<?php echo $form->dropDownListRow($model, 'rate_type', array('above' => 'above', 'below' => 'below')); ?>
	<?php echo $form->timepickerRow(
			$model,
			'striketime',
			array('options' => array(
				'defaultTime' =>  date('HH:mm'),
				'minuteStep' => 5,
				'showMeridian' => false,
			))
	); ?>	
	<?php echo $form->timepickerRow(
			$model,
			'expiry',
			array('options' => array(
				'defaultTime' =>  date('HH:mm'),
				'minuteStep' => 5,
				'showMeridian' => false,
			))
	); ?>	
	<?php echo $form->textFieldRow($model, 'expiration_value', array('hint'=>'')); ?>
	<?php echo $form->textFieldRow($model, 'strike_value', array('hint'=>'')); ?>
	<?php echo $form->textFieldRow($model, 'rate_value', array('hint'=>'')); ?>
	<?php echo $form->textFieldRow($model, 'return', array('hint'=>'')); ?>
	<div class="control-group">
		<label class="control-label required" for="RatesClosed_result">Result </label>
		<div id="result" class="controls" style="line-height:30px;"></div>
	</div>	
 	<?php echo $form->checkBox($model, 'win', array('hint'=>'', 'style' => 'display:none;')); ?>
 	
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
</div>

<?php $this->endWidget(); ?>