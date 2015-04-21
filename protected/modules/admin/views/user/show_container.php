<h2><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></h2>

<div class="bs-docs-example">
	<ul id="myTab" class="nav nav-tabs">
		<li <?php if($this->action->id == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('user/info/index', array('user_id' => $this->user->user_id));?>">Profile</a></li>
		<!--  <li <?php if($this->action->id == 'billing'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('user/info/billing', array('user_id' => $this->user->user_id));?>">Billing</a></li>-->
		<li <?php if($this->id == 'user/transaction'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('user/transaction/bonus', array('user_id' => $this->user->user_id));?>">Transaction</a></li>
		<li <?php if($this->id == 'user/rates'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('user/rates/history', array('user_id' => $this->user->user_id));?>">Rates history</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade active in">
			<?php echo $content; ?>
		</div>            
	</div>
</div>