<script>
$(function() {
	setTimeout(function() {
		$('form').submit(); 
	}, 5000);
}); 
</script>
<!--  <body onLoad="document.frmCheckout.submit();"> -->
<?php //var_dump($xmlReq, $encodedMessage, $signature);?>
<form id="frmCheckout" name="frmCheckout" method="POST"
action="https://www.lamdaprocessing.com/securePayments/direct/v1/processor.php">
<input type="hidden" name="version" value="1.0"/>
<input type="hidden" name="encodedMessage" value="<?php echo $encodedMessage; ?>">
<input type="hidden" name="signature" value="<?php echo $signature; ?>">
</form> 
Waiting for response ... 