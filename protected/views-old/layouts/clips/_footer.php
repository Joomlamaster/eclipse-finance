<?php $this->beginClip('footer'); ?>

<?php foreach($pages as $page): ?>
	<ul>
		<li class="title"><?php echo $page->page_title; ?></li>
		<?php foreach($page->childs as $child): ?>
		<li><a href="<?php echo $this->createUrl('/page/show', array('page_id' => $child->page_id, 'page_url' => $child->page_url)); ?>"><?php echo $child->page_title; ?></a></li>
		<?php endforeach; ?>
	</ul>
<?php endforeach; ?>

<?php $this->endClip(); ?>