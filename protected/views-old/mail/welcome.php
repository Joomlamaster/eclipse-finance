<style type="text/css">

#accountTypes .accountTable  {display: table; width: 710px; font: 12px Arial; margin-bottom: 40px;}

#accountTypes .accountTable div {font-size: 14px;}
#accountTypes .row          {display: table-row;}
#accountTypes .cell         {display: table-cell; border-bottom: 1px #d9d8d8 solid; border-right: 1px #d9d8d8 solid; padding: 10px; width: 100px;  color: #000; text-align: center; background: #eee;}
#accountTypes .last         {border-bottom: 1px #d9d8d8 solid;}
#accountTypes .title        {background:#ededed;  width: 107px; text-align: left;}
#accountTypes .headerCell   {background:#ededed; display: table-cell; border-bottom: 1px #d9d8d8 solid; border-right: 1px #d9d8d8 solid; border-top: 1px #d9d8d8 solid; padding: 10px; width: 100px;  color: #000; font-size: 15px; text-align: center;}
#accountTypes .headerCell.first {background: none repeat scroll 0 0 transparent; border-top:none;}
#accountTypes .cell.last {border-bottom: none;}


#accountTypes .cell i {display:block; background: url("images/v.png")0 0 no-repeat; width: 17px; height: 15px; margin: 0 auto; }

#accountTypes .headerCell span {position:relative; left:5px; top:2px; background: url("http://eclipse-finance.com/images/mail/stars.png")0 0 no-repeat; width: 16px; height: 16px; display: inline-block;}
#accountTypes .headerCell span.silverStar {background-position: -20px 0;}
#accountTypes .headerCell span.goldStar {background-position: -40px 0;}
#accountTypes .headerCell span.platinumStar {background-position: -60px 0;}
#accountTypes .headerCell span.vipStar {background-position: -80px 0;}

#accountTypes .accountTypeCell { width: 116px; height: 98px; font-size:17px; background: url("http://eclipse-finance.com/images/mail/types.png") 0 0 no-repeat; padding: 0; text-align: center; }
#accountTypes .accountTypeCell span {display:block;font-size: 27px; font-weight: bold; padding:8px 0 6px; text-shadow: 1px 1px 5px #ffffff; filter: dropshadow(color=#ffffff, offx=1, offy=1);}
#accountTypes .standard { }
#accountTypes .silver{background-position:-117px 0;}
#accountTypes .gold {background-position:-234px 0;}
#accountTypes .platinum { background-position:-351px 0;}
#accountTypes .vip {background-position:-468px 0;}

#accountTypes .joinTypeCell { width: 116px; height: 41px; font-size:17px; background: url("http://eclipse-finance.com/images/mail/types.png") 0 0 no-repeat; padding: 0; text-align: center; font-weight: bold;}
#accountTypes .joinTypeCell a {font-size: 17px; color: #ffffff; font-weight: bold; line-height: 36px; text-shadow: 1px 1px 1px #949494; filter: dropshadow(color=#949494, offx=1, offy=1); text-decoration: underline;}
#accountTypes .standardBtn { background-position:0 -108px; }
#accountTypes .silverBtn { background-position:-117px -108px; }
#accountTypes .goldBtn  { background-position:-234px -108px;}
#accountTypes .platinumBtn { background-position:-351px -108px;  }
#accountTypes .vipBtn { background-position:-468px -108px; }

#accountTypes.RU .headerCell span {display: block; margin: 0 auto;}
#accountTypes.RU .joinTypeCell a {font-size: 14px;  }

#accountTypes.AR .headerCell span {left:auto; right:5px;}
#accountTypes.AR .headerCell  {border-right:none; border-left:1px #d9d8d8 solid;}
#accountTypes.AR .cell  {border-right:none; border-left:1px #d9d8d8 solid;}

#accountTypes.DE .joinTypeCell a {font-size: 15px; line-height: 16px; position: relative; top:2px;}
</style>


<div>
<h2>Welcome to Eclipse Finance!</h2>
 
<p>Dear <?php echo $first_name; ?>, </p>
 
<p>Congratulations on becoming an account holder with the world's most prestigious binary options broker. As a rightful member of our investors community you have gained an access to the smartest methods of investing available on the market. Our dedicated team is ready to assist you at any stage of your way to financial success.</p>
 
<p>In order to login to your account at Eclipse-Finance.com please use your email and password. </p>


Email: <?php echo $email; ?><br/>
Password: <?php echo $password; ?>
 
