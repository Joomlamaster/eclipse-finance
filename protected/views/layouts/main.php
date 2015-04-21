<!doctype html>

<html lang="ru-RU">

	<head>

		<meta charset="utf-8">

		<title><?php echo $this->getPageTitle(); ?></title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&subset=latin,cyrillic-ext,cyrillic" rel="stylesheet">
      <link rel="shortcut icon" type="image/png" href="http://www.eclipse-finance.com/images/eclipse-fav.png"/>

		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

      <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" id="arqam-style-css" href="http://eclipse-finance.com/css/style_002.css" type="text/css" media="all">
      <link href="http://eclipse-finance.com/css/hover.css" rel="stylesheet" media="all">
      <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
  

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
stLight.options({publisher: "1ed9a7fd-7ce7-4500-9823-10b3ba1e6d0a", doNotHash: false, doNotCopy: false, hashAddressBar: false});
</script>

<script> 
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]
=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-53109555-1', 'auto'); ga('send', 'pageview'); </script>


<?php /* Animated Icons */ ?>
<script type="text/javascript">
//<![CDATA[
  (function() {
    var shr = document.createElement('script');
    shr.setAttribute('data-cfasync', 'false');
    shr.src = '//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js';
    shr.type = 'text/javascript'; shr.async = 'true';
    shr.onload = shr.onreadystatechange = function() {
      var rs = this.readyState;
      if (rs && rs != 'complete' && rs != 'loaded') return;
      var site_id = 'd6ab7f3a4fde3ee96e3478253a167bec';
      try { Shareaholic.init(site_id); } catch (e) {}
    };
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(shr, s);
  })();
//]]>
</script>

<!--- Get Help --->


 
  


<link rel="stylesheet" type="text/css" href="/css/extended/style.css" />
<link rel="stylesheet" id="arqam-style-css" href="/css/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" href="/css/intlTelInput.css">
<script src="/js/intlTelInput.js"></script>
<link rel="stylesheet" type="text/css" href="/css/msdropdown/dd.css" />
<script src="/js/jquery.dd.min.js"></script>
<!-- </msdropdown> -->
<link rel="stylesheet" type="text/css" href="/css/msdropdown/flags.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>

<body>
 


<!-- This code must be installed within the body tags -->
<script type="text/javascript">
    var lhnAccountN = "25187-1";
    var lhnButtonN = 7008;
    var lhnInviteEnabled = 1;
    var lhnWindowN = 0;
    var lhnDepartmentN = 0;
    var lhnChatPosition = 'custom';
    var lhnChatPositionX = 'right';
    var lhnChatPositionYVal = 500;
</script>
<script src="//www.livehelpnow.net/lhn/widgets/chatbutton/lhnchatbutton-current.min.js" type="text/javascript" id="lhnscript"></script>
    
    
    
  
  
	<header>

		<div class="h-inner h-top">

			<a class="brand" href="/" style="position: relative;
