<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Featured Homepage Prize</h2>	
	
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
	action="<?php echo base_url(); ?>admin/featured/submit_prize_homepage"
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
	  
	  <div class="form-group" id="model_group">
	    <label for="account_name" class="col-sm-2 control-label">Model</label>
	    <div class="col-sm-10">
	    	<?php 
	    	$radios = array(
				'project' => 'Project',
				'prize' => 'Prize'
			);
			foreach($radios as $k=>$v){
				$class = (!empty($data_featured) && property_exists($data_featured, "model") && $data_featured->model == $k) ? 'checked="checked"' : '';
				//$class = '';
	    	?>
	        <label class="radio-inline">
			  <input type="radio" id="model" name="model" value="<?php echo $k; ?>" <?php echo $class; ?>> <?php echo $v; ?>
			</label>
			<?php } ?>
	    </div>
	  </div>	
	  
	  <div class="form-group model-group" id="selected_prize" 
	  <?php if (!empty($data_featured) && property_exists($data_featured, "model") && $data_featured->model == "prize"){ ?>
	  style="display:block;"
	  <?php }else{ ?>
	  style="display:none;"	
	  <?php } ?>
	  >
	    <label for="account_name" class="col-sm-2 control-label">Priority (Prize)</label>
	    <div class="col-sm-10">
	        
	        <table class="table table-striped" id="featured_prize">
				<thead>
		          <tr>
		            <th>#</th>
		            <th>Prize Name</th>
		          </tr>
		        </thead>
		        <tbody>
		        	
		        	<?php 
		        	for($i=0; $i<16; $i++){
		        	?>
		        	
		        	<tr>
		        		<td><?php echo ($i+1); ?></td>
		        		<td>
		        			<?php if (!empty($data_isi[$i]) && property_exists($data_isi[$i], "prize_name")){ ?>
		        			<b><?php echo ucwords($data_isi[$i]->prize_name); ?></b><br />
		        			<?php } ?>
		        			<select name="pn[<?php echo $i; ?>]" id="business_select">
		        				<option value="0">Pilih Prize</option>
		        				<?php 
		        				foreach($prizes as $k=>$v){
		        					$class = (!empty($data_isi[$i]) && property_exists($data_isi[$i], "prize_name") && $data_isi[$i]->prize_id == $v->prize_id) ? "selected" : "";
		        				?>
		        				<option value="<?php echo $v->prize_id ?>" <?php echo $class; ?>><?php echo ucwords($v->prize_name); ?></option>
		        				<?php	
		        				}
		        				?>
		        			</select>
		        		</td>
		        	</tr>
		        	
		        	<?php	
		        	}
		        	?>
		        	
		        </tbody>
			</table>
	        
	    </div>
	  </div>
	  
	  <div class="form-group model-group" id="selected_project"
	  <?php if (!empty($data_featured) && property_exists($data_featured, "model") && $data_featured->model == "project"){ ?>
	  style="display:block;"
	  <?php }else{ ?>
	  style="display:none;"	
	  <?php } ?>
	  >
	    <label for="account_name" class="col-sm-2 control-label">Priority (Project)</label>
	    <div class="col-sm-10">
	        
	        <table class="table table-striped">
				<thead>
		          <tr>
		            <th>#</th>
		            <th>Business Name</th>
		            <th>Project Title</th>
		          </tr>
		        </thead>
		        <tbody>
		        	
		        	<?php 
		        	for($i=0; $i<16; $i++){
		        	?>
		        	
		        	<tr>
		        		<td><?php echo ($i+1); ?></td>
		        		<td>
		        			<?php if (!empty($data_isi[$i]) && property_exists($data_isi[$i], "business_name")){ ?>
		        			<b><?php echo ucwords($data_isi[$i]->business_name); ?></b><br />
		        			<?php } ?>
		        			<select name="bn[<?php echo $i; ?>]" class="business_select" id="business_select" 
		        				data-bid="<?php echo (!empty($data_isi[$i]) && property_exists($data_isi[$i], "business_name")) ? $data_isi[$i]->business_id : 0; ?>"
		        				data-pid="<?php echo (!empty($data_isi[$i]) && property_exists($data_isi[$i], "project_name")) ? $data_isi[$i]->project_id : 0; ?>"
		        				>
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
		        		<td>
		        			<?php if (!empty($data_isi[$i]) && property_exists($data_isi[$i], "project_name")){ ?>
		        			<b><?php echo ucwords($data_isi[$i]->project_name); ?></b><br />
		        			<?php } ?>
		        			<select name="pt[<?php echo $i; ?>]">
		        				<option value="0">Pilih Project</option>
		        			</select>
		        		</td>
		        	</tr>
		        	
		        	<?php	
		        	}
		        	?>
		        	
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