<p>Eclipse Finance specializes in creating tailored financial solutions. One of our account managers will contact you shortly to better understand your needs. In the meanwhile, we invite you to consider the available variations of accounts and their list of benefits mentioned below:</p>
</div>


<div id="accountTypes">
   <div class="accountTable" style="display: table;width: 710px;font: 12px Arial;margin-bottom: 40px;">
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="headerCell first" style="background: none repeat scroll 0 0 transparent;display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;border-top: none;padding: 10px;width: 100px;color: #000;font-size: 14px;text-align: center;">&nbsp;</div>
         <div class="headerCell" style="background: #ededed;display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;border-top: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;font-size: 14px;text-align: center;">Discovery<span style="position: relative;left: 5px;top: 2px;background: url(http://eclipse-finance.com/images/mail/stars.png) 0 0 no-repeat;width: 16px;height: 16px;display: inline-block;"></span></div>
         <div class="headerCell" style="background: #ededed;display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;border-top: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;font-size: 14px;text-align: center;">Standard<span class="silverStar" style="position: relative;left: 5px;top: 2px;background: url(http://eclipse-finance.com/images/mail/stars.png) -20px 0 no-repeat;width: 16px;height: 16px;display: inline-block;background-position: -20px 0;"></span></div>
         <div class="headerCell" style="background: #ededed;display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;border-top: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;font-size: 14px;text-align: center;">Pro Trader<span class="goldStar" style="position: relative;left: 5px;top: 2px;background: url(http://eclipse-finance.com/images/mail/stars.png) -40px 0 no-repeat;width: 16px;height: 16px;display: inline-block;background-position: -40px 0;"></span></div>
         <div class="headerCell" style="background: #ededed;display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;border-top: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;font-size: 14px;text-align: center;">Excellency<span class="platinumStar" style="position: relative;left: 5px;top: 2px;background: url(http://eclipse-finance.com/images/mail/stars.png) -60px 0 no-repeat;width: 16px;height: 16px;display: inline-block;background-position: -60px 0;"></span></div>
         <div class="headerCell" style="background: #ededed;display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;border-top: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;font-size: 14px;text-align: center;">V.I.P<span class="vipStar" style="position: relative;left: 5px;top: 2px;background: url(http://eclipse-finance.com/images/mail/stars.png) -80px 0 no-repeat;width: 16px;height: 16px;display: inline-block;background-position: -80px 0;"></span></div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Initial Bonus Offer</div>
         <div class="cell accountTypeCell standard" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) 0 0 no-repeat;height: 98px;font-size: 14px;">Up to<span style="display: block;font-size: 27px;font-weight: bold;padding: 8px 0 6px;text-shadow: 1px 1px 5px #ffffff;filter: dropshadow(color=#ffffff, offx=1, offy=1);">25%</span>Bonus</div>
         <div class="cell accountTypeCell silver" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) -117px 0 no-repeat;height: 98px;font-size: 14px;background-position: -117px 0;">Up to<span style="display: block;font-size: 27px;font-weight: bold;padding: 8px 0 6px;text-shadow: 1px 1px 5px #ffffff;filter: dropshadow(color=#ffffff, offx=1, offy=1);">50%</span>Bonus</div>
         <div class="cell accountTypeCell gold" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) -234px 0 no-repeat;height: 98px;font-size: 14px;background-position: -234px 0;">Up to<span style="display: block;font-size: 27px;font-weight: bold;padding: 8px 0 6px;text-shadow: 1px 1px 5px #ffffff;filter: dropshadow(color=#ffffff, offx=1, offy=1);">100%</span>Bonus</div>
         <div class="cell accountTypeCell platinum" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) -351px 0 no-repeat;height: 98px;font-size: 14px;background-position: -351px 0;">Up to<span style="display: block;font-size: 27px;font-weight: bold;padding: 8px 0 6px;text-shadow: 1px 1px 5px #ffffff;filter: dropshadow(color=#ffffff, offx=1, offy=1);">150%</span>Bonus</div>
         <div class="cell accountTypeCell vip" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) -468px 0 no-repeat;height: 98px;font-size: 14px;background-position: -468px 0;"><br><span style="display: block;font-size: 27px;font-weight: bold;padding: 8px 0 6px;text-shadow: 1px 1px 5px #ffffff;filter: dropshadow(color=#ffffff, offx=1, offy=1);">250%</span>Bonus</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Initial Deposit</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">$100</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">$750</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">$3,500</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">$15,000</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">$100,000</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Offered Trade size</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Up to $100</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Up to $500</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Up to $1500</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Up to $5,000</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Up to $25,000</div>
      </div>

      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Daily Market Review</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Personal Account Manager</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Daily Live Skype Signals</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Package: Bronze - Silver</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Package: Gold - Platinum&nbsp;</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Package: Diamond</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Package: Diamond</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Risk free trades</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">3 x $250</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">3 x $1,000</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">3 x $1,500</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">5 x $2,500</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Coaching from expert trader</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Monthly cash back</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">3% (*After $35k trading)</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">5.5%&nbsp;(*After $55k trading)</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">7%&nbsp;(*After $85k trading)</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Free Gift</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Apple iPad or Samsung's equivalent</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Apple iPhone or Samsung's equivalent</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Apple Macbook Air or equivalent</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Managed Account</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Package: Micro - Pro</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Package: Premium - VIP Investor</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Corporate Account</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Interest Bearing</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Funds Protection and Insurance</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">From 5.5% to 9% monthly depending on investment</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell title" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 10px;width: 107px;color: #000;text-align: left;background: #ededed;font-size: 14px;">Personal Debit Card</div>
         <div class="cell last" style="display: table-cell;border-bottom: none;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell last" style="display: table-cell;border-bottom: none;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell last" style="display: table-cell;border-bottom: none;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell last" style="display: table-cell;border-bottom: none;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">No</div>
         <div class="cell last" style="display: table-cell;border-bottom: none;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;">Yes</div>
      </div>
      <div class="row" style="display: table-row;font-size: 14px;">
         <div class="cell last" style="display: table-cell;border-bottom: none;border-right: 1px #d9d8d8 solid;padding: 10px;width: 100px;color: #000;text-align: center;background: #eee;font-size: 14px;"></div>
         <div class="cell joinTypeCell standardBtn" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) 0 -108px no-repeat;height: 41px;font-size: 14px;font-weight: bold;background-position: 0 -108px;"><a href="http://eclipse-finance.com/page/account_types" style="font-size: 17px;color: #ffffff;font-weight: bold;line-height: 36px;text-shadow: 1px 1px 1px #949494;filter: dropshadow(color=#949494, offx=1, offy=1);text-decoration: underline;">Join Now</a></div>
         <div class="cell joinTypeCell silverBtn" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) -117px -108px no-repeat;height: 41px;font-size: 14px;font-weight: bold;background-position: -117px -108px;"><a href="http://eclipse-finance.com/page/account_types" style="font-size: 17px;color: #ffffff;font-weight: bold;line-height: 36px;text-shadow: 1px 1px 1px #949494;filter: dropshadow(color=#949494, offx=1, offy=1);text-decoration: underline;">Join Now</a></div>
         <div class="cell joinTypeCell goldBtn" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) -234px -108px no-repeat;height: 41px;font-size: 14px;font-weight: bold;background-position: -234px -108px;"><a href="http://eclipse-finance.com/page/account_types" style="font-size: 17px;color: #ffffff;font-weight: bold;line-height: 36px;text-shadow: 1px 1px 1px #949494;filter: dropshadow(color=#949494, offx=1, offy=1);text-decoration: underline;">Join Now</a></div>
         <div class="cell joinTypeCell platinumBtn" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) -351px -108px no-repeat;height: 41px;font-size: 14px;font-weight: bold;background-position: -351px -108px;"><a href="http://eclipse-finance.com/page/account_types" style="font-size: 17px;color: #ffffff;font-weight: bold;line-height: 36px;text-shadow: 1px 1px 1px #949494;filter: dropshadow(color=#949494, offx=1, offy=1);text-decoration: underline;">Join Now</a></div>
         <div class="cell joinTypeCell vipBtn" style="display: table-cell;border-bottom: 1px #d9d8d8 solid;border-right: 1px #d9d8d8 solid;padding: 0;width: 116px;color: #000;text-align: center;background: url(http://eclipse-finance.com/images/mail/types.png) -468px -108px no-repeat;height: 41px;font-size: 14px;font-weight: bold;background-position: -468px -108px;"><a href="http://eclipse-finance.com/page/account_types" style="font-size: 17px;color: #ffffff;font-weight: bold;line-height: 36px;text-shadow: 1px 1px 1px #949494;filter: dropshadow(color=#949494, offx=1, offy=1);text-decoration: underline;">Join Now</a></div>
      </div>    
   </div>
</div>