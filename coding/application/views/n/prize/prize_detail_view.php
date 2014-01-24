<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Prize Profile</h2>	
	
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
    
     <?php 
	$msg_delete_prize = $this->session->userdata('msg_delete_prize');
	if (!empty($msg_delete_prize)){
		$this->session->unset_userdata('msg_delete_prize');
	?>
	<div class="bs-callout bs-callout-info">
      <p>Prize Successful Deleted.</p>
    </div>
    <?php } ?>
    
    <form class="form-horizontal" role="form" method="post" 
	enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/prize/submit_prize"
	>
	  <div class="form-group">
	    <label for="prize_name" class="col-sm-2 control-label">Prize Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="prize_name" name="prize_name" 
	      value="<?php echo (!empty($this->prize)) ? $this->prize->prize_name : ""; ?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Photo</label>
	    <div class="col-sm-10">
	      <input type="file" name="prize_photo" id="prize_photo" />
	      
	      <br />

		  <?php
	      if (!empty($this->prize) && !empty($this->prize->prize_primary_photo)){
	      	$photo = $this->mediamanager->getPhotoUrl($this->prize->prize_primary_photo, "300x300");
	      ?>
	      <img src="<?php echo cdn_url() . $photo; ?>" alt="photo" />
	      <?php	
	      }
	      ?>
			
	    </div>
	  </div>
	  <div class="form-group" id="featured_prize">
	    <label for="business_id" class="col-sm-2 control-label">Business</label>
	    <div class="col-sm-10">
	      <select name="business_id" class="form-control" id="business_id" 
	      data-bid="<?php echo (!empty($this->prize)) ? $this->prize->business_id : "" ?>"
	      data-pid="<?php echo (!empty($this->prize)) ? $this->prize->project_id : "" ?>"
			>
			<option value="0">Pilih Business</option>
			<?php 
			foreach($business as $k=>$v){
				$class = (!empty($this->prize) && $this->prize->business_id == $v->business_id) ? "selected" : ""; 
			?>
			<option value="<?php echo $v->business_id ?>" <?php echo $class; ?>><?php echo ucwords($v->business_name); ?></option>
			<?php	
			}
			?>
		  </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="project_id" class="col-sm-2 control-label">Project</label>
	    <div class="col-sm-10">
	      <select name="project_id" class="form-control" id="project_id" 
			>
			<option value="0">Pilih Project</option>
		  </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="prize_active" class="col-sm-2 control-label">Prize Active</label>
	    <div class="col-sm-10" >
	    	
	    	<?php 
	    	$prize_active = array(
				1 => 'Active',
				0 => 'Non Active',
			);
	    	?>
	    	
	      <select class="form-control" name="prize_active">
	      	
	      	<?php 
	      	foreach($prize_active as $k=>$v){
	      		$class = (!empty($this->prize) && $this->prize->isactive == $k) ? "selected" : ""; 
	      	?>
	      	<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
	      	<?php	
	      	}
	      	?>
	      	
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="prize_status" class="col-sm-2 control-label">Prize Show</label>
	    <div class="col-sm-10" >
	    	
	    	<?php 
	    	$prize_active = array(
				'active' => 'Active',
				'deleted' => 'Deleted',
			);
	    	?>
	    	
	      <select class="form-control" name="prize_status">
	      	
	      	<?php 
	      	foreach($prize_active as $k=>$v){
	      		$class = (!empty($this->prize) && $this->prize->status == $k) ? "selected" : ""; 
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
	    	<input type="hidden" name="action_type" value="<?php echo $action_type; ?>" />
	    	<input type="hidden" name="prid" value="<?php echo (!empty($this->prize)) ? $this->prize->prize_id : ""; ?>" />
	    	<input type="hidden" name="ppid" value="<?php echo (!empty($this->prize)) ? $this->prize->project_id : ""; ?>" />
	    	<input type="hidden" name="h" value="<?php echo (!empty($this->prize)) ? sha1($this->prize->prize_id . $this->prize->project_id . SALT) : ""; ?>" />
	        <input type="submit" class="btn btn-default" name="submit" id="submit" value="Submit" />
	        <a class="btn" id="delete_prize" href="<?php echo base_url(); ?>admin/prize/deleteprize?p=<?php echo $this->prize->prize_id; ?>&pid=<?php echo $this->prize->project_id; ?>&h=<?php echo sha1($this->prize->prize_id.$this->prize->project_id.SALT); ?>">Delete Prize</a>
	    </div>
	  </div>
	</form>
	
</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>