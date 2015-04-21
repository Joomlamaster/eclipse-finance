<div>
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'bonus'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/transaction/bonus', array('user_id' => $this->user->user_id)); ?>">Bank Wire</a></li>
		<li <?php if($this->action->id == 'deposit'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/transaction/deposit', array('user_id' => $this->user->user_id)); ?>">Credit Card</a></li>
		<li <?php if($this->action->id == 'deduction'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/transaction/deduction', array('user_id' => $this->user->user_id)); ?>">Deduction</a></li>
	</ul>
</div>
<div>	
<?php echo $content; ?>
</div>
