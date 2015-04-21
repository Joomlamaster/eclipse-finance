<?php $this->beginContent('transaction_container'); ?>

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Investment',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>

<table class="table">
	<thead>
		<tr>
			
			<th>Date</th>
			<th>Type</th>
			<th>Description</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($transactions as $transaction): ?>
		<tr>
			<!--<td style="text-align:center"><?php echo $transaction->transaction_id; ?></td>-->
			<td style="text-align:center"><?php echo date('Y-m-d H:i:s', $transaction->timestamp); ?></td>
			<td style="text-align:center"><?php echo $transaction->depositTypes[$transaction->deposit_type]; ?></td>
			<td style="text-align:center"><?php echo $transaction->types[$transaction->type_id]; ?></td>
			<td style="text-align:center"><?php echo $transaction->amount; ?></td> 
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php $this->endWidget();?>

<?php $this->endContent();?>