    <style type="text/css">
      .form-signin {
        max-width: 500px;
        padding: 19px 29px 29px;
        margin: 30px auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
               text-align:left;
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

<div id="content">
	<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'recovery-form',
		//'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'htmlOptions' => array(
				'class' => 'form-signin',
		),
	)); ?>
	<h2 class="form-signin-heading">Password recovery</h2>
	<p class="hint">Set new password</p>
		<?php 
		$this->widget('bootstrap.widgets.TbAlert', array(
		    'block'=>true, // display a larger alert block?
		    'fade'=>true, // use transitions?
		    'closeText'=>'×', // close link text - if set to false, no close link is displayed
		    'alerts'=>array( // configurations per alert type
			    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger,
				'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
		    )
		));
		?>
		<?php echo CHtml::errorSummary($model); ?>
		
			<?php echo $form->labelEx($model,'user_password_new', array('style' => '')); ?>
			<?php echo $form->passwordField($model,'user_password_new', array('class' => 'input-block-level')); ?>
			<?php echo $form->error($model,'user_password_new', array('style' => '')); ?>
		
			<?php echo $form->labelEx($model,'user_password_repeat', array('style' => '')); ?>
			<?php echo $form->passwordField($model,'user_password_repeat', array('class' => 'input-block-level')); ?>
			<?php echo $form->error($model,'user_password_repeat', array('style' => '')); ?>
					
			<?php echo CHtml::submitButton('Recovery',array('class' => 'btn btn-large btn-primary')); ?>
		
		
	<?php $this->endWidget(); ?>
	</div><!-- form -->		
</div>