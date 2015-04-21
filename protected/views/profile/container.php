<div class="profile-container">
	<a href="<?php echo $this->createUrl('trade/index'); ?>" class="close"><i class="icon-remove-circle"></i></a>
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'index'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('profile/index'); ?>">User Profile</a></li>
		<li <?php if($this->action->id == 'login'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('profile/login'); ?>">Login Options</a></li>
		<li <?php if($this->action->id == 'rates'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('profile/rates'); ?>">Closed Rates</a></li>
		<li <?php if($this->action->id == 'cashier'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('profile/cashier'); ?>">Cashier</a></li>
	</ul>
	<div class="profile-content">
		<?php echo $content; ?>
	</div>
</div>