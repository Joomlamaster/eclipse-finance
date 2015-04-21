<style type="text/css">
#slideshow { 
    margin: -10px 0 0 -10px; 
    position: absolute; 
    width: 300px; 
    height: 333px; 
    padding: 10px;
	overflow: hidden; 
}

#slideshow > div { 
    position: absolute; 
    top: 10px; 
    left: 10px; 
    right: 10px; 
    bottom: 10px; 
}

</style>

<style>

.css-slideshow{
   position: relative;
   max-width: 495px;
   height: 370px;
   margin: 5em auto .5em auto;
}
.css-slideshow figure{
   margin: 0;
   position: absolute;
}
.css-slideshow figcaption{
   position: absolute;
   top: 0;
   color: #fff;
   background: rgba(0,0,0, .3);
   font-size: .8em;
   padding: 8px 12px;
   opacity: 0;
   transition: opacity 1s;
}
.css-slideshow:hover figure figcaption{
   transition: opacity 1s;
   opacity: 1;
}
.css-slideshow figure{
   opacity:0;
}
#countries_child {width: 150px; }
li.enabled._msddli_ {
width: 200px;
clear: both;
overflow: hidden;
display: block !important;
}
.ddcommon .ddChild li img {
border: 0 none;
position: relative;
vertical-align: middle;
float: left;
}
span.ddlabel {
float: left;
display: inline-block;
margin-top: -5px;
}
span.description {
float: left;
margin-left: 10px;
margin-top: -5px;
width: 100px;
}
#countries_title .description {display:none !important;}

.hover:hover, .hover:focus, .hover:active {
-webkit-transform: translateY(-6px);
transform: translateY(-6px);
-webkit-animation-name: none !important;
}
.intl-tel-input {
  position: relative;
  display: inline-block;
  float: left !important;
  width: 91px !important;
}

#countries {
  width: 91px;
  float: left;
  border-radius: 0;
  height: 36px;
}

</style>
<script type="text/javascript">
$("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow > div:first')
    .fadeOut(3000)
    .next()
    .fadeIn(3000)
    .end()
    .appendTo('#slideshow');
},  15000);
</script>

<script>

$(function(){

	$('.select-module li a').click(function(){

		$('.select-module li').removeClass('active'); 

		var href = $(this).attr('href'),

			_id = href.substring(1, href.length); 

		$(this).parent('li').addClass('active'); 



		$('.select-module .slide').hide(); 

		$('.select-module #' + _id).show(); 

		return false;

	});



	$('.choose-row ul li a').hover(function() { 

		$(this).find('i').stop(true, true);

		$(this).find('i').fadeIn('fast'); 

	}, function() {

		$(this).find('i').stop(true, true);

		$(this).find('i').fadeOut('fast'); 

	});



	$('select.symbol').change(function() {

		$('.trade-choice').data('tradeChoice').refreshProgress(

			$('.trends').data('trends').getProgressValues()

		);

	}); 

	

	$('.news-feed').news(); 

	$('.moving-line').mline({

		'symbols': ['EUR/USD', 'AUD/USD', 'GBP/USD']

	});

	$('.trade-choice').tradeChoice(); 

	$('.trends').trends({

		'barLeft' : '.bar-left',

		'barRight': '.bar-warning'

	})

	.bind('trendsprogressrefreshed', function(e, progress) { 

		$('.trade-choice').data('tradeChoice').refreshProgress(progress); 

	});	

// 	$('.trade-block').flash({
// 		swf: 'uploads/Eclipse_trade_emit_v23.swf',
// 		width: 647,
// 		height:265,
// 		bgcolor: '#000'
// 	});  

})

</script>

<script>var t=<?php echo time() * 1000;?>;</script>

<script>
		$(document).ready(function() {
			//$("#countries").msDropdown();
		});
	</script>

