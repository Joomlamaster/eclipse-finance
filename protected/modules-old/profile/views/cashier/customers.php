<style>
.table a{
	color:#000; 
}
</style>
<?php $this->beginContent('container'); ?>
<div style="text-align:right; padding:10px 0px 10px ;">
	<a href="<?php echo $this->createUrl('cashier/CustomerRegistration'); ?>" class="btn btn-primary btn-large">Customer Registration</a>
</div>

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

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'List of customers',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>
<table class="table">
	<thead>
		<tr>
			<th>Customer Id</th>
			<th>Account Holder</th>
			<th>options</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($customers as $customer): ?>
		<tr>
			<td><?php echo $customer->customer_id; ?></td>
			<td><?php echo $customer->account_holder; ?></td>
			<td>
				<a href="<?php echo $this->createUrl('cashier/CustomerEdit', array('customer_id' => $customer->customer_id)); ?>">Edit</a> | 
				<a onclick="return confirm('really delete?')" href="<?php echo $this->createUrl('cashier/CustomerDelete', array('customer_id' => $customer->customer_id)); ?>">Delete</a>
			</td>
		</tr>
		<?php endforeach; ?>		
	</tbody>
</table>
<?php $this->endWidget();?>
<?php $this->endContent();?>