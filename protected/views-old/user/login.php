<style type="text/css">
.form-signin {
	max-width: 400px;
	padding: 19px 29px 29px;
	margin-top: 20px; 
	background-color: #fff;
	border: 1px solid #e5e5e5;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	box-shadow: 0 1px 2px rgba(0,0,0,.05);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
	margin-bottom: 10px;
}
.form-signin input[type="text"],
.form-signin input[type="password"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 15px;
	padding: 7px 9px;
}
</style>

<br/>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'htmlOptions' => array(
		'class' => 'form-signin',
	),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<h2 class="form-signin-heading">Please sign in</h2>
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
	<?php echo $form->textField($model,'username', array('class' => 'input-block-level', 'placeholder' => "Email address")); ?>
	<?php echo $form->error($model,'username'); ?>	
	
	<?php echo $form->passwordField($model,'password', array('class' => 'input-block-level', 'placeholder' => "Password")); ?>
	<?php echo $form->error($model,'password'); ?>

	<label class="checkbox">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</label>	
	
	<p>
		<a style="color:#0084b4" href="<?php echo $this->createUrl('user/password_recovery'); ?>">Forgot password?</a>
	</p>

	<?php echo CHtml::submitButton('Sign in', array('class' => 'btn btn-large btn-primary')); ?>
<?php $this->endWidget(); ?>
