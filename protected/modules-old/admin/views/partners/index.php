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

<script>
$(function() {
	var t; 
	$('.fancybox').fancybox({
		type: 'inline',
		width:300,
		height:150,
		scrolling: 'no',
		beforeLoad: function() {
			this.content = '<textarea style="width:280px; height:130px;">http://eclipse-finance.com/goLink?pid='+$(this.element).data('partner-id')+'</textarea>'; 
		}
	});
})
</script>
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
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'List of partners',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>
<table class="table">
	<thead>
	<tr>
		<th>#</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>E-mail address</th>
		<th>Percent</th>
		<th></th>
		<th>Operations</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach($users as $key => $user): ?>
		<tr class="<?php echo $key%2 ? 'odd' : 'even'?>">
			<td><a href="<?php echo $this->createUrl('user/profile', array('user_id' => $user->user_id)); ?>"><?php echo $user->user_id; ?></a></td>
			<td><a href="<?php echo $this->createUrl('user/profile', array('user_id' => $user->user_id)); ?>"><?php echo $user->first_name; ?></a></td>
			<td><a href="<?php echo $this->createUrl('user/profile', array('user_id' => $user->user_id)); ?>"><?php echo $user->last_name; ?></a></td>
			<td><?php echo $user->user_email; ?></td>
			<td><?php echo $user->partner_percent; ?></td>
			<td><a class="fancybox" href="#" data-partner-id=<?php echo $user->user_id; ?>>Link</a></td>
			<td>
				<a href="<?php echo $this->createUrl('partners/users', array('partner_id' => $user->user_id));?>">Users</a> | 
				<a href="<?php echo $this->createUrl('partners/edit', array('user_id' => $user->user_id));?>">Edit</a> | 
				<a href="<?php echo $this->createUrl('partners/delete', array('user_id' => $user->user_id));?>" onclick="return _confirm('Confirm action', 'Delete user?', this);">Delete</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php $this->endWidget();?>


<?php $this->widget('BLinkPager', array(
    'pages' => $pages,
	'id' => '',
	'firstPageLabel' => '<<',
	'lastPageLabel' => '>>',

	'prevPageLabel' => '<',
	'nextPageLabel' => '>',
	
	'htmlOptions' => array(
		'class' => 'btn-group'
	)
)) ?>
