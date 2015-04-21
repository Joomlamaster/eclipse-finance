<script>
$(function() {
	$('select[name="WithdrawalRequests[status_id]"]').livequery('change', function() {
		var row = $(this).parents('tr'),
			statusId = $(this).val(),
			requestId = row.data('requestid');
		$.get('/admin/user/chancgeWithdrawalRequests', {'status_id': statusId, 'request_id': requestId}, function(data) { 
			var response = $.parseJSON(data);
			if(response.status == 'OK') {
				row.effect('highlight', {}, 1000); 
			} else {
				dialog('Error', response.msg);
			}
		}); 
	});
})
</script>
<?php
/* @var $this NewsController */

$this->breadcrumbs=array(
	'Withdrawal requests',
);
?>

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
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit', 
	'htmlOptions' => array(
		'name' => 'delete_requests'
	), 
	'label'=>'Delete requests')); 
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'rowHtmlOptionsExpression' => 'array("data-requestId"=>$data->request_id, "data-userId"=>$data->user_id)',
	'filter'=>$model, 
	'columns'=>array(
		array(
			'name'=>'request_id',
			'type' => 'raw',
			'value'=>'CHtml::checkBox("request_ids[]", null, array("value" => $data->request_id))',
			'filter' => false
		),
		array(
			'name' => 'timestamp',
			'type' => 'raw',
			'value' => 'date("Y-m-d H:i:s", $data["timestamp"])',
			'filter' => false
		),
		array(
			'name' => 'amount',
			'type' => 'raw',
			'htmlOptions'=>array('width'=>70),
		),	
		array(
			'name' => 'status_id',
			'type' => 'raw',
			'value' => 'CHtml::activeDropDownList($data, "status_id", $data->statuses)',
			'htmlOptions'=>array('width'=>80),
			'filter'=>$model->statuses	
		),		
		array(
			'name'=>'user_id',
			'type' => 'raw',
			'value'=>'CHtml::link($data["user_id"],Yii::app()->createUrl("admin/user/info", array("user_id"=>$data["user_id"])))',
		),			
		array(
			'name'=>'user_email',
			'type' => 'raw',
			'value'=>'$data->user->user_email',
		),			
	),
)); ?>

<?php $this->endWidget(); ?>