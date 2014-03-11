<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Project Details - <?php echo ucwords($this->project->project_name); ?></h2>	
	
	<hr />
	
	<?php /******* START MESSAGE */ ?>
	
	<?php 
	$a_message_error = $this->session->userdata('a_message_error');
	if (!empty($a_message_error)){
		$this->session->unset_userdata('a_message_error');
		$m = '<li>'.implode('</li><li>', $a_message_error) . '</li>';
	?>
	<div class="bs-callout bs-callout-danger">
      <p>
      	<ul>
      		<?php echo $m; ?>
      	</ul>
      </p>
    </div>
    <?php } ?>
    
    <?php 
	$a_message_success = $this->session->userdata('a_message_success');
	if (!empty($a_message_success)){
		$this->session->unset_userdata('a_message_success');
	?>
	<div class="bs-callout bs-callout-info">
      <p>Save Successfull</p>
    </div>
    <?php } ?>
    
    <form class="form-horizontal" role="form" method="post" 
	enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/project/submit_project"
	>
	
	  <div class="form-group">
	    <label for="account_name" class="col-sm-2 control-label">Business Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="business_name" name="business_name" disabled value="<?php echo $this->project->business_name; ?>" />
	    	
	    	<div class="panel panel-default">
			  <div class="panel-body">
			    <ul style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;">
			    	
			    	<?php 
			    	if ($this->project->cek_free_plan == 0){
						$jml_free_plan = 3;
					}else{
						$jml_free_plan = ($this->project->jml_free_plan <= 0) ? 0 : $this->project->jml_free_plan;
					}
			    	?>
			    	
			    	<li><?php echo $jml_free_plan; ?> Project free left</li>
			    	<li>Jumlah Point : <?php echo $this->project->jml_point; ?> Point</li>
			    </ul>
			  </div>
			</div>
	    	
	    </div>
	  </div>	
	
	  <div class="form-group">
	    <label for="account_name" class="col-sm-2 control-label">Project Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $this->project->project_name; ?>" />
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Photo</label>
	    <div class="col-sm-10" id="photo_container">
	      <input type="file" name="project_photo[]" id="project_photo" multiple="true" />
	      
	      <br />
	      
	      <?php 
	      /*
	      if (!empty($this->project->project_primary_photo)){
	      	$photo = $this->mediamanager->getPhotoUrl($this->project->project_primary_photo, "300x300");
	      ?>
	      <img src="<?php echo cdn_url() . $photo; ?>" alt="photo" />
	      <?php	
	      }*/
	      ?>
	      
	      	<?php 
			if (empty($this->project_photos)){ 
				$photo = $this->project->project_primary_photo;
				$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
			?>
			<div class="project-thumbnail">
				<img src="<?php echo cdn_url() . $photo; ?>" alt="photo" width="260" class="img-thumbnail" />
				
			</div>
			<?php 
			}else{
				
				foreach($this->project_photos as $k=>$v){
					$photo = $v->photo_file;
					$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
			?>
			
			<div class="project-thumbnail">
				<img src="<?php echo cdn_url() . $photo; ?>" alt="photo" width="260" class="img-thumbnail"  />
				<a href="#" id="delete_photo" data-pid="<?php echo $v->photo_id; ?>" data-h="<?php echo sha1($v->photo_id . SALT); ?>"><span class="glyphicon glyphicon-remove"></span></a>
			</div>
			
			<?php	
				
				}
			
			}
			?>
	      
	    </div>
	  </div>  
	  
	  <div class="form-group">
	    <label for="period" class="col-sm-2 control-label">Period</label>
	    <div class="col-sm-10">
	    	
	    	<div class="row">
			  <div class="col-xs-3">
			    <input type="text" disabled name="period_hidden" id="period_hidden" class="form-control" value="<?php echo $this->project->project_period_int; ?>" />
	    		<input type="hidden" name="period" id="period" value="<?php echo $this->project->project_period_int; ?>" />
			  </div>
			  <div class="col-xs-7" style="padding-top:12px;">
			    <div id="period_slider"></div>
			  </div>
	    	</div>
	    	
	    	<p class="help-block">Start: <?php echo date("d M Y, H:i", strtotime($this->project->project_period . "-" . $this->project->project_period_int.'days')); ?>. <br />End: <?php echo date("d M Y, H:i", strtotime($this->project->project_period)); ?></p>
	    
	    </div>
	    
	  </div>  
	  
	  <div class="form-group">
	    <label for="describe_prize" class="col-sm-2 control-label">Describe Prize</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="describe_prize" name="describe_prize" value="<?php echo $this->project->project_prize_detail; ?>" />
	    </div>
	  </div>  
	  
	  <div class="form-group">
	    <label for="prize_category" class="col-sm-2 control-label">Select Prize Category</label>
	    <div class="col-sm-10">
	     	<?php 
			$prize_category_cols = array(
				'gadget' => 'Gadget',
				'voucher-discounts' => 'Voucher & Discounts',
				'event_tickets' => 'Event Tickets',
				'promotional_items' => 'Promotional Items',
				'cash' => 'Cash',
				'other' => 'Other'
			);
			
			?>
			
			<select name="prize_category" class="form-control">
				<?php 
				foreach($prize_category_cols as $k=>$v){
					$class = ($k == $this->project->project_prize_category) ? 'selected' : '';
				?>
				<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo ucwords($v); ?></option>
				<?php
				}
				?>
			</select>
	    </div>
	  </div>  
	  
	  <div class="form-group">
	    <label for="prize_category" class="col-sm-2 control-label">Actions</label>
	    <div class="col-sm-10" id="actions_container">
	     	<p>
	     		
	     		<?php 
	     		$actions = $this->project->project_actions_data;
				if (!empty($actions)){
					$actions = json_decode($actions);
					
					/*
					echo '<pre>';
					print_r($actions);
					echo '</pre>';*/
	     		?>
	     		
	     		<ol>
	     			<?php foreach($actions as $k=>$v){ ?>
	     			<li><?php echo ucwords($v->type_name); ?>
	     				
	     				<?php 
	     				if ($v->type_step == "twitter-tweet" || $v->type_step == "twitter-hashtag"){
	     				?>
	     					<br />
	     					<div>
	     					<input type="hidden" name="project_id" id="project_id" value="<?php echo $this->project->project_id; ?>" />
	     					<input type="hidden" name="type" id="type" value="<?php echo $v->type_step; ?>" />
	     					<textarea class="form-control" name="tw-tweet" id="tw-tweet" style="height:80px;margin-bottom:8px;"><?php echo $v->status; ?></textarea>
	     					<input type="button" name="btn-action-edit" class="btn btn-default" id="btn-action-edit-tw" value="save" />
	     					</div>
	     					<br /><br />
	     				<?php	
	     				}else if ($v->type_step == "facebook-send"){
	     				?>
	     					<br />
	     					<div>
	     					
	     					<input type="hidden" name="project_id" id="project_id" value="<?php echo $this->project->project_id; ?>" />
	     					
	     					<input type="hidden" name="type" id="type" value="<?php echo $v->type_step; ?>" />
	     					<label>Name:</label>
	     					<input type="text" class="form-control" name="fb-link-name" id="fb-link-name" value="<?php echo $v->name; ?>" />
	     					
	     					<label>Link:</label>
	     					<input type="text" class="form-control" name="fb-link-linka" id="fb-link-linka" value="<?php echo $v->link; ?>" />
	     					
	     					<label>Description:</label>
	     					<textarea class="form-control" name="fb-link-description" id="fb-link-description" style="height:80px;margin-bottom:8px;"><?php echo $v->description; ?></textarea>
	     					
	     					<input type="button" name="btn-action-edit" class="btn btn-default" id="btn-action-edit-fb" value="save" />
	     					</div>
	     					<br /><br />
	     				<?php
	     				}else if ($v->type_step == "instagram-like"){
	     				?>
	     					<br />
	     					<div>
	     					<input type="hidden" name="project_id" id="project_id" value="<?php echo $this->project->project_id; ?>" />
	     					<input type="hidden" name="type" id="type" value="<?php echo $v->type_step; ?>" />
	     					<input class="form-control" name="ig_url_photo" id="ig_url_photo" type="text" style="margin-bottom:8px;" value="<?php echo $v->photo_url; ?>" />
	     					</div>
	     					<br /><br />
	     				<?php
	     				}
	     				?>
	     				
	     			</li>
	     			<?php } ?>
	     		</ol>
	     		
	     		<?php } ?>
	     	</p>
	    </div>
	  </div>  
	  
	  <div class="form-group">
	    <label for="describe_project" class="col-sm-2 control-label">Terms & Condition</label>
	    <div class="col-sm-10">
	     	<textarea name="describe_project" id="describe_project" rows="5" class="form-control"><?php echo $this->project->project_description; ?></textarea>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="project_tags" class="col-sm-2 control-label">Tags <small>Use comma to separate tags</small></label>
	    <div class="col-sm-10">
	     	<input type="text" class="form-control" id="project_tags" name="project_tags" value="<?php echo $this->project->project_tags; ?>" />
	    </div>
	  </div>    
	  
	  <div class="form-group">
	    <label for="project_live" class="col-sm-2 control-label">Project Live</label>
	    <div class="col-sm-10" >
	    	
	    	<?php 
	    	$project_live = array(
				'Online' => 'Online/On-Going',
				'Offline' => 'Offline/Pending',
				'Draft' => 'Draft',
				'Closed' => 'Closed'
			);
	    	?>
	    	
	      <select class="form-control" name="project_live">
	      	
	      	<?php 
	      	foreach($project_live as $k=>$v){
	      		$class = ($k == $this->project->project_live) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
	      	<?php	
	      	}
	      	?>
	      	
	      </select>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="project_active" class="col-sm-2 control-label">Project Active</label>
	    <div class="col-sm-10" >
	    	
	    	<?php 
	    	$project_active = array(
				0 => 'Non Active',
				1 => 'Active'
			);
	    	?>
	    	
	      <select class="form-control" name="project_active">
	      	
	      	<?php 
	      	foreach($project_active as $k=>$v){
	      		$class = ($this->project->project_active == $k) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
	      	<?php	
	      	}
	      	?>
	      	
	      </select>
	    </div>
	  </div>
	
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <input type="hidden" name="pid" value="<?php echo $this->project->project_id; ?>" />	
	      <input type="hidden" name="aid" value="<?php echo $this->project->account_id; ?>" />	
	      <input type="hidden" name="h" value="<?php echo sha1($this->project->project_id . SALT); ?>" />	
	      <input type="submit" class="btn btn-default" name="update" id="update" value="Update" />
	    </div>
	  </div>	
	
	</form>	  

</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>