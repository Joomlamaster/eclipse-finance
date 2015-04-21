<div class="content" id="page-content">

	<style>

	</style>

	<h2>Feedback Form</h2>

	<?php /** @var BootActiveForm $form */

	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(

	    'id'=>'verticalForm',

		'enableClientValidation'=>true,

		'clientOptions'=>array(

			'validateOnSubmit'=>true,

		),		

	    'htmlOptions'=>array('class'=>''),	

	)); ?>

	 

	<?php $this->widget('bootstrap.widgets.TbAlert', array(

	        'block'=>true, // display a larger alert block?

	        'fade'=>true, // use transitions?

	        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed

	        'alerts'=>array( // configurations per alert type

	            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger

	        ),

	    )); ?> 

	 

	<?php echo $form->textFieldRow($model, 'name', array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model, 'subject', array('class'=>'span3', 'style' => 'width:300px')); ?>

	<?php echo $form->textAreaRow($model, 'message', array('class'=>'span3', 'style' => "width:400px;height: 100px;")); ?>

	<?php echo $form->textFieldRow($model, 'phone', array('class'=>'span3')); ?>

	<div>

		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type' => 'primary', 'label'=>'Submit')); ?>

	</div> 
<div class="loc-map">
<img src="images/loc-map.png" />
</div>
	<?php $this->endWidget(); ?>

</div>