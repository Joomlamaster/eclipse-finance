<style>
legend{
	color:#999; 
}
#accordion2 {margin-bottom: 0 !important;}

#horizontalForm a.accordion-toggle:hover, #horizontalForm a.accordion-toggle.active {
background: #000;
color: #fff;
}
#horizontalForm a.accordion-toggle {
background: #fff;
color: #000;
}
.form-actions {
background-color: transparent; 
border-top: 0 none; 
text-align: right;
width: 220px;
}
label[for=DepositForm_VirtualCard] {
  display: none;
}
</style>
<?php $this->beginContent('container'); ?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'horizontalForm',
	'action' => '/profile/cashier/sendRequest',
	'type' => 'horizontal',
	//'class' => 'form-horizontal',
	'inlineErrors' => false,
	'htmlOptions' => array(
	),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>



<div class="accordion" id="accordion2">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
				<span class="indicate">&gt;</span> Credit Card
			</a>
		</div>
		<div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
				<?php 
				$this->widget('bootstrap.widgets.TbAlert', array(
				    'block'=>true, // display a larger alert block?
				    'fade'=>true, // use transitions?
				    'closeText'=>'×', // close link text - if set to false, no close link is displayed
				    'alerts'=>array( // configurations per alert type
					    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
				    )
				));
				?>	
				<table>
					<tr>
						<td></td>
						<td></td>
					</tr>
				</table>
				
				
				<fieldset>
				 
				    <legend>Customer Details</legend>
				    <?php echo $form->textFieldRow($model, 'FirstName'); ?>
				    <?php echo $form->textFieldRow($model, 'LastName'); ?>
				    <?php echo $form->textFieldRow($model, 'Phone'); ?>
				    <?php echo $form->textFieldRow($model, 'Email'); ?>
				    
				    <legend>Billing Details. Card will be sent to this address</legend>
					<?php echo $form->textFieldRow($model, 'FirstName'); ?>
				    <?php echo $form->textFieldRow($model, 'LastName'); ?>   
				    <?php echo $form->textFieldRow($model, 'Street'); ?> 
				    <?php echo $form->textFieldRow($model, 'City'); ?> 
				    <?php echo $form->textFieldRow($model, 'Region'); ?> 
				    <?php echo $form->dropDownListRow($model, 'Country', CHtml::listData(Country::model()->findAll(), 'iso', 'name'), array('empty' => 'Select country')); ?> 
				    <?php echo $form->textFieldRow($model, 'Zip'); ?> 
				    
				    <legend>Card Details</legend>
				    <?php echo $form->textFieldRow($model, 'CardHolderName'); ?>
				    <?php echo $form->textFieldRow($model, 'CardNumber'); ?>
				    <?php echo $form->textFieldRow($model, 'CardExpireMonth'); ?>
				    <?php echo $form->textFieldRow($model, 'CardExpireYear'); ?>
				    <?php echo $form->dropDownListRow($model, 'CardType', array('VI' => 'Visa', 'MC' => 'Mastercard')); ?>
				    <?php echo $form->textFieldRow($model, 'CardSecurityCode'); ?>
				    <?php echo $form->checkBoxRow($model, 'VirtualCard'); ?>
				    
				    <legend></legend>
				    <?php if(Yii::app()->user->currency_id): ?>
						<?php echo $form->hiddenField($model, 'CurrencyCode'); ?>
						<?php echo $form->dropDownListRow($model, 'CurrencyCode', CHtml::listData(Currencies::model()->findAll(), 'currency_name', 'currency_name'), array("disabled"=> true)); ?>
				    <?php else: ?>
				    	<?php echo $form->dropDownListRow($model, 'CurrencyCode', CHtml::listData(Currencies::model()->findAll(), 'currency_name', 'currency_name')); ?>
				    <?php endif; ?>
				   
					
				    <?php echo $form->textFieldRow($model, 'TotalAmount'); ?>
				    
					<div class="form-actions">
					    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
					    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
					</div>    
				</fieldset>
				
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
	
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#neteller">
				<span class="indicate">&gt;</span> Neteller
			</a>
		</div>
		<div id="neteller" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
				<?php echo $netellerPage->page_body; ?>
			</div>
		</div>	
	</div>
	
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#wire">
				<span class="indicate">&gt;</span> Bank Wire
			</a>
		</div>
		<div id="wire" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
            <div style="padding: 20px;">
   <h3>For International Bank Wires:</h3>

<strong>Beneficiary Name:</strong> Billion Million International Limited<br/>
<strong>Beneficiary Address:</strong> Suite C, 19/F, Tower A, Billion Centre,<br/> 1 Wang Kwong Road, Kowloon Bay, Hong Kong<br/>
<strong>Bank Name:</strong> Citibank (Hong Kong) Limited<br/>
<strong>Multi Currency Account number:</strong> 88287130<br/>

<strong>Bank Code:</strong> 250<br/>
<strong>Branch Code:</strong> 390<br/>
<strong>Branch Address:</strong> 10/F, Rooms 1002-1003, Wheelock House,<br/> 20 Pedder Street, Hong Kong<br/>
<strong>Swift code:</strong> CITIHKAX<br/>


