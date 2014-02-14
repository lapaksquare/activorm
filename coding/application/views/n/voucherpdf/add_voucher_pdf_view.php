<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Voucher Data</h2>
	
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
	action="<?php echo base_url(); ?>admin/voucherpdf/submit_voucherpdf"
	>
	  <div class="form-group">
	    <label for="prize_name_line1" class="col-sm-2 control-label">Prize Name<br /> Line 1</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="prize_name_line1" name="prize_name_line1" 
	      value="<?php echo (!empty($this->voucher_data)) ? $this->voucher_data->voucher_price_line1 : ""; ?>" />
	      <p class="help-block"><b>Ex:</b> Dapatkan</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="prize_name_line2" class="col-sm-2 control-label">Prize Name<br /> Line 2</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="prize_name_line2" name="prize_name_line2" 
	      value="<?php echo (!empty($this->voucher_data)) ? $this->voucher_data->voucher_price_line2 : ""; ?>" />
	      <p class="help-block"><b>Ex:</b> BUY 1 GET 1 FREE</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="valid_until" class="col-sm-2 control-label">Valid Until</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="valid_until" class="valid_until" name="valid_until" 
	      value="<?php echo (!empty($this->voucher_data)) ? $this->voucher_data->valid_until : ""; ?>" />
	    </div>
	  </div>
	  
	  <hr />
	  
	  <div class="form-group">
	    <label for="business_id" class="col-sm-2 control-label">Business Name</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="business_id" id="business_id">
	      	<option value="0">Pilih Business</option>
	      	<?php 
	      	foreach($this->business as $k=>$v){
	      		$class = "";
				if (!empty($this->voucher_data)){
					$class = ($this->voucher_data->business_id == $v->business_id) ? 'selected' : '';
				}
	      	?>
	      	<option value="<?php echo $v->business_id; ?>" <?php echo $class; ?>><?php echo ucwords( $v->business_name ); ?></option>
	      	<?php
	      	}
	      	?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="voucher_email" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="voucher_email" name="voucher_email" 
	      value="<?php echo (!empty($this->merchant_data)) ? $this->merchant_data->voucher_email : ""; ?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="voucher_website" class="col-sm-2 control-label">Website</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="voucher_website" name="voucher_website" 
	      value="<?php echo (!empty($this->merchant_data)) ? $this->merchant_data->voucher_website : ""; ?>" />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="voucher_phone" class="col-sm-2 control-label">Phone</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="voucher_phone" name="voucher_phone" 
	      value="<?php echo (!empty($this->merchant_data)) ? $this->merchant_data->voucher_phone : ""; ?>" />
	    </div>
	  </div>
	  
	  <hr />
	  
	  <div class="form-group">
	    <label for="project_id" class="col-sm-2 control-label">Project Name</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="project_id" id="project_id">
	      	<option value="0">Pilih Project</option>
	      	<?php 
	      	if (!empty($this->projects)){
		      	foreach($this->projects as $k=>$v){ 
		      		$class = "";
					if (!empty($this->projects)){
						$class = ($this->voucher_data->project_id == $v->project_id) ? "selected" : "";
					}
		      		?>
		      	<option value="<?php echo $v->project_id; ?>" <?php echo $class; ?>><?php echo ucwords( $v->project_name ); ?></option>	
		    <?php } 
			}	
		    ?>	
	      </select>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="syarat_ketentuan" class="col-sm-2 control-label">Syarat & Ketentuan</label>
	    <div class="col-sm-10">
	      <textarea class="form-control" name="syarat_ketentuan" id="syarat_ketentuan" style="height:100px;"><?php echo (!empty($this->voucher_data)) ? $this->voucher_data->syarat_dan_ketentuan : ""; ?></textarea>
	      <p class="help-block"><b>Ex:</b> - Ongkos kirim ditanggung pemenang atau konfirmasi terlebih dahulu saat diambil dari kantor Activorm.#BR#- Voucher tidak dapat dipindah-tangankan.#BR#- Voucher hanya berlaku untuk satu kali request.#BR#- Voucher tidak berlaku untuk Reseller atau Dropship.</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="cara_penggunaan" class="col-sm-2 control-label">Cara Penggunaan</label>
	    <div class="col-sm-10">
	      <textarea class="form-control" name="cara_penggunaan" id="cara_penggunaan" style="height:100px;"><?php echo (!empty($this->voucher_data)) ? $this->voucher_data->cara_penggunaan : ""; ?></textarea>
	      <p class="help-block"><b>Ex:</b> - Informasikan pihak Kaos Loe nomor voucher untuk konfirmasi spesifikasi kaos pilihan.#BR#- Pilihan kaos dapat dilihat di album foto #BR#Facebook Fanpage KaosLoe : Ready to Print! KaosLoe</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	    	<input type="hidden" name="action_type" value="<?php echo $action_type; ?>" />
	    	<input type="hidden" name="vid" value="<?php echo (!empty($this->voucher_data)) ? $this->voucher_data->voucher_id : ""; ?>" />
	    	<input type="hidden" name="h" value="<?php echo (!empty($this->hash)) ? $this->hash : ""; ?>" />
	        <input type="submit" class="btn btn-default" name="submit" id="btn_submit" value="Submit" data-target="" />
	        <input type="submit" class="btn btn-default" name="preview" id="btn_preview" value="Preview" data-target="_blank" />
	    </div>
	  </div>
	</form>
	
</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>