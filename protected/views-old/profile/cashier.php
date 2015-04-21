<style>
.profile-container a.btn{
	color:#FFF; 
}
</style>
<?php $this->beginContent('container'); ?>
	<a class="btn btn-primary" href="<?php echo $this->createUrl('profile/deposit'); ?>">Deposit</a>
	<a class="btn btn-primary" href="<?php echo $this->createUrl('profile/withdraw'); ?>">Withdraw</a>
	<a class="btn btn-primary" href="<?php echo $this->createUrl('profile/customer'); ?>">Customer Registration</a>
	<a class="btn btn-primary" href="<?php echo $this->createUrl('profile/payout'); ?>">Payout</a>
<?php $this->endContent();?>