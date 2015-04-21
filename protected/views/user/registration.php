<?php $this->beginContent('container'); ?>
<style type="text/css">
a{
	color:blue; 
}
.form-signin {
	/* width: 400px;  */
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
.form-group {
clear: both;
overflow: hidden;
margin-bottom: 20px;
}
.form-group lable {
float: left;
display: block;
margin-top: 7px;
}
.col-sm-10.relative-input {
width: 70%;
float: right;
}
input#Users_user_phone {
float: right;
width: 342px;
}
.form-group.phone-number{overflow: visible;}
div#countries_msdd {
width: 101px !important;
}
.relative-input.phone-name .f-icons {
left: 111px;
}
.f-icons.capcha{top: 55px; }
input#Users_verifyCode {
padding-left: 10px !important;
display: block;
margin-top: 20px;
width: 100%;
}
#yw2{
width: 290px;
height: 70px;
}
a#yw2_button {
display: inline-block;
margin-left: 20px;
color: #fff;
font-size: 18px;
}
input.btn.btn-large.btn-primary {
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
background-color: #b8993f;
background-image: -moz-linear-gradient(top, #b8993f, #997E2E);
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#b8993f), to(#997E2E));
background-image: -webkit-linear-gradient(top, #b8993f, #997E2E);
background-image: -o-linear-gradient(top, #b8993f, #997E2E);
background-image: linear-gradient(to bottom, #b8993f, #997E2E);
background-repeat: repeat-x;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b8993f', endColorstr='#997E2E', GradientType=0);
border-color: #b8993f #b8993f #b8993f;
border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
filter: progid:DXImageTransform.Microsoft.gradient(enabled= false);
}
.btn:hover, .btn:focus {
background-position: 0 -43px;
}
.registration-container {
border: 1px solid #e5e5e5;
padding: 10px;
border-radius: 10px;
}
#countries_child {width: 150px; }
li.enabled._msddli_ {
width: 200px;
clear: both;
overflow: hidden;
display: block !important;
}
.ddcommon .ddChild li img {
border: 0 none;
position: relative;
vertical-align: middle;
float: left;
}
span.ddlabel {
float: left;
display: inline-block;
margin-top: -5px;
}
span.description {
float: left;
margin-left: 10px;
margin-top: -5px;
width: 100px;
}
#countries_title .description {display:none !important;}

.hover:hover, .hover:focus, .hover:active {
-webkit-transform: translateY(-6px);
transform: translateY(-6px);
-webkit-animation-name: none !important;
}
.intl-tel-input {
  position: relative;
  display: inline-block;
  float: left !important;
  width: 101px !important;
}

#countries {
  width: 102px;
  float: left;
  border-radius: 0;
  height: 36px;
}

.intl-tel-input .country-list {
  list-style: none !important;
  width: 420px !important;
  color: #000 !important;
  display: inline-block !important;
}
.intl-tel-input .hide {
  display: none !important;
}
.registration-container .country-list li {
  display: block !important;
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
<!--	<h2 class="form-signin-heading">Registration</h2> -->
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
	<div class="form-group">
		<lable for="first_name"  class="col-sm-2 control-label">First Name</lable>
		<div class="col-sm-10 relative-input">
			<?php echo $form->textField($model,'first_name', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('first_name'))); ?>
			<div class="f-icons">
				<i class="fa fa-user fa-icons"></i>
			</div>
			<?php echo $form->error($model,'first_name'); ?>
		</div>
			
	</div>
	
	<div class="form-group">
		<lable for="last_name"  class="col-sm-2 control-label">Last Name</lable>
		<div class="col-sm-10 relative-input">
			<?php echo $form->textField($model,'last_name', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('last_name'))); ?>
			<div class="f-icons">
				<i class="fa fa-user fa-icons"></i>
			</div>
			<?php echo $form->error($model,'last_name'); ?>	
		</div>
		
	</div>
	
	<div class="form-group">
		<lable for="user_email"  class="col-sm-2 control-label">Email</lable>
		<div class="col-sm-10 relative-input">
			<?php echo $form->textField($model,'user_email', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_email'))); ?>
				<div class="f-icons">
				<i class="fa fa-envelope-o fa-icons"></i>
			</div>
			<?php echo $form->error($model,'user_email'); ?>	
		</div>
	</div>
	<div class="form-group phone-number">
		<lable for="user_phone"  class="col-sm-2 control-label">Phone Number</lable>
		<div class="col-sm-10 relative-input">
			<?php $data=Country::model()->findAll(); ?>
			<div class="clearfix">
			<!--<select name="countries-code" id="countries" style="width:300px;">
						<?php foreach ($data as $v) {  ?>
		  					<option value='<?php echo strtolower($v->phonecode); ?>' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo strtolower($v->iso); ?>" data-description="<?php echo $v->nicename; ?>" data-title="+<?php echo strtolower($v->phonecode); ?>">+<?php echo strtolower($v->phonecode); ?></option>
		  				<?php } ?>
					</select> -->
					
				<input id="countries" type="tel" value="+1" placeholder="e.g. +1 702 123 4567">
				<div class="relative-input phone-name">
					<?php echo $form->textField($model,'user_phone', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_phone'))); ?>
					<div class="f-icons">
						<i class="fa fa-phone fa-icons"></i>
					</div>
				</div>
			</div>
			<?php echo $form->error($model,'user_phone'); ?>	
		</div>
	</div>
	<div class="form-group"></div>
	<div class="form-group">
		<lable for="country_id"  class="col-sm-2 control-label">Country</lable>
		<div class="col-sm-10 relative-input">
			<?php echo $form->dropDownList($model, 'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 'name'), array('class' => 'input-block-level', 'prompt'=>'Select a country')); ?>
		</div>
	</div>
	<!--<div class="form-group">
		<lable for="country_id"  class="col-sm-2 control-label">Trading Experience</lable>
		<div class="col-sm-10 relative-input">
			<?php echo $form->dropDownList($model, 'experience_id', $model->experience, array('class' => 'input-block-level')); ?>	
		</div>
	</div>-->

	<div class="form-group">
		<lable for="user_password"  class="col-sm-2 control-label">Password</lable>
		<div class="col-sm-10 relative-input">
			<?php echo $form->passwordField($model,'user_password', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('user_password'))); ?>
				<div class="f-icons">
				<i class="fa fa-lock fa-icons"></i>
			</div>
			<?php echo $form->error($model,'user_password'); ?>
		</div>
	</div>

	<div class="form-group">
		<lable for="password_repeat"  class="col-sm-2 control-label">Repeat</lable>
		<div class="col-sm-10 relative-input">
			<?php echo $form->passwordField($model,'password_repeat', array('class' => 'input-block-level', 'placeholder' => $model->getAttributeLabel('password_repeat'))); ?>
				<div class="f-icons">
				<i class="fa fa-lock fa-icons"></i>
			</div>
			<?php echo $form->error($model,'password_repeat'); ?>	
		</div>
	</div>

	<?php if(CCaptcha::checkRequirements() && Yii::app()->user->isGuest):?>
		<div class="form-group">
			<lable for="verifyCode"  class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model, 'verifyCode'); ?></lable>
			<div class="col-sm-10 relative-input">
	    		<?php $this->widget('CCaptcha'); ?>
	    		<?php echo CHtml::activeTextField($model, 'verifyCode', array('placeholder' => 'Type the text')); ?>
    		</div>
		</div>	    		
	<?php endif; ?>	
	
	<label class="checkbox">
		<?php echo $form->checkBox($model,'agree'); ?>
		<label for="Users_agree">I am over 18 years of age and I accept these Terms & Conditions</label>
		<?php echo $form->error($model,'agree'); ?>
	</label>	

	<?php echo CHtml::submitButton('Open Account', array('class' => 'btn btn-large btn-primary')); ?>
<?php $this->endWidget(); ?>
<?php $this->endContent(); ?>