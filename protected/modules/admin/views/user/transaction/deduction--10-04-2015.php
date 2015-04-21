<?php $this->beginContent('container'); ?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'inlineForm',
    'type'=>'inline',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
<style>.help-block{display:none;}</style>
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
<?php echo $form->datepickerRow(
	$deductionForm,
	'date',
	array(
		//'options' => array('language' => 'es'),
		//'hint' => '',
		'style' => 'width:100px',
		'prepend' => '<i class="icon-calendar"></i>'
	)
); ?>  
<?php echo $form->textFieldRow($deductionForm, 'deduction_value', array('class'=>'input-small')); ?>
<?php echo $form->textFieldRow($deductionForm, 'comment', array('class'=>'input-small')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Submit')); ?>
 
<?php $this->endWidget(); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	//'rowHtmlOptionsExpression' => 'array("data-requestId"=>$data->request_id, "data-userId"=>$data->user_id)',
	'filter'=>$model, 
	'columns'=>array(
		array(
			'name'=>'deduction_timestamp',
			'type' => 'raw',
			'value' => 'date("Y-m-d H:i:s", $data["deduction_timestamp"])',
			'filter' => false
		),
		array(
			'name' => 'user_id',
			'filter' => false
		),
		array(
			'name' => 'deduction_value',
			'type' => 'raw',
			//'value' => 'date("Y-m-d H:i:s", $data["bonus_timestamp"])',
			//'filter' => false
		),	
		array(
			'name' => 'comment',
			'type' => 'raw',
			'filter' => false,
			//'value' => 'date("Y-m-d H:i:s", $data["bonus_timestamp"])',
			//'filter' => false
		),

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'buttons'=>array (
				'delete'=>array(
					'url'=>'Yii::app()->createUrl("/admin/user/transaction/DeleteDeduction", array("deduction_id"=>$data->deduction_id))',
					//'label'=>'',
					//'imageUrl'=>'',
					//'options'=>array( 'class'=>'icon-remove' ),
				),
			)
		),			
	),
)); ?>


<?php $this->endContent(); ?>
