<?php $this->beginContent('application.modules.admin.views.user.show_container'); ?>
	<dl class="dl-horizontal">
		<dt>User ID</dt>
		<dd><?php echo $user->user_id; ?></dd>
	  	
		<dt>First Name</dt>
		<dd><?php echo $user->first_name; ?> &nbsp; </dd> 
		
		<dt>Last Name</dt>
		<dd><?php echo $user->last_name; ?> &nbsp; </dd> 	
		
		<dt>Country</dt>
		<dd><?php echo $user->country->name; ?> &nbsp; </dd> 

		<dt>E-mail</dt>
		<dd><?php echo $user->user_email; ?> &nbsp; </dd> 
		
		<dt>Phone</dt>
		<dd><strong><?php echo $user->user_phone_code; ?></strong> <?php echo $user->user_phone; ?>&nbsp; </dd>
		
		<dt>Balance</dt> 
		<dd> <?php echo $user->balance; ?> &nbsp; </dd>
		
		<dt></dt>
		<dd><a href="<?php echo $this->createUrl('/admin/user/action/edit', array('user_id' => $user->user_id)); ?>">Edit</a></dd>
		
		
		<?php if($user->scan): ?>
		<dt>Scan of document</dt>
		<dd>
			<div class="row-fluid">
				<ul class="thumbnails">
					<li class="span3">
						<a href="#" class="thumbnail">
							<img src="/uploads/scans/<?php echo $user->scan; ?>" alt=""/>
						</a>
					</li>
				</ul>
			</div>	
		</dd> 
		<?php endif; ?>	
	</dl>
<?php $this->endContent(); ?>