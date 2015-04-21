<style>
table.past-expiries{
	width:100%; 
}
table.past-expiries input[type="text"],
table.past-expiries seelct{
	width:100%; 
}
table.past-expiries button{
	margin-top: 16px;
}
table.table{
	color:#000; 
}
</style>
<?php echo CHtml::beginForm(Yii::app()->controller->createUrl('page/show', array('page_id' => Yii::app()->request->getQuery('page_id'))), 'get');?>
<table class="past-expiries">
	<tr>
		<td><label>Assets:</label>
		<?php 
 			$data = CHtml::listData($model->getCategoryOptions(),'id','text','group'); 
		 	echo CHtml::dropDownList('symbol', 'symbol_id', $data, array(
				'prompt'=>'All symbols',
				'options' => array(
					Yii::app()->request->getQuery('symbol') => array('selected'=>true)),
			)); ?>		
		 </td>
		<td><label>From:</label>
			<?php $this->widget('bootstrap.widgets.TbDatePicker', array(
					'name' => 'from',
					'value' => ($from = Yii::app()->request->getQuery('from')) ? $from : date('m/d/Y'),
					'htmlOptions' => array(
						'autocomplete' => 'on'
					)
				)
			); ?>  
		 </td>
		<td><label>To:</label> 
			<?php $this->widget('bootstrap.widgets.TbDatePicker', array(
					'name' => 'to',
					'value' => ($to = Yii::app()->request->getQuery('to')) ? $to : date('m/d/Y'),
					'htmlOptions' => array(
						'autocomplete' => 'on'
					)
				)
			); ?>   		
		</td>
		<td> 
			<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Search')); ?>
		</td>
	</tr>
</table>

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'ASSETS',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>
<table class="table">
	<thead>
	<tr>
		<th>ASSETS</th>
		<th>ENTRY DATE</th>
		<th>EXPIRY RATE</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach($list as $key => $row): ?>
			<tr class="<?php echo $key%2 ? 'odd' : 'even'?>">
				<td><?php echo $row->symbol->symbol_name; ?></td>
				<td><?php echo date('m/d/Y h:i:s', $row->timestamp); ?></td>
				<td><?php echo $row->symbol_value; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php $this->endWidget();?>
<?php $this->widget('BLinkPager', array(
    'pages' => $pages,
	'id' => '',
	'firstPageLabel' => '<i class="icon-chevron-left"></i><i class="icon-chevron-left"></i>',
	'lastPageLabel' => '<i class="icon-chevron-right"></i><i class="icon-chevron-right"></i>',

	'prevPageLabel' => '<i class="icon-chevron-left"></i>',
	'nextPageLabel' => '<i class="icon-chevron-right"></i>',
	
	'htmlOptions' => array(
		'class' => 'btn-group'
	)
)) ?>

<?php echo CHtml::endForm();?>