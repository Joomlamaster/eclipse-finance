<style>
.registration-container{
	/*width:1000px; margin:20px auto; */
}
.page-content-title{
	margin-left:0px; margin-bottom:20px; 
}
</style>
<div class="page-content-title "><?php echo $this->pageTitle; ?></div>

<div class="registration-container"><?/*
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'registration'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/registration'); ?>">Registration</a></li>
		<li <?php if($this->action->id == 'invest'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/invest'); ?>">Invest</a></li>
		<li <?php if($this->action->id == 'depsoit'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('/profile/cashier/deposit'); ?>">Deposit</a></li>
	</ul>*/?>	<ul class="nav nav-pills">		<li <?php if($this->action->id == 'registration'): ?>class="active";<?php endif; ?>><a href="#">Registration</a></li>		<li <?php if($this->action->id == 'invest'): ?>class="active";<?php endif; ?>><a href="#">Invest</a></li>		<li <?php if($this->action->id == 'depsoit'): ?>class="active";<?php endif; ?>><a href="#">Deposit</a></li>	</ul>
	<?php echo $content; ?>
</div>