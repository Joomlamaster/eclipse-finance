<style>
.nav-pills{
	padding-bottom:10px;
}
.profile-container .nav a{
	color:#86837b; 
}
.nav-pills>li>a{
	background-color:red; 
	padding-top: 8px;      padding-right: 18px;
	padding-bottom: 8px;
	margin-top: 2px;
	margin-bottom: 2px;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;	
	text-transform:uppercase;
	color:#86837b; 

background: rgb(72, 74, 78);
background: -moz-linear-gradient(90deg, rgb(72, 74, 78) 27%, rgb(52, 53, 58) 70%);
background: -webkit-linear-gradient(90deg, rgb(72, 74, 78) 27%, rgb(52, 53, 58) 70%);
background: -o-linear-gradient(90deg, rgb(72, 74, 78) 27%, rgb(52, 53, 58) 70%);
background: -ms-linear-gradient(90deg, rgb(72, 74, 78) 27%, rgb(52, 53, 58) 70%);
background: linear-gradient(180deg, rgb(72, 74, 78) 27%, rgb(52, 53, 58) 70%);


}
#page-content a:hover, #page-content a:focus {
color: #FFF;
text-decoration: none;
} .profile-container{   padding:1px 40px !important;   }</style>
<div>
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'deposit'): ?>class="active";<?php endif; ?>>
			<a class="clearfix" href="<?php echo $this->createUrl('cashier/deposit'); ?>">
				<span class='icons'>
					<?php echo CHtml::image(Yii::app()->controller->module->registerImage('1-new.png'), "Deposit");?>
				</span>
				<span class="text-desc">Deposit</span>
			</a>
		</li>
		<li <?php if($this->action->id == 'withdraw'): ?>class="active";<?php endif; ?>>
			<a class="clearfix" href="<?php echo $this->createUrl('cashier/withdraw'); ?>">
				<span class='icons'>
					<?php echo CHtml::image(Yii::app()->controller->module->registerImage('2-new.png'), "Withdraw");?>
				</span>
				<span class="text-desc">Withdraw</span>
			</a>
		</li>
		<li <?php if($this->action->id == 'withdrawal_history'): ?>class="active";<?php endif; ?>>
			<a class="clearfix" href="<?php echo $this->createUrl('cashier/withdrawal_history'); ?>">
				<span class='icons'>
					<?php echo CHtml::image(Yii::app()->controller->module->registerImage('3-new.png'), "Withdrawal history");?>
				</span>
				<span class="text-desc">Withdrawal history</span>
			</a>
		</li>
		<li <?php if(in_array($this->action->id, array('transactions_deposit', 'transactions_bonus', 'transactions_deduction'))): ?>class="active";<?php endif; ?>>
			<a class="clearfix" href="<?php echo $this->createUrl('cashier/transactions_deposit'); ?>">
				<span class='icons'>
					<?php echo CHtml::image(Yii::app()->controller->module->registerImage('4-new.png'), "Deposit");?>
				</span>
				<span class="text-desc">transaction history</span>
			</a>
		</li>
	</ul>
</div>
<?php if($this->action->id == 'deposit') { ?>
<div class="bootstrap-widget-header"><h3>Select your deposit type</h3></div>
<?php } ?>
<div>	
	<?php echo $content; ?>
</div>
