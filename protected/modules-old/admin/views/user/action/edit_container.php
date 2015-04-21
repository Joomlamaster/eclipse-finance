<div>
	<ul class="nav nav-pills">
		<li <?php if($this->action->id == 'edit'): ?>class="active";<?php endif; ?>><a href="<?php echo $this->createUrl('user/action/edit', array('user_id' => Yii::app()->request->getQuery('user_id'))); ?>">Defaults</a></li>
	</ul>
</div>
<div>	
	<?php echo $content; ?>
</div>