<h3>For Bank Wires Within The Mainland China:</h3>

<strong>Beneficiary Name:</strong> 雷雨<br/>
<strong>Bank Name:</strong> CHINA EVERBRIGHT BANK (中国光大银行)<br/>
<strong>Account number:</strong> 9003010400016751<br/>
<strong>Bank address:</strong> CEB BLDG NO.18, ZIZHU QI AVE, SHENZHEN, CHINA (深圳市)<br/>
<strong>Branch Name:</strong> SHENZHEN BRANCH (深圳分行)<br/><br/>

<p>Please note: The minimum bank wire amount should be 1000 USD. In order comply with the AML/KYC rules and regulations and for ones account to be funded and activated please provide us with the documents listed in <a href="/page/compliance_procedure">Compliance Procedure</a> to: verification@eclipse-finance.com</p>
   </div>
				<?php echo $wirePage->page_body; ?>
			</div>
		</div>	
	</div>	
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#payu">
				<span class="indicate">&gt;</span> China Union Pay 
			</a>
		</div>
		<div id="payu" class="accordion-body collapse" style="height: 0px;">
			<div class="accordion-inner">
				﻿﻿<?php
if (isset($_POST['b1'])){
	$MerNo = $_POST['MerNo'];
	$BillNo = $_POST['BillNo'];
	$Amount = $_POST['Amount'];


	$ReturnURL = $_POST['ReturnURL'];
	$AdviceURL = $_POST['AdviceURL'];
	$orderTime = $_POST['orderTime'];
	
	$signsrc = $MerNo ."&". $BillNo ."&". $Amount ."&". $ReturnURL ."&". $MerNo;  //Check the source string
	$SignInfo = hash('sha256', $signsrc);
	$_POST['SignInfo'] = $SignInfo;
	
	submitter('http://www.ishop88n.com/payapi/payapi.php',$_POST);
	
}else{
	$MerNo = "N0027";     //Merchant NO 
	$BillNo = "0000000" . date("his");  //[Required] Order Number (Merchant own produce: asked not to repeat)
	$Amount = "";    //[Required] Order Amount

	$ReturnURL = "http://" . $_SERVER['SERVER_NAME'] ."/profile/cashier/payapiresult";    //[Required] to return data to the merchant's address (the merchant to fill out) Please note that this address to tell us before the test personnel; otherwise the test not pass
	$AdviceURL = "http://" . $_SERVER['SERVER_NAME'] . "/profile/cashier/payapiadvice";   //[Required] after the payment is completed, the results of the background to receive the payment, can be used to update the database values
	$orderTime = date("YmdHis");   //[Required] Trading Hours YYYYMMDDHHMMSS
}

function submitter($url, $params) {
        ?>
        <html>
            <head>
                <title>Payment By CreditCard online</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            </head>
            <body>
                <form action="<?php echo $url; ?>" method="post" id="sendform" name="E_FORM">

                    <?php foreach ($params as $key => $value) { ?>
                        <input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
                    <?php } ?>
                    <input style="display:none;" type="submit" value="go"/>
                </form>
            </body>
            <script type="text/javascript">
                window.onload = function() {
                    document.getElementById('sendform').submit();
                };
            </script>
        </html>

        <?php
    }
?>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <form id="e_form" action="" method="post" name="E_FORM">
            <table align="center">

                <tr>
                    <!--<td>MerNo</td>-->
                    <td><input type="hidden" name="MerNo" value="<?php echo $MerNo ?>"></td>
                </tr>
                <tr>
                    <!--<td>BillNo</td>-->
                    <td><input type="hidden" name="BillNo" value="<?php echo $BillNo ?>"></td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td><input type="text" id="amount" name="Amount" value="<?php echo $Amount ?>"></td>
                </tr>

                <tr>
                    <!--<td>ReturnURL</td>-->
                    <td><input type="hidden" name="ReturnURL" value="<?php echo $ReturnURL ?>" ></td>
                </tr>

                <tr>
                    <!--<td>AdviceURL</td>-->
                    <td><input type="hidden" name="AdviceURL" value="<?php echo $AdviceURL ?>" ></td>
                </tr>
                <tr>
                    <!--<td>orderTime YYYYMMDDHHMMSS</td>-->
                    <td><input type="hidden" name="orderTime" value="<?php echo $orderTime ?>"></td>
                </tr>
			
                <tr>
                    <!--<td>SignInfo</td>-->
                    <td><input type="hidden" id="s_info" name="SignInfo" value="<?php echo $SignInfo ?>"></td>
                </tr>

            </table>
            <p align="center">
                <input type="submit" name="b1" value="Payment">
            </p>
        </form>
    </body>
</html>
			</div>
		</div>	
	</div>
</div>


<?php $this->endContent();?>
<script>
	$('.accordion-toggle').click(function () {
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).css('background', '#fff').css('color', '#000');
		} else {
			$(this).addClass('active');
			$(this).css('background', '#000').css('color', '#fff');
		}
	});
</script>