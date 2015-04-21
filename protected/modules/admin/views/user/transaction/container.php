<?php $this->beginContent('application.modules.admin.views.user.show_container'); ?>
<div>
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'bonus'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/transaction/bonus', array('user_id' => $this->user->user_id)); ?>">Bonus</a></li>
		<li <?php if($this->action->id == 'deposit'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/transaction/deposit', array('user_id' => $this->user->user_id)); ?>">Deposit</a></li>
		<!--  <li <?php if($this->action->id == 'BalanceCorrector'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/transaction/BalanceCorrector', array('user_id' => $this->user->user_id)); ?>">Balance Corrector</a></li> -->
		<li <?php if($this->action->id == 'deduction'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/transaction/deduction', array('user_id' => $this->user->user_id)); ?>">Deduction</a></li>
	</ul>
</div>
<div>	
<style>
table td.l{
	font-weight:bold; 
}
table td.v{
	padding-left:0px;
}
</style>	
<?php
$connection=Yii::app()->db;
$sql="SELECT * FROM `deduction_to_users` where user_id='".$this->user->user_id."'";
$sites=$connection->createCommand($sql)->queryAll();
foreach($sites as $value)
{
  $deduction_value += $value['deduction_value'];
}
//exit;

?>
	<table style="margin-bottom:20px;">
		<tr>
			<td colspan="6" style="text-align:center; font-weight:bold; font-size:17px;"><?php echo $this->user->first_name; ?> <?php echo $this->user->last_name; ?></td>
		</tr>	
		<tr>
			<td class="l">Balance:</td>
			<td class="v"><?php echo $this->user->balance; ?></td>
		</tr>
		<tr>
			<td class="l">Bonus:</td>
			<td class="v"><?php echo $this->user->bonus; ?></td>										
		</tr>
		<tr>
			<td class="l">Deposit:</td>
			<td class="v"><?php echo $this->user->deposit; ?></td>									
		</tr>	
		<tr>
			<td class="l">Deduction:</td>
			<td class="v"><?php echo $deduction_value; ?></td>										
		</tr>				
	</table>
	<?php echo $content; ?>
</div>
<?php $this->endContent(); ?>