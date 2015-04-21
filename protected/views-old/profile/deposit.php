<?php $this->beginContent('container'); ?>
		<form action="" name="reg" id="reg" method="POST">
			<div>
				<label for="ccnumber">Card Number:</label>
				<input type="text" id="ccnumber" name="ccnumber"/>
			</div>
			<input type="submit" name="regform" value="Register"/>
		</form>
<?php $this->endContent();?>