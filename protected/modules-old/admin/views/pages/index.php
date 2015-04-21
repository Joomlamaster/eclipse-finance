<?php
/* @var $this PagesController */

$this->breadcrumbs=array(
	'Pages',
);
?>
<h2>Tree of pages</h2>
<?php 
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'×', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
	    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
    )
));
?>
<a style="display:block; width:170px; padding:8px 11px; margin-bottom:20px;" class="btn btn-large btn-primary" href="<?php echo $this->createUrl('pages/add');?>">Add new page</a>
<?php //echo $pagesTree; ?>

<?php 
	$this->renderPartial('PagesTree', array('pages' => $pages));
/*
$this->widget(
    'bootstrap.widgets.TbMenu',
    array(
        'type' => 'list',
        'items' => array(
            array(
                'label' => 'List header',
                'itemOptions' => array('class' => 'nav-header'),
            	'items' => array()
            ),
            array(
                'label' => 'Home',
                'url' => '#',
                'itemOptions' => array('class' => 'active')
            ),
            array('label' => 'Library', 'url' => '#'),
            array('label' => 'Applications', 'url' => '#'),
            array(
                'label' => 'Another list header',
                'itemOptions' => array('class' => 'nav-header')
            ),
            array('label' => 'Profile', 'url' => '#'),
            array('label' => 'Settings', 'url' => '#'),
            '',
            array('label' => 'Help', 'url' => '#'),
        )
    )
);
*/
?>