<style>
.page-content-title span { background: url(/images/letter_from_ceo.png);}
</style>

<div class="content" id="page-content" style="margin-top: 20px;">
<div class="page-content-title eclipse_finance">
<span></span>
Contact Us
</div>

	<?php /** @var BootActiveForm $form */

	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(

	    'id'=>'verticalForm',

		'enableClientValidation'=>true,

		'clientOptions'=>array(

			'validateOnSubmit'=>true,

		),		

	    'htmlOptions'=>array('class'=>''),	

	)); ?>

	 

	<?php $this->widget('bootstrap.widgets.TbAlert', array(

	        'block'=>true, // display a larger alert block?

	        'fade'=>true, // use transitions?

	        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed

	        'alerts'=>array( // configurations per alert type

	            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger

	        ),

	    )); ?> 

	 
<div class="form-contact" style="display: block; height: 1012px;">

<div style="float: left;">
<div class="loc-map" style="margin-top: 0; display:block; float: right; margin-bottom: 30px">
<div style="float: left; margin-top:-77px margin-bottom: 30px;">
<p><h2>Our Location Map</h2></p>
<img src="../images/loc-map-new.png" />
</div>

</div>
<br/>
<h2>Feedback Form</h2>
	<?php echo $form->textFieldRow($model, 'name', array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3')); ?>
	
	<?php echo $form->textFieldRow($model, 'skype', array('class'=>'span3')); ?>
   
   <?php echo $form->textFieldRow($model, 'phone', array('class'=>'span3')); ?>
	
	<?php echo $form->dropDownListRow($model, 'department', array('General' => 'General', 'Accounting' => 'Accounting', 'Support' => 'Support', 'Marketing' => 'Marketing'), array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model, 'subject', array('class'=>'span3', 'style' => 'width:300px')); ?>

	<?php echo $form->textAreaRow($model, 'message', array('class'=>'span3', 'style' => "width:400px;height: 100px;")); ?>

	<div>

		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type' => 'primary', 'label'=>'Submit')); ?>

	</div> 
</div>

   <div class="contact-details-holder" style="display: block; height: 700px; margin-top: 25px;">
      <div style="float: right; width: 444px; margin-left: 44px; color:#928d7d;" >
         <p><h2>Head Office Address</h2></p> <p>3rd Floor, 49 Farringdon Road, London,<br/>EC1M 3JP, United Kingdom</p>
         <h2>Business Hours</h2>
         <p>Monday-Friday: 9am - 9pm BTS<br/>
         Saturday: 5pm - 2am  BTS<br/>
         Sunday: Closed<br/><br/>

         *Time in British Summer Time (UTC/GMT+1)</p>
         
         <h2>Corporate Address</h2>
         <p>________________________________________________</p>
         
          <h2>Clearing and Billing</h2>
         <p>3rd Floor, 49 Farringdon Road, London,<br/>EC1M 3JP, United Kingdom</p>
         <div>
         <h2>Telephone Support</h2>
         <img src="../images/uk-flag.png"/>+44 123456789<br/>
         <img src="../images/us-flag.png"/>+1 123456789<br/>
         <img src="../images/sg-flag.png"/>+65 123456789
         </div>
         <div class="contact-list" style="color:#928d7d;">
         <div style="margin-left: -22px;"><h2>Email Support</h2></div>
            <div style="float: left; margin-left: -23px">
            
            <ul style="list-style: none; padding-left: 0;">
               <li><strong>Customer Support</strong><br/>Support@eclipse-finance.com</li>
               <li><strong>Finance Department</strong><br/>Finance@eclipse-finance.com</li>
               <li><strong>General Inquiries</strong><br/>info@eclipse-finance.com</li>
               </ul>
            </div>
         <div style="float: left;">
            <ul style="list-style: none;">
               <li><strong>Verification Department</strong><br/>Verification@eclipse-finance.com</li>
               <li><strong>Trading Desk</strong><br/>Trading@eclipse-finance.com</li>

            </ul>
         </div>
         <br/>
         
      </div>
         
      </div>

      
   </div>


</div> <?php /* End of form-contact */ ?>
	<?php $this->endWidget(); ?>

</div>