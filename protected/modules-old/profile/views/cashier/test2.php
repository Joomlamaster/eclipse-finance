<body onLoad="document.frmCheckout.submit();">
<form id="frmCheckout" name="frmCheckout" method="POST"
action="https://test.lamdaprocessing.com/securePayments/direct/v1/processor.php">
<input type="hidden" name="version" value="1.0"/>
<input type="hidden" name="encodedMessage" value="<?php echo $encodedMessage; ?>">
<input type="hidden" name="signature" value="<?php echo $signature; ?>">
</form>
Waiting for response ...