<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Business Account - Business - <b>aa</b></h2>	
	
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
	$a_msg_resend_password = $this->session->userdata('a_msg_resend_password');
	if (!empty($a_msg_resend_password)){
		$this->session->unset_userdata('a_msg_resend_password');
		if ($a_msg_resend_password == 1){
	?>
		<div class="bs-callout bs-callout-danger">
	      <p>Something Error. Please try again Resend Password.</p>
	    </div>
	    <?php } ?>
    
	    <?php 
		if ($a_msg_resend_password == 2){
		?>
		<div class="bs-callout bs-callout-info">
	      <p>Resend Password Successfull</p>
	    </div>
    <?php } 
	}
    ?>
	
	<?php /******* END MESSAGE */ ?>
	
	<form class="form-horizontal" role="form" method="post" 
	enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/member/update_business_account"
	>
	  
	  <div class="form-group">
	    <label for="account_name" class="col-sm-2 control-label">Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_name" name="account_name" value="<?php echo $this->member->account_name; ?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="account_email" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_email" name="account_email" value="<?php echo $this->member->account_email; ?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Photo</label>
	    <div class="col-sm-10">
	      <input type="file" name="account_avatar" id="account_avatar" />
	      
	      <br />
	      
	      <?php
	      if (!empty($this->member->account_primary_photo)){
	      	$photo = $this->mediamanager->getPhotoUrl($this->member->account_primary_photo, "300x300");
	      ?>
	      <img src="<?php echo cdn_url() . $photo; ?>" alt="photo" />
	      <?php	
	      }
	      ?>
	      
	    </div>
	  </div> 
	  <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Merchant Logo</label>
	    <div class="col-sm-10">
	      <input type="file" name="merchant_logo" id="merchant_logo" />
	      
	      <br />
	      
	      <?php
	      if (!empty($this->member->merchant_logo)){
	      	$photo = $this->mediamanager->getPhotoUrl($this->member->merchant_logo, "100x100");
	      ?>
	      <img src="<?php echo cdn_url() . $photo; ?>" alt="photo" />
	      <?php	
	      }
	      ?>
	      
	    </div>
	  </div> 
	  <div class="form-group">
	    <label for="account_contact" class="col-sm-2 control-label">Person In Charge</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_contact" name="account_contact" value="<?php echo $this->member->contact_person; ?>" />
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="account_position" class="col-sm-2 control-label">Position in the Company</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_position" name="account_position" value="<?php echo $this->member->position_inthe_company; ?>" />
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="account_number" class="col-sm-2 control-label">Contact Number</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_number" name="account_number" value="<?php echo $this->member->contact_number; ?>" />
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="website" class="col-sm-2 control-label">Website</label>
	    <div class="col-sm-10">
	    	
	    	<?php 
			$website = (!empty($this->member->website)) ? $this->member->website : '';
			?>
	    	
	      <input type="text" class="form-control" id="website" name="website" value="<?php echo (empty($website)) ? "http://" : $website; ?>" />
	      <p class="help-block"><strong>Example:</strong> <i><?php echo base_url(); ?></i></p>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="account_description" class="col-sm-2 control-label">Business Description</label>
	    <div class="col-sm-10">
	    	<textarea class="form-control" name="account_description" id="account_description" rows="3"><?php echo $this->member->business_description; ?></textarea>
	    </div>  
	  </div>
	  
	  <div class="form-group">
	    <label for="account_address" class="col-sm-2 control-label">Business Billing Address</label>
	    <div class="col-sm-10">
	    	<textarea class="form-control" name="account_address" id="account_address" rows="3"><?php echo $this->member->business_billing_address; ?></textarea>
	    </div>  
	  </div>
	  
	  <div class="form-group">
	    <label for="account_need" class="col-sm-2 control-label">Business Needs (Optional)</label>
	    <div class="col-sm-10">
	    	<textarea class="form-control" name="account_need" id="account_need" rows="3"><?php echo $this->member->business_needs; ?></textarea>
	    </div>  
	  </div>
	  
	  <div class="form-group">
	    <label for="province_id" class="col-sm-2 control-label">Province</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="province_id" id="province_id">
	      	<option value="0">Pilih Province</option>
	      	<?php 
	      	foreach($provinces as $k=>$v){
	      		$class = ($this->member->province_id == $v->province_id) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $v->province_id; ?>" <?php echo $class; ?>><?php echo $v->province_name; ?></option>
	      	<?php
	      	}
	      	?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="kabupaten_id" class="col-sm-2 control-label">Kabupaten</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="kabupaten_id" id="kabupaten_id">
	      	<option value="0">Pilih Kabupaten</option>
	      	<?php 
	      	foreach($kabupatens as $k=>$v){
	      		$class = ($this->member->kabupaten_id == $v->city_id) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $v->city_id; ?>" <?php echo $class; ?>><?php echo $v->city_name; ?></option>
	      	<?php	
	      	}
	      	?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="kecamatan_id" class="col-sm-2 control-label">Kecamatan</label>
	    <div class="col-sm-10" >
	      <select class="form-control" name="kecamatan_id" id="kecamatan_id">
	      	<option value="0">Pilih Kecamatan</option>
	      	<?php 
	      	foreach($kecamatans as $k=>$v){
	      		$class = ($this->member->kecamatan_id == $v->kecamatan_id) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $v->kecamatan_id; ?>" <?php echo $class; ?>><?php echo $v->kecamatan_name; ?></option>
	      	<?php	
	      	}
	      	?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="kelurahan_id" class="col-sm-2 control-label">Kelurahan</label>
	    <div class="col-sm-10" >
	      <select class="form-control" name="kelurahan_id" id="kelurahan_id">
	      	<option value="0">Pilih Kelurahan</option>
	      	<?php 
	      	foreach($kelurahans as $k=>$v){
	      		$class = ($this->member->kelurahan_id == $v->kelurahan_id) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $v->kelurahan_id; ?>" <?php echo $class; ?>><?php echo $v->kelurahan_name; ?></option>
	      	<?php	
	      	}
	      	?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="account_live" class="col-sm-2 control-label">Account Live</label>
	    <div class="col-sm-10" >
	    	
	    	<?php 
	    	$account_live = array(
				'Online', 'Offline'
			);
	    	?>
	    	
	      <select class="form-control" name="account_live">
	      	<?php 
	      	foreach($account_live as $k=>$v){
	      		$class = ($this->member->account_live == $v) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $v; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
	      	<?php	
	      	}
	      	?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="account_active" class="col-sm-2 control-label">Account Active</label>
	    <div class="col-sm-10" >
	    	
	    	<?php 
	    	$account_active = array(
				0 => 'Non Active',
				1 => 'Active'
			);
	    	?>
	    	
	      <select class="form-control" name="account_active">
	      	
	      	<?php 
	      	foreach($account_active as $k=>$v){
	      		$class = ($this->member->account_active == $k) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
	      	<?php	
	      	}
	      	?>
	      	
	      </select>
	    </div>
	  </div>
	  
	  <?php 
	  $p1 = $this->member->account_password;
	  $p2 = $this->member->account_temp_password;
	  $p_ori = md5($p2 . SALT);
	  
	  if ($p_ori == $p1){
	  ?>
	  
	  <div class="form-group">
	    <label for="temp_password" class="col-sm-2 control-label">Temporary Password</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="temp_password" name="temp_password" value="<?php echo $this->member->account_temp_password; ?>" />
	      <a href="<?php echo base_url(); ?>admin/member/resend_temp_password?mai=<?php echo $this->member->account_id; ?>&bai=<?php echo $this->member->business_id; ?>&h=<?php echo sha1($this->member->business_id . $this->member->account_id . SALT); ?>" class="btn btn-default">Re-Send Temporary Password</a>
	    </div>
	  </div>
	  
	  <?php } ?>
	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	    	<input type="hidden" name="mai" value="<?php echo $this->member->account_id; ?>" />
	    	<input type="hidden" name="bai" value="<?php echo $this->member->business_id; ?>" />
	    	<input type="hidden" name="h" value="<?php echo sha1($this->member->business_id . $this->member->account_id . SALT); ?>" />
	      <input type="submit" class="btn btn-default" name="update" id="update" value="Update" />
	    </div>
	  </div>
	</form>
	
</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>