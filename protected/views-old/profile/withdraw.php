<?php $this->beginContent('container'); ?>
		<form action="" name="pay" id="pay" method="POST">
			<div>
				<label for="uniqueid">UniqueID:</label>
				<input type="text" id="uniqueid" name="uniqueid"/>
			</div>
			<div>
				<label for="amount">Amount:</label>
				<input type="text" id="amount" name="amount"/>
			</div>
			<input type="submit" name="payform" value="Pay"/>
		</form>
<?php $this->endContent();?>