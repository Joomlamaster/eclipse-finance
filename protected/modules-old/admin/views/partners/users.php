<?php
/* @var $this ManagersController */

$this->breadcrumbs=array(
	'Partners',
);
?>


<?php
/* @var $this NewsController */

$this->breadcrumbs=array(
	'Partners',
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
<h3>Partner percent - <?php echo (int)$partner->partner_percent; ?>%</h3>

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'List of users',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>
<?php 
$summ = 0; 
?>
<table class="table">
	<thead>
	<tr>
		<th>#</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>E-mail address</th>
		<th>Url referrer</th>
		<th>Deposit</th>
		<th>Profit</th>
		<th>Operations</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach($users as $key => $user): ?>
		<tr class="<?php echo $key%2 ? 'odd' : 'even'?>">
			<td><?php echo $user->user_id; ?></a></td>
			<td><?php echo $user->first_name; ?></a></td>
			<td><?php echo $user->last_name; ?></a></td>
			<td><?php echo $user->user_email; ?></td>
			<td><?php echo $user->url_referrer; ?></td>
			<td><?php //echo $user->currency->currency_symbol; ?> <?php echo (float)$user->deposit_first; ?></td>
			<td><?php //echo $user->currency->currency_symbol; ?> <?php echo $profit = ((int)$partner->partner_percent/100 * (float)$user->deposit_first); ?></td>
			<td><a href="<?php echo $this->createUrl('/admin/partners/paid', array('user_id' => $user->user_id)); ?>">Paid</a></td>
		</tr>
		<?php $summ+=$profit; ?>
		<?php endforeach; ?>
		<?php //foreach($summs as $symbol => $profit): ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><strong><?php echo $summ; ?></strong></td>
			<td></td>
		</tr>
		<?php //endforeach; ?>		
	</tbody>
</table>
<?php $this->endWidget();?>


