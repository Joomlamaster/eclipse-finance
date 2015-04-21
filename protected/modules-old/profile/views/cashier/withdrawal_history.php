<?php $this->beginContent('container'); ?>

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Withdrawal History',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>

<table class="table">
	<thead>
	<tr>
		<th>#</th>
		<th>Date</th>
		<th>Amount ($)</th>
		<th>Status</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach($requests as $request): ?>
		<tr>
			<td><?php echo $request->request_id; ?></td>
			<td><?php echo date('Y-m-d H:i:s', $request->timestamp); ?></td>
			<td><?php echo $request->amount; ?></td> 
			<td>
				<?php echo $request->statuses[$request->status_id]; ?> 
				<?php if($request->status_id == 3): ?>
				<a href="#" title="Contact your manager to clarify the reasons"><i class="icon-question-sign"></i></a>
				<?php endif;?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php $this->endWidget();?>
<?php $this->endContent();?>