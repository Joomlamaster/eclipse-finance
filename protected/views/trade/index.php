<style>
.chart canvas{
	width:300px !important; 
}
.tab-content.options{
	position:relative; height:630px; overflow:hidden; 
}
.tab-content.options .tab-pane{
	position:absolute; 
	left:-999999999px;  /* jquery bug detect size (flotJs) if display:none */
	top:0px; width:1000px; display:block; 
}
.tab-content.options .tab-pane.active{
	left:0px;
}
.tab-content.options ul.thumbnails{
	margin-left:-25px;
}
.tab-content.options ul.thumbnails li{
	margin-left:25px;
}
.chart{
	overflow: hidden;
}
</style>
<div class="tabbable" data-anijs="if: load, on: window, do: flipInY animated, after: removeAnim"> <!-- Only required for left/right tabs -->
	<div id="time"></div>
	<ul class="nav nav-tabs rates-mode-tabs">
		<li class="active"><a href="#tab0" data-toggle="tab"><i class="icon-arrow-up"></i><i class="icon-arrow-down"></i> Above/Below</a></li>
		<li><a href="#tab1" data-toggle="tab"><i class="icon-time"></i> Option Builder</a></li> 
		<li><a href="#tab2" data-toggle="tab"><i class="icon-time"></i> 60 seconds</a></li>
		<!--  
		<li><a href="#tab2" data-toggle="tab"><i class="icon-time"></i> 2 minutes</a></li>
		<li><a href="#tab3" data-toggle="tab"><i class="icon-time"></i> 5 minutes</a></li>
		-->
		
	</ul>
	<div class="tab-content options">
	    <div class="tab-pane active" id="tab0">
			<div class="">
				<ul class="thumbnails">
				</ul>
			</div>	
	    </div>

	    <div class="tab-pane" id="tab1">
			<div class="">
				<ul class="thumbnails">
				</ul>
			</div>	
	    </div>    
	    
	    
	   <div class="tab-pane" id="tab2">
			<div class="">
				<ul class="thumbnails">
				</ul>
			</div>	
	    </div>   
	    
	    
	   <div class="tab-pane" id="tab3">
			<div class=""> <!-- row-fluid -->
				<ul class="thumbnails">
				</ul>
			</div>	
	
	    </div>     
	    
	   <div class="tab-pane" id="tab4">
			<div class=""> <!-- row-fluid -->
				<ul class="thumbnails">
				</ul>
			</div>	
	
	    </div>  	       
             
    </div>
  </div>
		<div id="rates-list" class="tabbable">
			<ul class="nav nav-tabs rates-status-tabs">
				<li class="active opened"><a href="#opend-rates" class="opend-rates" data-toggle="tab"><i class="icon-fire"></i> Opened rates</a></li>
				<li class="closed"><a href="#closed-rates" class="closed-rates" data-toggle="tab"><i class="icon-ok-circle"></i> Closed rates</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="opend-rates">
					<table class="table table-hover" style="background-color: rgba(241, 241, 241, 1)">
						<thead>
							<tr>
								<th>Currency</th>
								<th>Order</th>
								<th>Strike time</th>
								<th>Expiry</th>
								<th>Strike</th>
								<th>Expiration rate</th>
								<th>Amount</th>
								<th>Return</th>
								<th>Current</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						</tbody>			
					</table>
				</div>
				<div class="tab-pane" id="closed-rates">
				</div>
			</div>
		</div>  
  
</div>	

<script id="open-rate-rows" type="text/x-jquery-tmpl">
{{each dataItems}}
	<tr data-symbol="${currency}" data-rateID="${rate_id}">
		<td>${currency}</td>
    	<td>${type}</td>
		<td>${rate_date}</td>
        <td>${expiry_date}</td>
		<td>${rate}</td>
		<td class="expiration">${expiration}</td>
		<td>$ ${priceValue}</td> 
		<td>$ ${returnValue}</td>
		<td class="current"></td>
		<td class="status"></td>
	</tr>
{{/each}}
</script>

