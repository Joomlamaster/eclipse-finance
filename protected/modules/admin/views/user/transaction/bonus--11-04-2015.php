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
<?php echo $form->dropDownListRow($bonusForm, 'type_id', $model->types, array('multiple'=>false)); ?>
<?php /*echo $form->datepickerRow(
	$bonusForm,
	'date',
	array(
		//'options' => array('language' => 'es'),
		//'hint' => '',
		'style' => 'width:100px',
		'prepend' => '<i class="icon-calendar"></i>'
	)
);*/ ?>

<?php 
    $this->widget(
        'ext.jui.EJuiDateTimePicker',
        array(
            'model'     => $bonusForm,
            'attribute' => 'date',
            'language'=> 'en',//default Yii::app()->language
            //'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
            'options'   => array(
                //'dateFormat' => 'dd.mm.yy',
                //'timeFormat' => '',//'hh:mm tt' default
            ),
        )
    );
?>

<?php echo $form->textFieldRow($bonusForm, 'bonus_value', array('class'=>'input-small')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Add bonus')); ?>
 
<?php $this->endWidget(); ?>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	//'rowHtmlOptionsExpression' => 'array("data-requestId"=>$data->request_id, "data-userId"=>$data->user_id)',
	'filter'=>$model, 
	'columns'=>array(
		array(
			'name'=>'bonus_id',
			'type' => 'raw',
			//'value'=>'CHtml::checkBox("request_ids[]", null, array("value" => $data->request_id))',
			'filter' => false
		),
		array(
			'name' => 'user_id',
			'filter' => false
		),			
		array(
			'name' => 'bonus_timestamp',
			'type' => 'raw',
			'value' => 'date("Y-m-d H:i:s", $data["bonus_timestamp"])',
			'filter' => false
		),
		array(
			'name' => 'bonus_value',
			'type' => 'raw',
			//'value' => 'date("Y-m-d H:i:s", $data["bonus_timestamp"])',
			//'filter' => false
		),	
		array(
			'name' => 'type_id',
			'type' => 'raw',
			'value' => '$data->types[$data->type_id]',
			'htmlOptions'=>array('width'=>120),
			'filter'=> $model->types
		),	
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'buttons'=>array (
				'delete'=>array(
					'url'=>'Yii::app()->createUrl("/admin/user/transaction/DeleteBonus", array("bonus_id"=>$data->bonus_id))',
					//'label'=>'',
					//'imageUrl'=>'',
					//'options'=>array( 'class'=>'icon-remove' ),
				),
			)
		),
	),
)); ?>
<?php $this->endContent(); ?>