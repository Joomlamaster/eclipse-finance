<ul class="nav nav-list">
	<?php foreach($pages as $page):?>
	<li>
		<a href="<?php echo $this->createUrl('pages/edit', array('page_id' => $page->page_id)); ?>"><?php echo $page->page_name ? $page->page_name : 'No name'?></a>
		<?php if($page->childs) $this->renderPartial('PagesTree', array('pages' => $page->childs)); ?>	
	</li>
	<?php endforeach;?>
</ul>