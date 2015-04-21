<h2>Your link</h2>
<div contenteditable="true" style="height:100px; width:290px;">
<?php echo strtr(Globals::PartnerLink, array('{pid}' => Yii::app()->user->id)); ?>
</div>