<section class="main">

	<div class="moving-line">

		<ul></ul>

	</div>

	<div class="inner center">

		<div class="block right">

		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(

			'htmlOptions' => array(

				'class' => 'form-signin',

				'enctype'=>'multipart/form-data',

			),

			'action' => $this->createUrl('user/registration'),

			'enableClientValidation'=>true,

			'clientOptions'=>array(

				'validateOnSubmit'=>true,

			),

		)); ?>

			<div class="substrate"></div>

			<div class="form-inner">

				<h2 class="form-signin-heading">Start Trading Now</h2>

				<?php 

					$this->widget('bootstrap.widgets.TbAlert', array(

					    'block'=>true, // display a larger alert block?

					    'fade'=>true, // use transitions?

					    'closeText'=>'×', // close link text - if set to false, no close link is displayed

					    'alerts'=>array( // configurations per alert type

						    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger

							'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger

					    )

					));

				?>	

				
				<div class="relative-input first-name">
					<?php echo $form->textField($model,'first_name', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('first_name'))); ?>
					<div class="f-icons">
						<i class="fa fa-user fa-icons"></i>
					</div>
				</div>

				<?php echo $form->error($model,'first_name'); ?>

				<div class="relative-input last-name">
					<?php echo $form->textField($model,'last_name', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('last_name'))); ?>
					<div class="f-icons">
						<i class="fa fa-user fa-icons"></i>
					</div>
				</div>

				<?php echo $form->error($model,'last_name'); ?>							
				
				<div class="relative-input email-name">
					<?php echo $form->textField($model,'user_email', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_email'))); ?>
					<div class="f-icons">
						<i class="fa fa-envelope-o fa-icons"></i>
					</div>
				</div>

				<?php echo $form->error($model,'user_email'); ?>
				<?php $data=Country::model()->findAll(); ?>
				<div class="clearfix">
					
					<!--<select name="countries-code" id="countries" style="width:300px;">
						<?php foreach ($data as $v) {  ?>
		  					<option value='<?php echo strtolower($v->phonecode); ?>' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo strtolower($v->iso); ?>" data-description="<?php echo $v->nicename; ?>" data-title="+<?php echo strtolower($v->phonecode); ?>">+<?php echo strtolower($v->phonecode); ?></option>
		  				<?php } ?>
					</select>-->
					<input id="countries" type="tel" value="+1" placeholder="e.g. +1 702 123 4567">
					<div class="relative-input phone-name">
						<?php echo $form->textField($model,'user_phone', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_phone'))); ?>
						<div class="f-icons">
							<i class="fa fa-phone fa-icons"></i>
						</div>
					</div>
				</div>
				<?php  echo $form->error($model,'user_phone'); ?>	

							

				<?php //echo $form->dropDownList($model, 'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 'name'), array('class' => 'input-block-level', 'prompt'=>'Select a country')); ?>

				

				

				<?php //echo $form->passwordField($model,'user_password', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_password'))); ?>

				<?php //echo $form->error($model,'user_password'); ?>

				

				<?php //echo $form->passwordField($model,'password_repeat', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('password_repeat'))); ?>

				<?php //echo $form->error($model,'password_repeat'); ?>	

			
 
				<label class="checkbox">

					<?php echo $form->checkBox($model,'agree'); ?>

					<label for="Users_agree">I'd like to speak with a trading coach</label>

					<?php echo $form->error($model,'agree'); ?>

				</label>	 
				<?php echo CHtml::hiddenField('step1', 1);?>
				

				<?php echo CHtml::submitButton('Complete Registration', array('class' => 'btn btn-large btn-brown registration-submit')); ?>

			</div>

		<?php $this->endWidget(); ?>	

		</div>

	</div>

</section>



<div class="content index">



	<div class="page-row full-width">

		<div class="page-row-inner">
		
		
			<div class="trade-block">
				<object bgcolor="#000000" data="/uploads/Eclipse_trade_emit_v2_2.swf" type="application/x-shockwave-flash" id="flash_11781467" width="647" height="285">
					<param name="bgcolor" value="#000">
					<param name="movie" value="/uploads/Eclipse_trade_emit_v2_2.swf">
					<embed src="/uploads/Eclipse_trade_emit_v2_2.swf" width="647" height="285" bgcolor="#000000" wmode="transparent">
					<param name="wmode" value="transparent">
				</object>			
			<!--  

				<div class="inner">

					<div>

						<select class="symbol">

							<?php foreach($symbolGroups as $group): ?>

								<optgroup label="<?php echo $group->group_name; ?>">

								<?php foreach($group->symbols as $symbol): ?>

									<option value="<?php echo $symbol->symbol; ?>"><?php echo $symbol->symbol_name; ?></option>

								<?php endforeach; ?>

								</optgroup>

							<?php endforeach; ?>

						</select>	

					</div>

					<div class="graph"></div>

					<div class="trade-choice">

						<h2>trader choice</h2>	

						<div class="progress" style="width:100%;">

						  <div class="bar bar-success bar-left" style="width: 50%;">

						  	50%

						  </div>

						  <div class="bar bar-warning bar-right" style="width: 50%;">

						  	50%

						  </div>

						</div>	

						

						<div class="buttons-row">

							<div><a class="above spriteIndex" href="#"></a></div>

							<div><a class="below spriteIndex" href="#"></a></div>

						</div>

						

						<div class="info">

							<div class="option-price">

								Option Price

								<strong></strong>

							</div>	

							<div class="payout">

								Payout

								<strong>85%</strong>

							</div>			

						</div>

		

					</div>	

				</div>	
-->
			</div>	

		





			<div class="accounts">

				<ul>

					<li class="active discovery">

						<a href="/page/account_types">
<!--  
							<i class="spriteIndex-account"></i>

							<h4>Discovery Account</h4>
-->


						</a>

					</li>

					<li class="standart">

						<a href="/page/account_types">
<!--  
							<i class="spriteIndex-account"></i>

							<h4>Standard Account</h4>

-->

						</a>

					</li>

					<li class="pro">

						<a href="/page/account_types">
<!--  
							<i class="spriteIndex-account"></i>

							<h4>Pro Trader Account</h4>
-->

						</a>

					</li>
                    <li class="excellency">

						<a href="/page/account_types">
<!--  
							<i class="spriteIndex-account"></i>

							<h4>Excellency Account</h4>
-->

						</a>

					</li>

<li class="vip">

						<a href="/page/account_types">
<!--  
							<i class="spriteIndex-account"></i>

						<h4>V.I.P Account</h4>
-->
						</a>

					</li>


				</ul>

			</div>

			<div style="clear:both"></div>

		</div>

	</div>

	

	<div class="page-row choose-row">

		<div class="choose-row-title"></div>

		<div style="width:1000px; height: 107px; frame-border=0" >
		<iframe src="/app/inner/accord.html" width="1000" height="150" scroll="no" frame-border="0"></iframe>
		</div>

	</div>

	

	<div class="page-row main-tables">

		<div class="col-1-3" style="margin:0px;">

			<section>

				<p class="title"><i class="trends spriteIndex"></i>Most popular trends</p>	

				<table class="trends">

					<thead>

						<th>Payout</th>

						<th>Asset</th>

						<th>Option price</th>

					</thead>

					<tbody>

						<tr data-symbol="EUR/USD">

							<td>78%</td>

							<td style="width:140px;">

								<div class="progress-values">

									<div class="left">50%</div>

									<div class="center">AUD/USD</div>

									<div class="right">50%</div>

								</div>

								<div class="progress" style="width:100%;">

									  <div class="bar bar-success bar-left" style="width: 50%;"></div>

									  <div class="bar bar-warning" style="width: 50%;"></div>

								</div>	

							</td>

							<td>1.35833</td>

						</tr>

						<tr data-symbol="AUD/USD">

							<td>78%</td>

							<td style="width:140px;">

								<div class="progress-values">

									<div class="left">50%</div>

									<div class="center">AUD/USD</div>

									<div class="right">50%</div>

								</div>

								<div class="progress" style="width:100%;">

									  <div class="bar bar-success bar-left" style="width: 50%;"></div>

									  <div class="bar bar-warning" style="width: 50%;"></div>

								</div>	

							</td>

							<td>0.94389</td>

						</tr>	

						<tr data-symbol="EUR/JPY">

							<td>78%</td>

							<td style="width:140px;">

								<div class="progress-values">

									<div class="left">50%</div>

									<div class="center">EUR/JPY</div>

									<div class="right">50%</div>

								</div>

								<div class="progress" style="width:100%;">

									  <div class="bar bar-success bar-left" style="width: 50%;"></div>

									  <div class="bar bar-warning" style="width: 50%;"></div>

								</div>	

							</td>

							<td>138.3525</td>

						</tr>	

						<tr data-symbol="GBP/USD">

							<td>78%</td>

							<td style="width:140px;">

								<div class="progress-values">

									<div class="left">50%</div>

									<div class="center">GBP/USD</div>

									<div class="right">50%</div>

								</div>

								<div class="progress" style="width:100%;">

									  <div class="bar bar-success bar-left" style="width: 50%;"></div>

									  <div class="bar bar-warning" style="width: 50%;"></div>

								</div>	

							</td>

							<td>1.70264</td>

						</tr>																									

					</tbody>

				</table>

			</section>

		</div>

		<div class="col-1-3">

			<section>

				<p class="title"><i class="news spriteIndex"></i>News</p>

				<ul class="news-feed">
					<?php if($news): ?>
					<?php foreach($news->channel->item as $row): ?>

						<li><?php echo $row->title; ?></li>

					<?php endforeach; ?>	
					<?php endif; ?>		

<!-- 				

					<li>

						Disney Debuts Digital Movie Services With Apple; Brings 400 Plus Films To iOS With Disney Movies Anywhere App					

					</li>

					<li>

						Disney Debuts Digital Movie Services With Apple; Brings 400 Plus Films To iOS With Disney Movies Anywhere App					

					</li>

					<li>

						Disney Debuts Digital Movie Services With Apple; Brings 400 Plus Films To iOS With Disney Movies Anywhere App					

					</li>

					<li>

						Disney Debuts Digital Movie Services With Apple; Brings 400 Plus Films To iOS With Disney Movies Anywhere App					

					</li>	

					<li>

						Disney Debuts Digital Movie Services With Apple; Brings 400 Plus Films To iOS With Disney Movies Anywhere App					

					</li>	

					<li>

						Disney Debuts Digital Movie Services With Apple; Brings 400 Plus Films To iOS With Disney Movies Anywhere App					

					</li>	

		--> 																								

				</ul>

			</section>

		</div>

		<div class="col-1-3">

			<section class="top-trades">

				<p class="title"><i class="trands spriteIndex"></i>Customer Testimonials</p>

				<table>

					<tbody>			
<div id="slideshow">
   <div>
  <img class='photo'  src="images/alina.png"/>
   </div>
   <div>
  <img class='photo'  src="images/arturo.png"/>
   </div>
   <div>
  <img class='photo'  src="images/mr-mrs-moreno.png"/>
   </div>
   <div>
     <img class='photo'  src="images/scott.png"/>
   </div>
</div>					
																																								
					</tbody>

				</table>				

			</section>

		</div>

	</div>

	

</div>









