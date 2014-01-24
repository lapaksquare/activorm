<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Featured Homepage Logo Merchant</h2>	
	
	<hr />
	
	<?php /******* START MESSAGE */ ?>
	<?php 
	$a_message_success = $this->session->userdata('a_message_success');
	if (!empty($a_message_success)){
		$this->session->unset_userdata('a_message_success');
	?>
		<div class="bs-callout bs-callout-info">
	      <p>Successfull Updated!</p>
	    </div>
    <?php
	}
	$a_message_error = $this->session->userdata('a_message_error');
	if (!empty($a_message_error)){
		$this->session->unset_userdata('a_message_error');
    ?>
    	<div class="bs-callout bs-callout-danger">
	      <p>Failded Updated!</p>
	    </div>
	<?php 
	}
	?>
	<?php /******* END MESSAGE */ ?>
	
	<form class="form-horizontal" role="form" method="post" 
	id="featured_prize"
	enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/featured/submit_logo_homepage"
	>
	  <div class="form-group">
	    <label for="account_name" class="col-sm-2 control-label">Type</label>
	    <div class="col-sm-10">
	    	<?php 
	    	$radios = array(
				'manual' => 'Manual',
				'random' => 'Random'
			);
			foreach($radios as $k=>$v){
				$class = (!empty($data_featured) && property_exists($data_featured, "type") && $data_featured->type == $k) ? 'checked="checked"' : '';
				//$class = '';
	    	?>
	        <label class="radio-inline">
			  <input type="radio" id="type" name="type" value="<?php echo $k; ?>" <?php echo $class; ?>> <?php echo $v; ?>
			</label>
			<?php } ?>
	    </div>
	  </div>
	  
	  <div class="form-group model-group" id="selected_logo"
	  >
	    <label for="account_name" class="col-sm-2 control-label">Priority (Logo Business)</label>
	    <div class="col-sm-10">
	    	<table class="table table-striped" id="logo_container">
				<thead>
		          <tr>
		            <th>#</th>
		            <th>Business Name</th>
		            <th>Logo</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php 
		        	for($i=0; $i<8; $i++){
		        	?>
		        	<tr>
		        		<td><?php echo ($i+1); ?></td>
		        		<td>
		        			<?php if (!empty($data_isi[$i]) && property_exists($data_isi[$i], "business_name")){ ?>
		        			<b><?php echo ucwords($data_isi[$i]->business_name); ?></b><br />
		        			<?php } ?>
		        			<select name="bn[<?php echo $i; ?>]" id="business_select" data-business_id="<?php echo $data_isi[$i]->business_id; ?>">
		        				<option value="0">Pilih Business</option>
			        			<?php 
			        			foreach($business as $k=>$v){
			        				$class = (!empty($data_isi[$i]) && property_exists($data_isi[$i], "business_name") && $data_isi[$i]->business_id == $v->business_id) ? "selected" : "";
			        			?>
			        			<option value="<?php echo $v->business_id ?>" <?php echo $class; ?>><?php echo ucwords($v->business_name); ?></option>
		        				<?php	
		        				}
		        				?>
		        			</select>
		        		</td>
		        		<td id="images_container">
		        			  <?php
						      if (!empty($data_isi[$i]->merchant_logo)){
						      	$photo = $this->mediamanager->getPhotoUrl($data_isi[$i]->merchant_logo, "100x100");
						      ?>
						      <img src="<?php echo cdn_url() . $photo; ?>" alt="photo" />
						      <?php	
						      }else if (!empty($data_isi[$i])){
						      ?>
						      <a href="<?php echo base_url(); ?>admin/member/business_account_details?bai=<?php echo $data_isi[$i]->business_id; ?>&mai=<?php echo $data_isi[$i]->account_id; ?>&h=<?php echo sha1($data_isi[$i]->business_id.$data_isi[$i]->account_id.SALT); ?>" target="_blank">Upload your logo</a>
						      <?php } ?>
		        		</td>
		        	</tr>
		        	<?php } ?>
		        </tbody>
		    </table>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <input type="submit" class="btn btn-default" name="update" id="update" value="Submit" />
	    </div>
	  </div>
	</form>
	
</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>