<?php 
	$this->pageTitle = $page->page_title; 
?>
<div class="page-content-title <?php echo $this->section; ?>"><span></span><?php echo $page->page_title; ?></div>
<h2><?php echo $page->page_title; ?></h2>
<?php //echo $page->page_body; ?>
<br/>
<?php echo strtr($page->page_body, array(
	'{types}' => $this->renderPartial('accountTypes', array(), true)
)); ?>


<?php if($page->page_id == 23): ?>
	<?php $this->widget('ExpiryRateWidget'); ?>
<?php endif; ?> 