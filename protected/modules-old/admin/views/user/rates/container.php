<?php $this->beginContent('application.modules.admin.views.user.show_container'); ?>
<div>
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'history'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/rates/history', array('user_id' => $this->user->user_id)); ?>">History</a></li>
	</ul>
</div>
<div>	
	<?php echo $content; ?>
</div>
<?php $this->endContent(); ?>
