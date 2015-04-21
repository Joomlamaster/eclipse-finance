<script>
/*$(funciton(){
$(#mainmenu).removeClass();
});*/
</script>
<style type="text/css">
#mainmenu{
display:none;
}
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
<?php if($this->message != "")  : ?>
<script>
$(function(){

$('.input-block-level').addClass('error');
});
</script>
<?php endif; ?>
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
	<?php echo $form->passwordField($model,'password', array('class' => 'input-block-level', 'placeholder' => "Password")); ?>
	<?php echo $form->error($model,'password'); ?>
	<p>
	<span class="help-block error" id="LoginForm_password_em_"><?php echo $this->message; ?></span>
	</p>
	<?php echo CHtml::submitButton('Sign in', array('class' => 'btn btn-large btn-primary')); ?>
<?php $this->endWidget(); ?>
