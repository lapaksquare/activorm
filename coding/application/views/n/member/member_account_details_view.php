<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Member Account - User - <b><?php echo ucwords($this->member->account_name); ?></b></h2>	
	
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
	$a_msg_resend_activationcode = $this->session->userdata('a_msg_resend_activationcode');
	if (!empty($a_msg_resend_activationcode)){
		$this->session->unset_userdata('a_msg_resend_activationcode');
		if ($a_msg_resend_activationcode == 1){
	?>
		<div class="bs-callout bs-callout-danger">
	      <p>Something Error. Please try again Resend Activationcode.</p>
	    </div>
	    <?php } ?>
    
	    <?php 
		if ($a_msg_resend_activationcode == 2){
		?>
		<div class="bs-callout bs-callout-info">
	      <p>Resend Activationcode Successfull</p>
	    </div>
    <?php } 
	}
    ?>
	
	<?php /******* END MESSAGE */ ?>
	
	<form class="form-horizontal" role="form" method="post" 
	enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/member/update_member_account"
	>
	  <div class="form-group">
	    <label for="account_name" class="col-sm-2 control-label">Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Name" value="<?php echo $this->member->account_name; ?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="account_email" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_email" name="account_email" placeholder="Email" value="<?php echo $this->member->account_email; ?>" />
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
	    <label for="gender" class="col-sm-2 control-label">Gender</label>
	    <div class="col-sm-10">
	    	
	    	<?php 
	    	$genders = array(
				'male' => 'Male',
				'female' => 'Female'
			);
	    	?>
	    	
	      <select class="form-control" name="gender">
	      	<?php 
	      	foreach($genders as $k=>$v){
	      		$class = ($k == $this->member->gender) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
	      	<?php	
	      	}
	      	?>	      	
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="" class="col-sm-2 control-label">Birthday</label>
	    <div class="col-sm-10">
	    	<div class="picker" id="picker1" data-date="<?php echo $this->member->birthday; ?>"></div>
	    </div>  
	  </div>
	  <div class="form-group">
	    <label for="phone_number" class="col-sm-2 control-label">Phone Number</label>
	    <div class="col-sm-10">
	    	<input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="<?php echo $this->member->phone_number; ?>" />
	    </div>  
	  </div>
	  <div class="form-group">
	    <label for="card_number" class="col-sm-2 control-label">Card Number</label>
	    <div class="col-sm-10">
	    	<input type="text" class="form-control" id="card_number" name="card_number" placeholder="Card Number" value="<?php echo $this->member->card_number; ?>" />
	    </div>  
	  </div>
	  <div class="form-group">
	    <label for="address" class="col-sm-2 control-label">Address</label>
	    <div class="col-sm-10">
	    	<textarea class="form-control" name="address" id="address" rows="3"><?php echo $this->member->address; ?></textarea>
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
	  
	  <div class="form-group">
	    <label for="account_active" class="col-sm-2 control-label">Social Media yang terhubung</label>
	    <div class="col-sm-10" >
	    	<?php 
	    	
	    	$facebook_url = "";
	    	if (!empty($this->socialmedia['facebook'])){
	    		$data = json_decode($this->socialmedia['facebook']->social_data);
				$facebook_url = (!empty($data)) ? 'FACEBOOK LINK : <a href="http://facebook.com/'.$data->id.'" target="_blank">LINK</a>' : "";	
	    	}
			$twitter_url = $twitter_followers_count = "";
			if (!empty($this->socialmedia['twitter'])){
				$data = json_decode($this->socialmedia['twitter']->social_data);
				$twitter_url = (!empty($data)) ? 'TWITTER LINK : <a href="http://twitter.com/'.$data->screen_name.'" target="_blank">LINK</a>' : "";
				$twitter_followers_count = (!empty($data)) ? '<br />TWITTER Followers Count : '.$data->followers_count : 0;
			}
			
			echo $facebook_url . " <br /> " . $twitter_url;
	    	
	    	?>
	    </div>
	  </div>  	
	  
	  <?php if ($this->member->register_step == 2){ ?>
	  <div class="form-group">
	    <label for="verification_code" class="col-sm-2 control-label">Verification Code</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="verification_code" name="verification_code" placeholder="Verification Code" value="<?php echo $this->member->verification_code; ?>" />
	    	<a href="<?php echo base_url(); ?>admin/member/resend_activationcode?mai=<?php echo $this->member->account_id; ?>&maih=<?php echo sha1($this->member->account_id . SALT); ?>" class="btn btn-default">Re-Send Verification Code</a>
	    </div>
	  </div>
	  <?php } ?>
	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	    	<input type="hidden" name="mai" value="<?php echo $this->member->account_id; ?>" />
	    	<input type="hidden" name="maih" value="<?php echo sha1($this->member->account_id . SALT); ?>" />
	      <input type="submit" class="btn btn-default" name="update" id="update" value="Update" />
	    </div>
	  </div>
	</form>
	
</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>