<?php
/* @var $this NewsController */

$this->breadcrumbs=array(
	'Users list',
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
<?php if($this->action->id == 'ats' && Yii::app()->user->name != 'test@example.com'): ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary',
	'url' => $this->createUrl('user/addRate'),
    'label'=>'Add rate',
    //'block'=>true,
)); ?>
<?php endif; ?>



<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'user_id',
			'type' => 'raw',
			'value'=>'CHtml::link($data["user_id"],Yii::app()->createUrl("admin/user/profile", array("user_id"=>$data["user_id"])))',
			//'htmlOptions'=>array('width'=>50),
		),
		array(
			'name'=>'user_regdate',
			'type' => 'raw',
			'value'=>'date("d/i/Y H:m", $data["user_regdate"])',
			'htmlOptions'=>array('width'=>110),
			'filter' => false
		),			
		array(
			'name'=>'first_name',
			'type' => 'raw',
			'value'=>'CHtml::link($data["first_name"],Yii::app()->createUrl("admin/user/profile", array("user_id"=>$data["user_id"])))',
			//'htmlOptions'=>array('width'=>50),
		),
		array(
			'name'=>'last_name',
			'type' => 'raw',
			'value'=>'CHtml::link($data["last_name"],Yii::app()->createUrl("admin/user/profile", array("user_id"=>$data["user_id"])))',
			//'htmlOptions'=>array('width'=>50),
		),	
		array(
			'name'=>'user_email',
			//'htmlOptions'=>array('width'=>50),
		),	
		array(
			'name'=>'balance',
			//'htmlOptions'=>array('width'=>50),
		),
		array(
			'name'=>'bonus',
			//'htmlOptions'=>array('width'=>50),
		),			
		array(
			'name'=>'manager_name',
			'type'=>'raw',
			'value' => '$data->getManager_name()',
			//'htmlOptions'=>array('width'=>50),
		),
		array(
			'name'=>'user_address',
			//'htmlOptions'=>array('width'=>50),
		),

		array(
			'class'=>'CButtonColumn',
			'deleteButtonImageUrl'=>false,
			'buttons'=>array(
				'edit' => array(
						'label'=>'Edit',
						'url'=>'Yii::app()->urlManager->createUrl("admin/user/edit", array("user_id"=>$data->user_id))',
						'options'=>array('style'=>'margin-right: 5px;'),

				),
				'delete' => array(
					'url'=>'Yii::app()->urlManager->createUrl("admin/user/delete", array("user_id"=>$data->user_id))',
					'click'=> 'function() {
						return _confirm("Confirm action", "Delete user?", this)
					}'
				)
			),
			'template'=>'{edit}{delete}',
		),

	),
)); ?>
