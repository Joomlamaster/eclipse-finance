<?php $this->beginContent('container'); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	//'rowHtmlOptionsExpression' => 'array("data-requestId"=>$data->request_id, "data-userId"=>$data->user_id)',
	'filter'=>$model, 
	'columns'=>array(
		array(
			'name'=>'timestamp',
			'type' => 'raw',
			'value' => 'date("Y-m-d H:i:s", $data["timestamp"])',
			'filter' => false
		),
		array(
			'name' => 'user_id',
			'filter' => false
		),
		array(
			'name' => 'amount',
			'type' => 'raw',
			//'value' => 'date("Y-m-d H:i:s", $data["bonus_timestamp"])',
			//'filter' => false
		),	
// 		array(
// 			'name' => 'deposit_type',
// 			'type' => 'raw',
// 			'value' => '$data->depositTypes[$data->deposit_type]',
// 			'htmlOptions'=>array('width'=>120),
// 			'filter'=> $model->depositTypes
// 		),	
// 		array(
// 			'name' => 'type_id',
// 			'type' => 'raw',
// 			'value' => '$data->types[$data->type_id]',
// 			'htmlOptions'=>array('width'=>120),
// 			'filter'=> $model->types
// 		),
// 		array(
// 			'class'=>'bootstrap.widgets.TbButtonColumn',
// 			'template'=>'{delete}',
// 			'htmlOptions'=>array('style'=>'width: 50px'),
// // 			'buttons'=>array (
// // 				'delete'=>array(
// // 					//'url'=>'Yii::app()->createUrl("/admin/user/transaction/DeleteDeposit", array("transaction_id"=>$data->transaction_id))',
// // 					//'label'=>'',
// // 					//'imageUrl'=>'',
// // 					//'options'=>array( 'class'=>'icon-remove' ),
// // 				),
// // 			)
// 		),			
	),
)); ?>
<?php $this->endContent(); ?>