<script id="_thumbnail-tmpl" type="text/x-jquery-tmpl">
<li data-type="${type}" class="span4 chartBlock ${type}" id="chart${id}">
	<input calss="payout" value="1.85" type="hidden"/>
	<div class="thumbnail">
		<div class="processing">
			<img src="/images/loader.gif" alt=""/>
		</div>
		<div class="thumbnail-title">							
			<div class="currency">
				<select>
					<optgroup label="Currencies">
						<option value="EUR/USD">EUR/USD</option>
						<option value="AUD/USD">AUD/USD</option>
						<option value="GBP/USD">GBP/USD</option>
						<option value="EUR/GBP">EUR/GBP</option>
						<option value="USD/JPY">USD/JPY</option>
						<option value="EUR/JPY">EUR/JPY</option>
						<option value="XPD/USD">XPD/USD</option>
						<option value="AUD/CADY">AUD/CADY</option>
						<option value="AUD/CHF">AUD/CHF</option>
						<option value="GBP/JPY">GBP/JPY</option>
						<option value="EUR/AUD">EUR/AUD</option>
						<option value="USD/CAD">USD/CAD</option>
						<option value="EUR/CHF">EUR/CHF</option>
						<option value="USD/CHF">USD/CHF</option>
					</optgroup>
‏					<optgroup label="COMMODITIES">
						<option value="Crude Oil">Crude Oil</option>
						<option value="Gold">Gold</option>
						<option value="SILVER">SILVER</option>
						<option value="PLATINUM">PLATINUM</option>
						<option value="SUGAR">SUGAR</option>
						<option value="WHEAT">WHEAT</option>
						<option value="CORN">CORN</option>
						<option value="COFFEE">COFFEE</option>
					</optgroup>
‏					<optgroup label="STOCKS">
						<option value="APPLE">APPLE</option>
						<option value="MICROSOFT">MICROSOFT</option>
						<option value="GOOGLE">GOOGLE</option>
						<option value="IBM">IBM</option>
						<option value="Tata Steel Ltd.">Tata Steel Ltd.</option>
						<option value="AMAT (Applied Materials, Inc)">AMAT (Applied Materials, Inc)</option>
						<option value="AIG">AIG</option>
						<option value="BARCLAYS">BARCLAYS</option>
						<option value="BIDU">BIDU</option>
						<option value="BNP PARIBAS">BNP PARIBAS</option>
						<option value="BP">BP</option>
						<option value="CITI GROUP">CITI GROUP</option>
						<option value="COCA COLA">COCA COLA</option>
						<option value="DISNEY">DISNEY</option>
						<option value="JP MORGAN CHASE">JP MORGAN CHASE</option>
						<option value="GAZPROM">GAZPROM</option>
						<option value="GOLDMAN SACHS">GOLDMAN SACHS</option>
						<option value="HSBC HOLDINGS">HSBC HOLDINGS</option>
						<option value="STATE.BANK INDIA">STATE.BANK INDIA</option>
						<option value="TOYOTA">TOYOTA</option>
					</optgroup>
					<optgroup label="INDICIES">
						<option value="NASDAQ">NASDAQ</option>
						<option value="S&P 500">S&P 500</option>
						<option value="NASDAQ FUTURES">NASDAQ FUTURES</option>
					</optgroup>
				</select>
			</div>
			<div class="expires">
				<label>Expires at </label>
				{{if type=="above-below"}}
					<select>
					</select>
				{{else type=="60sec"}}
					<select disabled>
						<option value="60" selected>60 seconds</option>
					</select>	
				{{else type=="2min"}}
					<select disabled>
						<option value="120" selected>2 minutes</option>
					</select>	
				{{else type=="5min"}}
					<select disabled>
						<option value="300" selected>5 minutes</option>
					</select>
				{{else type=="builder"}}
					<select class="hours">
						<option value="0" selected>hours</option>
						<?php for($i=0; $i<=23; $i++): ?>
						<option value="<?php echo $i * 60; ?>"><?php echo substr("0{$i}", -2); ?></option>
						<?php endfor; ?>
					</select>
					<select class="minutes">
						<option value="0" selected>minutes</option>
						<?php for($i=0; $i<=59; $i++): ?>
							<?php if($i%5 == 0): ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php endif; ?>
						<?php endfor; ?>
					</select>
				{{/if}}
			</div>
			<div class="payout">Payout 85%</div>
			<div class="countdown"></div>
		</div>
		<div data-attitude="${currency}" class="chart"  style="width: 300px; height: 200px; margin: 0 auto"></div>
		<div class="caption">
			<h3>Option price</h3>
			<p></p>
			<div class="btns-row">
				<a data-direction="above" href="#" class="btn btn-left above"></a> 
				<span class="option-price"></span>
				<a data-direction="below" href="#" class="btn btn-right below"></a>
			</div>
			<div class="progress-values">
				<div class="left above percent">50%</div>
				<div class="center">Traders choice</div>
				<div class="right below percent">50%</div>
			</div>
			<div class="progress">
			  <div class="bar bar-success above" style="width: 50%;"></div>
			  <div class="bar bar-warning below" style="width: 50%;"></div>
			</div>
			<div class="strike-form" style="height:150px; background:#1d1d1d; display:none;">
			</div>
		</div>
	</div>
