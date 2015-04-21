<style>
.registration-container{
	/*width:1000px; margin:20px auto; */
}
.page-content-title{
	margin-left:0px; margin-bottom:20px; 
}
h1.heading {
margin-left: 20px;
font-weight: bold;
background: url(../images/logo-account.png) no-repeat 0 0;
padding-left: 61px;
height: 56px;
margin: 0;
padding-top: 0;
font-size: 19px;
background-size: 100%;
}
.ico {
display: inline-block;
width: 25px;
height: 25px;
position: absolute;
left: 8px;
z-index: 999;
top: 10px;
}
.nav.nav-pills li {position: relative; }
.ico.reg {
background: url(../images/acc-1.png);
}
.ico.inv {
background: url(../images/acc-2.png);
left: 35px;
}
.ico.dep {
background: url(../images/acc-3.png);
left: 35px;
}
</style>
<?php
$url = Yii::app()->request->requestUri;
$page = substr($url, strrpos($url, '/') + 1);
if($page == 'registration'){ ?>
	<div class="container-head">
	<div class="heading-inner">
			<h1 class="heading">Open Account</h1>
	</div>
	</div>
<?php }elseif($page =="invest") { ?>
<div class="page-content-title "><?php echo "Eclipse Finance - Invest" ?></div>
<?php }else { ?>
<div class="page-content-title "><?php echo $this->pageTitle; ?></div>
<?php }?>
<div class="registration-container"><?/*
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'registration'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/registration'); ?>">Registration</a></li>
		<li <?php if($this->action->id == 'invest'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/invest'); ?>">Invest</a></li>
		<li <?php if($this->action->id == 'depsoit'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('/profile/cashier/deposit'); ?>">Deposit</a></li>
	</ul>*/?>	<ul class="nav nav-pills">		
				<li <?php if($this->action->id == 'registration'): ?>class="active";<?php endif; ?>>
					<span class="ico reg"></span>
					<a href="#">Registration</a>
				</li>		
				<li <?php if($this->action->id == 'invest'): ?>class="active";<?php endif; ?>>
					<span class="ico inv"></span>
					<a href="#">Invest</a>
				</li>
				<li <?php if($this->action->id == 'depsoit'): ?>class="active";<?php endif; ?>>
					<span class="ico dep"></span>
					<a href="#">Trade</a>
					
				</li>	
			</ul>
	<?php echo $content; ?>
</div>