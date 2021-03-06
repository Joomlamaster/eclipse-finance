<?php $this->beginContent('container'); ?>
<style type="text/css">
a{
	color:blue; 
}
.form-signin {
	width: 400px; 
	padding: 19px 29px 29px;
	margin-top: 20px; 
	background-color: #212121;
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


.input-append, .input-prepend{
	margin-bottom:0px; width:100%;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.input-prepend input[type="text"]{
	height: 20px;
	padding: 7px 9px;
	width: 352px;
}
.input-prepend .add-on {
	padding: 7px 5px;
}
.help-block {
	display: block;
	margin-bottom: 0px;
}


.help-block.error{
	padding-bottom:12px; position:relative; margin-top:-10px;
}

</style>

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
	<h2 class="form-signin-heading">Registration</h2>
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
	
	<?php echo $form->textField($model,'first_name', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('first_name'))); ?>
	<?php echo $form->error($model,'first_name'); ?>	
	
	<?php echo $form->textField($model,'last_name', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('last_name'))); ?>
	<?php echo $form->error($model,'last_name'); ?>	
		
	<?php echo $form->textField($model,'user_email', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_email'))); ?>
	<?php echo $form->error($model,'user_email'); ?>	
	
	<?php echo $form->textField($model,'user_phone', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_phone'))); ?>
	<?php echo $form->error($model,'user_phone'); ?>	
				
	<?php echo $form->dropDownList($model, 'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 'name'), array('class' => 'input-block-level', 'prompt'=>'Select a country')); ?>
	
	<?php echo $form->dropDownList($model, 'experience_id', $model->experience, array('class' => 'input-block-level')); ?>	
		
	<?php echo $form->passwordField($model,'user_password', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_password'))); ?>
	<?php echo $form->error($model,'user_password'); ?>
	
	<?php echo $form->passwordField($model,'password_repeat', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('password_repeat'))); ?>
	<?php echo $form->error($model,'password_repeat'); ?>	

	<?if(CCaptcha::checkRequirements() && Yii::app()->user->isGuest):?>
	    <?=CHtml::activeLabelEx($model, 'verifyCode')?>
	    <?$this->widget('CCaptcha')?>
	    <?=CHtml::activeTextField($model, 'verifyCode')?>
	<?endif?>	
	
	<label class="checkbox">
		<?php echo $form->checkBox($model,'agree'); ?>
		<label for="Users_agree">I am over 18 years of age and I accept these Terms & Conditions</label>
		<?php echo $form->error($model,'agree'); ?>
	</label>	

	<?php echo CHtml::submitButton('Registration', array('class' => 'btn btn-large btn-primary')); ?>
<?php $this->endWidget(); ?>
<?php $this->endContent(); ?>