</li>
</script>
						
						
						
						
<script id="_thumbnail-abovebelow-tmpl" type="text/x-jquery-tmpl">
<li data-widgetName="${widgetName}" class="span4 chartBlock ${widgetName}" id="chart${id}">
	<input calss="payout" value="1.85" type="hidden"/>
	<div class="thumbnail">
		<div class="processing">
			<img src="/images/loader.gif" alt=""/>
		</div>
		<div class="thumbnail-header">							
			<div class="currency">
				<div class="styled-select">
				<select> 
					<?php foreach($symbolGroups as $group): ?>
						<optgroup label="<?php echo $group->group_name; ?>">
						<?php foreach($group->symbols as $symbol): ?>
							<option value="<?php echo $symbol->symbol; ?>"><?php echo $symbol->symbol_name; ?></option>
						<?php endforeach; ?>
						</optgroup>
					<?php endforeach; ?>‏
				</select>
				</div>
			</div>
			<div class="expires-row">
				<div class="expires">
					<label>Expires at </label>
					<div class="styled-select">
						<select></select>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
			<div class="payout"><h2>Payout <strong>85%</strong></h2></div>
		</div>
		<div class="periods">
			<span class="label" data-hour="0.5">30 min</span>
			<span class="label" data-hour="1">1 hour</span>
			<span class="label active" data-hour="2">2 hour</span>
			<span class="label active" data-hour="4">4 hour</span>
		</div>
		<div data-attitude="${currency}" class="chart"  style="width: 300px; height: 200px; margin: 0 auto"></div>
		<div class="caption">
			<h3>Option price</h3>
			<p></p>
			<div class="btns-row">
				<a data-direction="above" href="#" class="btn btn-primary btn-left above"></a> 
				<span class="option-price"></span>
				<a data-direction="below" href="#" class="btn btn-warning btn-right below"></a>
			</div>
			<div class="progress-values">
				<div class="left above percent">50%</div>
				<div class="center">Traders choice</div>
				<div class="right below percent">50%</div>
			</div>
			<div class="progress">
			  <div class="bar bar-success above" style="width: 50%;"></div>
			  <div class="bar bar-warning below" style="width: 50%;"></div>
			</div>
			<div class="strike-form" style="height:150px; background:#1d1d1d; display:none;">
			</div>
		</div>
	</div>
</li>
</script>



