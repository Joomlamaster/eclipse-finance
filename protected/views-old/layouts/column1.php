<?php
$this->beginContent('//layouts/main'); ?>
<?php
if ($this->module->id !== 'profile' && $this->id != 'user'): ?>
<div class="htt-header 
<?php
    echo $this->section; ?>
">
  
  <div class="htt-header-inner">
    
    <!--  		
<a class="btn btn-large btn-brown" href="
<?php
    echo $this->createUrl('profile/index') ?>
">
Open Account
</a>
-->
  
  <a class="" href="
<?php
    echo $this->createUrl('/profile') ?>
">
  </a>
  
  </div>
</div>
<?php
endif; ?>
<div class="content">
  <div class="container-fluid">
    
    <div class="row-fluid">
      
      <div class="span3" id="page-column">
        
        <a class="sb-link-img" href="http://eclipse-finance.com/profile">
          <img src="http://eclipse-finance.com/images/banner-sb.png" />
        </a>
        
        <div class="well sidebar-nav">
          
          <div class="accordion" id="accordion2">
			
  <?php
foreach ($this->pages as $key => $page): ?>
  
  <div class="accordion-group">
    
    <div class="accordion-heading">
      
      <a class="accordion-toggle nav-header" data-toggle="collapse" data-parent="#accordion2" href="#collapse
<?php
    echo $key; ?>
">
  
  <?php
    echo $page->page_name; ?>
  
  </a>
  
  </div>
  
  <div id="collapse
<?php
    echo $key; ?>
" class="accordion-body collapse 
<?php
    if ((Pages::model()->isChild(($page_id = Yii::app()->request->getQuery('page_id', null)), $page) || (!$key && !$page_id)) && !$this->module->id): ?>
in
<?php
    endif; ?>
">
  
  <div class="accordion-inner">
    
    <ul class="nav nav-list">
      
      <?php
    foreach ($page->childs as $child): ?>
  
  <li 
  <?php
        if (Yii::app()->request->getQuery('page_id', null) == $child->page_id): ?>
    class="active"
    <?php
        endif; ?>
    >
    <a href="
<?php
        echo $this->createUrl('page/show', array('page_id' => $child->page_id, 'page_url' => $child->page_url)); ?>
">
  <?php
        echo $child->page_name; ?>
          </a>
  </li>
  
  <?php
    endforeach; ?>
  
  </ul>
  
  </div>
  
  </div>
  
  </div>
  
  <?php
endforeach; ?>
  
  <?php
if (!Yii::app()->user->isGuest): ?>
  
  <div class="accordion-group">
    
    <div class="accordion-heading">
      
      <a class="accordion-toggle nav-header" data-toggle="collapse" data-parent="#accordion2" href="#collapseProfile">
        My account			      						
      </a>
      
    </div>
    
    <div id="collapseProfile" class="accordion-body 
<?php
    if ($this->module->id): ?>
in
<?php
    endif; ?>
collapse">
  
  <div class="accordion-inner">
    
    <ul class="nav nav-list">
      
      <li 
      <?php
    if ($this->id == 'default' && $this->action->id == 'index'): ?>
        class="active";
        <?php
    endif; ?>
        >
        <a href="
<?php
    echo $this->createUrl('/profile/default/index'); ?>
">
  Personal Information
      </a>
  </li>
  
  <li 
  <?php
    if ($this->id == 'default' && $this->action->id == 'login'): ?>
    class="active";
    <?php
    endif; ?>
    >
    <a href="
<?php
    echo $this->createUrl('/profile/default/login'); ?>
">
  Change Password
      </a>
  </li>
  
  <li 
  <?php
    if ($this->id == 'default' && $this->action->id == 'rates'): ?>
    class="active";
    <?php
    endif; ?>
    >
    <a href="
<?php
    echo $this->createUrl('/profile/default/rates'); ?>
">
  Investment History
      </a>
  </li>
  
  <li 
  <?php
    if ($this->id == 'cashier'): ?>
    class="active";
    <?php
    endif; ?>
    >
    <a href="
<?php
    echo $this->createUrl('/profile/cashier/deposit'); ?>
">
  Cashier
      </a>
  </li>
  
  </ul>
  
   </div>
   
  </div>
  
  </div>
  
  <?php
endif; ?>
  
  </div>
  
  </div>
  <!--/.well -->
  
  </div>
  <!--/span-->
  
  <div class="span9" id="page-content">
    
    <?php
echo $content; ?>
  
  </div>
  <!--/span-->
  
  </div>
  <!--/row-->
  
  <footer>
    
  </footer>
  
  </div>
</div>
<?php
$this->endContent(); ?>