top: -1px;"><img src="/images/logo.png" alt=""/></a>

			<span id="time"><strong></strong></span>

			

			

				<div class="auth-form">

					<?php if(Yii::app()->user->isGuest): ?>

					<form method="post" class="" action="<?php echo $this->createUrl('user/login'); ?>">

						<div class="field">

							<label><?php ?>Email</label>

							<input type="text" class=" search-query" placeholder="Login" name="LoginForm[username]">

							<a href="<?php echo $this->createUrl('user/registration'); ?>">Open Account</a>

						</div>

						

						<div class="field">

							<label><?php ?>Password</label>

							<input type="password" class=" search-query" placeholder="Password" name="LoginForm[password]">

							<a href="<?php echo $this->createUrl('user/password_recovery');?>">Forgot Password</a>	

						</div>

						

						<div class="field button">

							<button type="submit" class="btn btn-brown"><i class="icon-user icon-white"></i> Login</button>

						</div>			

					</form>	

					<?php else: ?>
					<table>
						<tr>
							<td class="profile">
								<div class="acc">
									<img src="/images/flags-70x55/<?php echo Yii::app()->user->country->iso; ?>.png" alt=""/>
									<div class="dropdown">
										<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
											<?php echo Yii::app()->user->first_name; ?> <?php echo Yii::app()->user->last_name; ?>
											<b class="caret drop"></b>
										</a>
										<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
									    	<li><a href="/profile">My Account</a></li>
									    	<li><a href="<?php echo $this->createUrl('/profile/default/login'); ?>">Change Password</a></li>
									    	<li><a href="<?php echo $this->createUrl('/profile/default/rates'); ?>">Trading History</a></li>
									    	<li><a href="<?php echo $this->createUrl('/profile/cashier/deposit'); ?>">Cashier</a></li>
									    	<li><a href="<?php echo $this->createUrl('/user/logout'); ?>">Logout</a></li>
										</ul>
									</div>	
									<div style="margin-top: -4px;">ID:  <?php echo "3".Yii::app()->user->id; ?></div>
									<div class="account_name" style="text-transform:uppercase; color: #3191c7; font-size: 12px; margin-top:-4px;"><?php echo Yii::app()->user->getAccountName(); ?></div>
								</div>						
							</td>
							<td class="balance">
								BALANCE<span>$<?php echo Func::balance(Yii::app()->user->balance); ?></span> 
							</td>
						</tr>
					</table>
					<!--  
					<div class="account-block">

						<table>

							<tr>

								<td class="username" colspan="2">

									Hello, <span><?php echo Yii::app()->user->first_name; ?> <?php echo Yii::app()->user->last_name; ?></span>

									<a href="/user/logout">Logout</a>

								</td>

							</tr>

							<tr class="balance">

								<td class="taLeft">Balance</td>

								<td class="taRight"><?php echo Yii::app()->user->balance; ?></td>

							</tr>

							<tr>

								<td class="taLeft">Account</td>

								<td class="taRight"><?php echo Yii::app()->user->id; ?></td>

							</tr>							

						</table>

					</div>	

					<div class="account-buttons">

						<ul>

							<li><a class="btn <?php echo $this->module->id == 'profile' && $this->action->id == 'index' ? 'btn-brown' : 'btn-inverse'; ?>" href="/profile">My account</a></li>

							<li><a class="btn <?php echo $this->module->id == 'profile' && $this->id == 'cashier' ? 'btn-brown' : 'btn-inverse'; ?>" href="<?php echo $this->createUrl('/profile/cashier/deposit'); ?>">Cashier</a></li>

							<li><a class="btn <?php echo $this->id == 'trade' && $this->action->id == 'index' ? 'btn-brown' : 'btn-inverse'; ?>" href="<?php echo $this->createUrl('/trade/index'); ?>">Open Trades</a></li>

						</ul>

					</div>				
					-->
					<?php endif; ?>	

				</div>	
			
		</div>

		<div class="nav-bar">

			<div class="h-inner h-nav">

				<ul class="nav">

					<?php if(Yii::app()->user->isDude()): ?>
					<li><a href="<?php echo $this->createUrl('/admin'); ?>"><i class="icon-wrench icon-white"></i></a></li>
					<?php elseif(Yii::app()->user->isPartner()): ?>
					<li><a href="<?php echo $this->createUrl('/partner'); ?>"><i class="icon-wrench icon-white"></i></a></li>
					<?php endif; ?>

					<li <?php if($this->id == 'trade'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('/trade/index'); ?>">Trading Room</a></li>

					<li <?php if($this->id == 'trade'): ?>class="active"<?php endif; ?>>
						<?php if(Yii::app()->user->isGuest): ?>
						<a href="<?php echo $this->createUrl('/user/registration'); ?>">Open account</a></li>
						<?php else: ?>
						<a href="<?php echo $this->createUrl('/profile'); ?>">My account</a></li>
						<?php endif; ?>

					<?php if(Yii::app()->user->isGuest): ?>
					<li <?php if($this->id == 'trade'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('/page/banking_methods'); ?>">Banking</a></li>
					<?php else: ?>
					<li <?php if($this->id == 'trade'): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->user->isGuest ? $this->createUrl('/page/banking_methods') : $this->createUrl('/profile/cashier/deposit'); ?>">Cashier</a></li>
					<?php endif; ?>
					<li <?php if($this->id == 'trade'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('/page/account_types'); ?>">Account types</a></li>

					<li <?php if($this->id == 'trade'): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('/page/show', array('page_id' => 61)); ?>">FAQ</a></li>

					<li><a href="<?php echo $this->createUrl('/page/contact_us'); ?>">Contact us</a></li>
               <li>
               <div style="margin-top: -3px;">
              <!--Start Ticketing Software by http://www.livehelpnow.net  -->

<a onclick="window.open('http://www.livehelpnow.net/lhn/TicketsVisitor.aspx?lhnid=25187','Ticket','left=' + (screen.width - 550-32) / 2 + ',top=50,scrollbars=yes,menubar=no,height=550,width=450,resizable=yes,toolbar=no,location=no,status=no');return false;" href="http://www.livehelpnow.net/lhn/TicketsVisitor.aspx?lhnid=25187">
<img src="http://eclipse-finance.com/images/ticket-butt2.png" border=0 width=160 height=40></a>

<!--end Ticketing Software by http://www.livehelpnow.net  -->

											

											
</div>

											</li>

				</ul>

			</div>			

		</div>



	</header>



	

		<?php echo $content; ?>



	<footer>

		

		<div class="row1">

			<div class="center">

				<div class="inner">

				<?php

		        if (isset($this->clips['footer']))

		            echo $this->clips['footer'];

		        ?>

				</div>

			<div style="clear:left"></div>

			</div>									

		</div>
        <div class="link-holder">
<a href="http://explorebinaryoptions.com/" class="explore-link" target="_blank"></a>
<a href="http://ibofaudit.com/eclipse-finance" class="xp-link" target="_blank"></a>
</div>
		<div class="set-icons"></div>

		<div class="row2">

			<div class="center">

				<div class="copyright-footer">

				<p style="font-size: 12px; color: #999;">Eclipse Finance is an innovative binary options trading platform provider that is owned and operated by Herrold Capital LLP, a financial services company registered in United Kingdom and authorized by the <a href="http://www.IOIRC.com" target="_blank">IOIRC</a> under License Number IOI897. Herrold Capital LLP is located 3rd Floor, 49 Farringdon Road, London, EC1M 3JP, United Kingdom</p>
<div style="display: block; width: 932px; height: 130px;">
				<div style="width: 700px; float: left;">
               <p style="color: #555; line-height: 15px;">As with any financial assets, binary options trading can generate high profit return on your investment; it may also result in a partial or total loss of your investment funds. Consequently, it is expressly advised that you should never invest money which you cannot afford to lose. The trading rates on our website are the ones at which Eclipse Finance is willing to sell binary options to its customers at the point of sale. As such, they may not directly correspond to real-time market levels at the point in time at which the sale of options occurs. It is the responsibility of all visitors to the website to ensure that their interaction with Eclipse Finance is strictly within the law and corresponds to the strictures enforced in their own country of residence. Customers should be aware of potential individual capital gain tax liabilities in their country of residence.</p>
               <p style="color: #555;">*Real stories presented using fictitious names to protect our clients' privacy.</p>
            </div>
               <!-- 
            <div class="social-icons">
               <a class="fb-icon" href="https://www.facebook.com/EclipseFinance" target="_blank"></a>
               <a class="twitter-icon" href="https://twitter.com/EclipseFinance" target="_blank"></a>
               <a class="gplus-icon" href="https://plus.google.com/107904489955213026346" rel="publisher" target="_blank"></a>
            </div>
            -->
               	<div class="arqam-widget-counter arq-outer-frame arq-colored arq-col3 arq-dark">
         <ul>	
				<li class="arq-facebook">
				<a href="http://www.facebook.com/EclipseFinance" target="_blank">
					<i class="arqicon-facebook"></i>
					<span id="fb_count">5,422</span>
					<small>Fans</small>
				</a>
            </li>
					<li class="arq-twitter">
				<a href="http://twitter.com/EclipseFinance" target="_blank">
					<i class="arqicon-twitter"></i>
					<span id="twitter_count">6,386</span>
					<small>Followers</small>
				</a>
			</li>
					<li class="arq-google">
				<a href="https://plus.google.com/107904489955213026346/about" target="_blank">
					<i class="arqicon-gplus"></i>
					<span>6,033</span>
					<small>Followers</small>
				</a>
			</li>
</ul>
</div>
                
                </div>

				

				</div>

				<div class="copyright" style="width: 932px; text-align: center; float: inherit;  margin: -13px auto 0 auto; padding-bottom: 34px; color: #555; clear: both; position: absolute">© 2011-<?php echo date('Y'); ?> Eclipse Finance ® Global</div>	

				

			</div>	

		</div>
 
	</footer>
	<?php if($this->id !== 'trade'): ?>
	<script>$.extend(timer, {
		getUTCString: function(GMT, s) {
			var hours   = GMT.getUTCHours(),
				minutes = GMT.getUTCMinutes(),
				seconds = GMT.getUTCSeconds();	
			
			return '<strong>' + hours + ':' + 
				('0' + minutes).slice(-2) + '</strong>:' + 
				(s ? ('0' + seconds).slice(-2) : '') + ' GMT';		
		},	
		afterTimeUpdate: function(UTC) {
			this.showIn('#time', true);
		}
	})</script>
	<?php endif; ?>
	<script>
		$(document).ready(function() {
		var txt = $('.account_name').text();
		if(txt =="Standart account")
		$('.account_name').text("Standard Account");
		});
	</script>
	<script>
  $(document).ready(function() {
   //$("#countries").msDropdown();
   $("#countries").intlTelInput({
        //allowExtensions: true,
        //autoFormat: false,
        //autoHideDialCode: false,
        //autoPlaceholder: false,
        //defaultCountry: "auto",
        //ipinfoToken: "yolo",
        //nationalMode: false,
        //numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        //preferredCountries: ['cn', 'jp'],
        //preventInvalidNumbers: true,
        //utilsScript: "lib/libphonenumber/build/utils.js"
      });
  });
 </script>
 </body>

</html>