<script id="_thumbnail-builder-tmpl" type="text/x-jquery-tmpl">
<li data-widgetName="${widgetName}" class="span4 chartBlock ${widgetName}" id="chart${id}">
	<input calss="payout" value="1.85" type="hidden"/>
	<div class="thumbnail">
		<div class="processing">
			<img src="/images/loader.gif" alt=""/>
		</div>
		<div class="thumbnail-header">							
			<div class="currency">
				<div class="styled-select">
				<select> 
					<?php foreach($symbolGroups as $group): ?>
						<optgroup label="<?php echo $group->group_name; ?>">
						<?php foreach($group->symbols as $symbol): ?>
							<option value="<?php echo $symbol->symbol; ?>"><?php echo $symbol->symbol_name; ?></option>
						<?php endforeach; ?>
						</optgroup>
					<?php endforeach; ?>‏
				</select>
				</div>
			</div>
			<div class="expires-row">
				<div class="expires">
					<label>Expires at </label>
					<select class="hours">
						<option value="0" selected>hours</option>
						<?php for($i=0; $i<=23; $i++): ?>
						<option value="<?php echo $i * 60; ?>"><?php echo substr("0{$i}", -2); ?></option>
						<?php endfor; ?>
					</select>
					<select class="minutes">
						<option value="0" selected>minutes</option>
						<?php for($i=0; $i<=59; $i++): ?>
							<?php if($i%5 == 0): ?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php endif; ?>
						<?php endfor; ?>
					</select>
				</div>
				<div style="clear:both"></div>
			</div>
			<div class="payout"><h2>Payout <strong>85%</strong></h2></div>
		</div>
		<div data-attitude="${currency}" class="chart"  style="width: 300px; height: 200px; margin: 0 auto"></div>
		<div class="caption">
			<h3>Option price</h3>
			<p></p>
			<div class="btns-row">
				<a data-direction="above" href="#" class="btn btn-primary btn-left above"></a> 
				<span class="option-price"></span>
				<a data-direction="below" href="#" class="btn btn-warning btn-right below"></a>
			</div>
			<div class="progress-values">
				<div class="left above percent">50%</div>
				<div class="center">Traders choice</div>
				<div class="right below percent">50%</div>
			</div>
			<div class="progress">
			  <div class="bar bar-success above" style="width: 50%;"></div>
			  <div class="bar bar-warning below" style="width: 50%;"></div>
			</div>
			<div class="strike-form" style="height:150px; background:#1d1d1d; display:none;">
			</div>
		</div>
	</div>
</li>
</script>

						

						
						
						
<script id="_thumbnail-60seconds-tmpl" type="text/x-jquery-tmpl">
<li data-widgetName="${widgetName}" class="span4 chartBlock ${widgetName}" id="chart${id}">
	<input calss="payout" value="1.85" type="hidden"/>
	<div class="thumbnail">
		<div class="processing">
			<img src="/images/loader.gif" alt=""/>
		</div>
		<div class="thumbnail-header">							
			<div class="currency">
				<div class="styled-select">
				<select> 
					<?php foreach($symbolGroups as $group): ?>
						<optgroup label="<?php echo $group->group_name; ?>">
						<?php foreach($group->symbols as $symbol): ?>
							<option value="<?php echo $symbol->symbol; ?>"><?php echo $symbol->symbol_name; ?></option>
						<?php endforeach; ?>
						</optgroup>
					<?php endforeach; ?>‏
				</select>
				</div>
			</div>
			<div class="expires-row">
				<div class="expires">
					<label>Expires at </label>
					<div class="styled-select">
						<select disabled>
							<option value="60" selected>60 seconds</option>
						</select>	
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
			<div class="payout"><h2>Payout <strong>85%</strong></h2></div>
		</div>
		<div data-attitude="${currency}" class="chart"  style="width: 300px; height: 200px; margin: 0 auto"></div>
		<div class="caption">
			<h3>Option price</h3>
			<p></p>
			<div class="btns-row">
				<a data-direction="above" href="#" class="btn btn-primary btn-left above"></a> 
				<span class="option-price"></span>
				<a data-direction="below" href="#" class="btn btn-warning btn-right below"></a>
			</div>
			<div class="progress-values">
				<div class="left above percent">50%</div>
				<div class="center">Traders choice</div>
				<div class="right below percent">50%</div>
			</div>
			<div class="progress">
			  <div class="bar bar-success above" style="width: 50%;"></div>
			  <div class="bar bar-warning below" style="width: 50%;"></div>
			</div>
			<div class="strike-form" style="height:150px; background:#1d1d1d; display:none;">
			</div>
		</div>
	</div>
