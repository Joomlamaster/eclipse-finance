<?php $this->beginContent('container'); ?>
<div>
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'transactions_deposit'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('cashier/transactions_deposit'); ?>">Deposit</a></li>
		<li <?php if($this->action->id == 'transactions_bonus'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('cashier/transactions_bonus'); ?>">Bonus</a></li>
		<li <?php if($this->action->id == 'transactions_deduction'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('cashier/transactions_deduction'); ?>">Deduction</a></li>
	</ul>
</div>
<div>	
	<?php echo $content; ?>
</div>

<?php $this->endContent();?>