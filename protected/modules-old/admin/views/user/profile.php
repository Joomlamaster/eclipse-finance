<?php $this->beginContent('container'); ?>
	<dl class="dl-horizontal">
		<dt>User ID</dt>
		<dd><?php echo $user->user_id; ?></dd>
	  
		<dt>First Name</dt>
		<dd><?php echo $user->first_name; ?></dd> 
		
		<dt>Last Name</dt>
		<dd><?php echo $user->last_name; ?></dd> 	
		
		<dt>Address</dt>
		<dd><?php echo $user->user_address; ?></dd> 
		
		
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