</li>
</script>						
					
					
					
						

<style>
.strike-form form{
	margin:0px;
}
.strike-form table td{
	position:relative;
}
.strike-form table .direction,
.strike-form table .expires{
	height:30px;
}
.strike-form table{
	border-spacing:5px;
	border-collapse: separate;
}
.strike-form .close{
	float:right
}
.strike-form table.above{
	background:url(/images/222.png) no-repeat left top;
}
.strike-form table.above span.above{
	display:block;
	color: #16B823;
	font-weight: bold;
	text-shadow: 2px 1px 4px #000;	
}
.strike-form table.below{
	background:url(/images/1.png) no-repeat right top;
}
.strike-form table.below span.below{
	display:block;
	color: #F0720F;
	font-weight: bold;
	text-shadow: 2px 1px 4px #000;	
}


.strike-form table .direction{
	position:absolute; width:70px; 
}
.strike-form table .direction span{
	display:none; line-height:30px;
}
.strike-form table .expires{
	overflow:hidden; 
	margin-left:70px;
	font-size: 13px;
	line-height: 30px;	
}
.strike-form table .investment{

}
.strike-form table .investment label{
	float:left; width:80px; line-height:30px; margin:0px;
}
.strike-form table .investment input{
	height:15px; width:40px; float:right;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;	
	margin-top:2px;
	padding-left:25px; 
	background:#FFF url(/images/dollar.png) no-repeat left 50%; 
}
.strike-form table .btn-cell{
	vertical-align:top; 
}
.strike-form table .btn{
	height:63px; width:100%; padding:0px; margin:0px; 
	background:url(/images/strike-btn-bg.png) no-repeat 50% 50%; 
}
.strike-form table td{
	padding:0px; height:30px; text-shadow: 2px 1px 4px #000;	
}

.strike-form table .payout-res.error{
	color:#F70B0B
}
.investment{
	width:190px;
}


.periods{
	padding: 0 15px; /* text-align:right; */ padding-left: 45px;
}
.periods .label{
	cursor:pointer; margin-left:10px;
}
.periods .label.active{
	background-color: #797979;
}

</style>

	

<script id="strike-form-tmpl" type="text/x-jquery-tmpl">
<form class="form-account form-horizontal" id="horizontalForm" action="" method="get">	
	<a class="close" href="#"><i class="icon-remove-circle icon-white"></i></a>Please Enter Investment Amount
	<table class="${rateData.direction}" style="width:100%" border=0>
		<tr>
			<td colspan="2">
				<div class="direction">
					<span class="above">CAll</span>
					<span class="below">PUT</span>
				</div>
				<div class="expires">${rateData.expiry_date}</div>
			</td>
		</tr>
		 <tr> 
     		<td class="investment">
				<label>Investment</label>
				<input class="price" type="text"/>
			</td>
			<td rowspan="2" class="btn-cell">
				
			<input type="submit" name="apply" class="btn btn-danger apply" value="Apply">
			</td>
    	</tr>
 		<tr>   
			<td class="payout-res">PayOut</td>
    	</tr>

	</table>
    
</form>
</script>

<script>
	var Config = Config || {};
	Config.debug = true; 
	Config.user = {
		user_id: '<?php echo Yii::app()->user->id; ?>',
		balance: '<?php echo Yii::app()->user->balance; ?>',
		deposit: '<?php echo Yii::app()->user->deposit; ?>'
	}
</script>
