<style type="text/css">#accoutnTypes{margin:30px 0; padding:0;width:960px;height:1300px;font-family:arial;}
.clear {clear:both;}
.cards{background:url("http://eclipsefinancereviews.com/images/greystripe.png") repeat scroll 0 0 transparent;float:left;width:185px;height:1240px;text-align:center;border:1px solid #ccc;position:relative;top:15px;z-index:1;}
#accoutnTypes div h3{background:url("../images/grad_upperheader.png") repeat scroll -30px 0px  transparent;color:#fff;font-size:18px;font-weight:bold;margin:0;
/*
padding:2px 0 2px 33px; 
text-align: left; */
}
#accoutnTypes div.type-4 h3{background:url("/images/grad_upperheader2.png") repeat scroll -32px 0px 
transparent;color:#fff;font-size:18px;font-weight:bold;margin:0;padding:2px 0 2px 10px; text-align: left;}
#accoutnTypes div.type-5 h3{  background: url("/images/grad_upperheader2.png") repeat scroll -32px 0px transparent;color:#fff;font-size:18px;font-weight:bold;margin:0;padding:2px 0 2px 44px; text-align: left;}
.price-range{background:url("http://eclipsefinancereviews.com/images/blueheader.png") no-repeat scroll 0 0 transparent;height:87px;line-height:87px;border:1px solid #ccc;border-left:0;border-right:0;color:#fff;font-size:20px;font-weight:bold;text-shadow:2px 2px #000000;}
.type-2 .price-range{background:url("http://eclipsefinancereviews.com/images/greenheader.png") repeat scroll 0 0 transparent;height:95px;}
.type-5 .price-range{background:url("http://eclipsefinancereviews.com/images/yellowheader.png") no-repeat scroll 
0 0 transparent;height:101px;}
#accoutnTypes .cards ul {
  color: #000;
  text-align: left;
  padding: 10px 10px 0 10px;
  list-style-type: disc !important;
}
.cards ul li{font-size:14px;margin:10px 0;display: list-item !important;}
.type-2,.type-5{background:url("http://eclipsefinancereviews.com/images/greenstripe.png") repeat scroll 0 0 transparent;box-shadow:1px 1px 30px;height:1270px;position:relative;top:5px;z-index:111;}
.type-5{background:url("http://eclipsefinancereviews.com/images/yellowstripe.png") repeat scroll 0 0 transparent;top:0;height:1273px;}
.bottom-text{background:url("http://eclipsefinancereviews.com/images/greenarrow.png") no-repeat scroll 0 0 transparent;height:96px; padding-top: 20px; position:absolute;width:195px;;bottom:0;color:#fff;font-size:20px;}
.type-5 .bottom-text{background:url("http://eclipsefinancereviews.com/images/yellowarrow.png") no-repeat scroll 0 0 transparent;height:118px;width:193px; padding-top: 0;}
.free_gift {background:url("http://eclipsefinancereviews.com/images/baloon.png") no-repeat scroll center 0 transparent;font-size:16px;color:#ce0a0a;text-align:center;padding-top:8px;height:37px;}
.free{font-size:24px;color:#ce0a0a;margin:20px 0 10px 10px;}
.box_gift{font-size:12px;padding:0 15px;}.box_gift i{font-size:10px;}
.type-5 .box_gift{font-size:16px;padding-left:5px;color:#000;} .open-but { margin: 10px 0 7px 0;} 
.days-left { margin-top: 3px; } .type-2 a { color:#7a6d19; } 
.cards a { color:#7a6d19; }
div#page-column.span3{display:none;}
div#page-content.span9{width:100%}
ul.nav.nav-pills{margin:0 auto;width:75%;}

</style>



<?php 
$link['value'] = Yii::app()->user->isGuest ? $this->createUrl('/profile') : $this->createUrl('/profile/cashier/deposit');
$link['name'] = Yii::app()->user->isGuest ? 'OPEN ACCOUNT' : 'DEPOSIT';
?>


<div id="accoutnTypes">
<div class="type-1 cards">
<h3>Discovery Account</h3>

<div class="price-range">$100-$499</div>

<div class="open-but"><a class="button float-shadow" href="<?php echo $link['value']; ?>"><?php echo $link['name']; ?></a></div>

<ul class="ul-list">
	<li>Welcome bonus up to <strong>25%</strong></li>
	<li>Offered trade size: up to $100</li>
	<li>Daily market review</li>
	<li>Personal Account Manager</li>
</ul>
</div>

<div class="type-2 cards">
<h3>Standard Account</h3>

<div class="price-range">$500-$3,499</div>

<div class="open-but"><a class="button float-shadow" href="<?php echo $link['value']; ?>"><?php echo $link['name']; ?></a></div>

<ul class="ul-list">
	<li>Welcome bonus up to <strong>50%</strong></li>

	<li>Offered trade size: up to $500</li>
	<li>Daily market review</li>
	<li>Personal Account Manager</li>
	<li>Daily Live Signals from TBS Package: Bronze-Silver <span style="font-size: 12px; font-style: italic;">(<span href="http://www.Top-Binary-

Signals.com">www.Top-Binary-Signals.com</span>)</span></li>
	<li>Three $250 Risk free trades</li>
	<li>Coaching from an expert trader</li>
</ul>

<div class="bottom-text"><br>
<strong>HIGHLY</strong><br>
<strong>RECOMMENDED</strong><br>
for beginners</div>
</div>

<div class="type-3 cards">
<h3>Pro Trader Account</h3>

<div class="price-range">$3,500-$14,999</div>

<!--<div class="days-left"><img src="http://eclipsefinancereviews.com/wp

content/uploads/2014/07/only-left-7.png"></div>-->

<div class="open-but"><a class="button float-shadow" href="<?php echo $link['value']; ?>"><?php echo $link['name']; ?></a></div>

<ul>
	<li>Welcome bonus up to <strong>100%</strong></li>
	<li>Offered trade size: up to $1500</li>
	<li>Daily market review</li>
	<li>Personal Account Manager</li>
	<li>Daily Live Signals from TBS Package: Gold-Platinum</li>
	<li>Three $1000 Risk free trades</li>
	<li>Coaching from an expert trader</li>
	<li>3% monthly Cash Back <span style="font-size: 12px; font-style: 

italic;">(*After $35k trading)</span></li>
	<li>Apple iPad3 or an Android equivalent of any other brand!</li>
</ul>

<div class="box_gift" style="margin-top:109px;"><img src="/images/eclipse-

ipad.png"></div>
</div>

<div class="type-4 cards">
<h3>Excellency Account</h3>

<div class="price-range">$15,000-$99,999</div>

<!--<div class="days-left"><img src="http://eclipsefinancereviews.com/wp

content/uploads/2014/07/only-left-4.png"></div>-->

<div class="open-but"><a class="button float-shadow" href="<?php echo $link['value']; ?>"><?php echo $link['name']; ?></a></div>

<ul>
	<li>Welcome bonus up to <strong>150%</strong></li>
	<li>Offered trade size: up to $5000</li>
	<li>Daily market review</li>
	<li>Personal Account Manager</li>
	<li>Daily Live Signals from TBS Package: Diamond</li>
	<li>Three $1500 Risk free trades</li>
	<li>Coaching from an expert trader</li>
	<li>7% monthly Cash Back <span style="font-size: 12px; font-style: 

italic;">(*After $55k trading)</span></li>
	<li>TBS Managed Account Program Packages: Micro - Pro</li>
	<li>Apple iPhone 6 or an Android equivalent of any other brand!</li>
</ul>

<div class="box_gift" style="margin-top:24px;"><img src="/images/eclipse-

iphone.png"></div>
</div>

<div class="type-5 cards">
<h3>V.I.P Account</h3>

<div class="price-range"><span style="color:#ffffff;">$100,000+</span></div>

<!--<div class="days-left"><img src="http://eclipsefinancereviews.com/wp-

content/uploads/2014/07/only-left-3.png"></div>-->

<div class="open-but"><a class="button float-shadow" href="<?php echo $link['value']; ?>"><?php echo $link['name']; ?></a></div>

<ul>
	<li>Welcome bonus up to <strong>250%</strong></li>
	<li>Offered trade size: individual</li>
	<li>Daily market review</li>
	<li>Personal Account Manager</li>
	<li>Daily Live Signals from TBS Package Diamond</li>
	<li>Three $1500 Risk free trades</li>
	<li>Coaching from an expert trader</li>
	<li>TBS Managed Account Program Packages: Premium - VIP Investor</li>
	<li>Corporate Account</li>
	<li>Interest Bearing Account</li>
	<li>Funds Protection and Insurance starting from 5.5% to 9% monthly</li>
	<li>Personal Debit Card</li>
	<li>Free Apple MacBook Air, iPhone 6 and iPad 3 or Samsung's equivalent</li>
</ul>

<div class="bottom-text">
<div class="free" style="margin-top: 36px;"></div>

<div class="box_gift" style="margin-top: 10px;"><img alt="Mac" border="0" src="http://eclipse-finance.com/images/macbook-ipad-iphone-FREE.png" style="float:left"></div>
</div>
</div>
</div>