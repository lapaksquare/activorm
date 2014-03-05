<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-12 lp-header" role="main">
	
	<h2>List Members - <?php echo ucwords($this->project->project_name); ?></h2>	
	
	<hr />
	
	
	<!-- TABBED START -->
	<ul class="nav nav-tabs project_tab" id="project_tab">
	  <li class="active"><a href="#tikets" data-rel="tikets">Tikets</a></li>
	  <li><a href="#scantikets" data-rel="scantikets">Scan Tikets</a></li>
	</ul>
	
	
	<div id="myTabContent" class="tab-content">
		
		<div class="tab-pane fade active in project-tab-section" id="tikets">
		
	<?php
	
	//echo '<pre>';print_r($member_winner);echo '</pre>';
	 	
	if (!empty($members)){ ?>
		
	<?php 
	$a_message_error = $this->session->userdata('msg_error');
	if (!empty($a_message_error)){
		$this->session->unset_userdata('msg_error');
	?>
	<div class="bs-callout bs-callout-danger">
      <p><?php echo $a_message_error; ?></p>
    </div>
    <?php } ?>
    
    <?php 
	$a_message_success = $this->session->userdata('msg_success');
	if (!empty($a_message_success)){
		$this->session->unset_userdata('msg_success');
	?>
	<div class="bs-callout bs-callout-info">
      <p><?php echo $a_message_success; ?></p>
    </div>
    <?php } ?>
	
	<form method="post" name="member_form"
	enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/project_winner/submit_voucher_coll"
	>
		
		<input type="hidden" name="project_id" value="<?php echo $this->project->project_id; ?>" />
		<input type="hidden" name="voucher_id" value="<?php echo (!empty($this->voucher_pdf_exists->voucher_id)) ? $this->voucher_pdf_exists->voucher_id : ""; ?>" />
		
		<div class="panel panel-default" id="panel-voucher-upload">
		  <div class="panel-heading">
		    <h3 class="panel-title" style="display:inline-block;">Voucher</h3>
		    <div class="pull-right">
		    	<?php if (!empty($member_winner)){ ?>    	
    				<a style="margin-top:-5px;" href="<?php echo base_url(); ?>admin/project_winner/export_excel?pid=<?php echo $project_id; ?>&h=<?php echo sha1($project_id . SALT); ?>" class="btn btn-sm btn-success">Export to Excel</a>
    			<?php } ?>
		    </div>
		  </div>
		  <div class="panel-body">
		    <div class="col-md-3">
				<div class="form-group"><input type="file" name="voucher_data" id="voucher_data" /></div>
				<input type="submit" class="btn btn-sm btn-default" name="voucher_submit" id="voucher_submit" value="Upload Voucher" />
			</div>
			<?php if (!empty($this->voucher_pdf_exists)){ ?>
			<div class="col-md-1"><b>OR</b></div>
			<div class="col-md-3">
				<input type="submit" class="btn btn-default" name="voucher_submit" id="voucher_submit" value="Generate Voucher by System" />
			</div>
			<?php } ?>
		  </div>
		  <div class="panel-footer"><small>*) Harap pilih member yang akan dijadikan pemenang di bawah ini.
		  	
		  	<div>Jumlah Quota Pemenang : <?php echo $this->jml_winner; ?> . Jumlah Pemenang Terpilih : <?php echo count($member_winner); ?> . Jumlah Total Members : <?php echo count($members); ?> .
		  	</div>
		  	
		  	</small>
		  	
		  </div>
		</div>
		
		
	
	<table class="table table-hover">
        <thead>
          <tr>
			<th>Tiket Barcode</th>
			<th>Account Name</th>
			<th>Account Email</th>
			<th>Address</th>
			<th>Facebook</th>
			<th>Twitter</th>
			<th>CheckList</th>
          </tr>
        </thead>
        <tbody>
        	
        	<?php  
        	$return = array();
			foreach($members as $k=>$v){
						
				if (empty($return[$v->account_id])){
					$social_data = json_decode($v->social_data);
					$return[$v->account_id] = array(
						'tiket_id' => $v->tiket_id,
						'tiket_barcode' => $v->tiket_barcode,
						'project_name' => $v->project_name,
						'account_name' => $v->account_name,
						'account_email' => $v->account_email,
						$v->social_name => $social_data,
						'address' => $v->address,
						'province_name' => $v->province_name,
						'kecamatan_name' => $v->kecamatan_name,
						'phone_number' => $v->phone_number,
						'redeem_tiket_merchant' => $v->redeem_tiket_merchant,
						'used_tiket' => $v->used_tiket
					);
				}else{
					if (!empty($v->social_data)){
						$social_data = json_decode($v->social_data);
						$return[$v->account_id][$v->social_name] = $social_data;
					}
				}	
				
			}
			
			foreach($return as $k=>$v){
					
				$facebook_url = (!empty($v['facebook'])) ? 'LINK : <a href="http://facebook.com/'.$v['facebook']->id.'" target="_blank">LINK</a>' : "";
				$twitter_url = (!empty($v['twitter'])) ? 'LINK : <a href="http://twitter.com/'.$v['twitter']->screen_name.'" target="_blank">LINK</a>' : "";
				$twitter_followers_count = (!empty($v['twitter'])) ? '<br />Followers Count : '.$v['twitter']->followers_count : 0;
				
				$address = (empty($v['address'])) ? '-' : $v['address'];
				$pronvince = (empty($v['province_name'])) ? '-' : $v['province_name'];
				$kecamatan = (empty($v['kecamatan_name'])) ? '-' : $v['kecamatan_name'];
				$phone_number = (empty($v['phone_number'])) ? '-' : $v['phone_number'];
				$address_string = '<b>Address:</b> ' . $address . '<br />';
				$address_string .= '<b>Province:</b> ' . $pronvince . '<br />';
				$address_string .= '<b>Kecamatan:</b> ' . $kecamatan . '<br />';
				$address_string .= '<b>Phone:</b> ' . $phone_number . '<br />';

			?>
			
			<tr>
				<td><b><?php echo strtoupper($v['tiket_barcode']); ?></b>
					
					<?php if ($v['used_tiket'] == 1){
						
					?>
					
					<br /><i>(tiket sudah digunakan/diredeem)</i>
					
					<?php	
						
					} 
					?>
					
				</td>
				<td><?php echo ucwords($v['account_name']); ?></td>
				<td><?php echo $v['account_email']; ?></td>
				<td><?php echo $address_string; ?></td>
				<td><?php echo $facebook_url; ?></td>
				<td><?php echo $twitter_url.$twitter_followers_count; ?></td>
				<td>
					<?php 
					$l = '';
					if (!empty($member_winner[$k]) && property_exists($member_winner[$k], "voucher_data")){
						$l = '<a href="'. cdn_url() . $member_winner[$k]->voucher_data . '" target="_blank">KLIK</a>';
					}
					if (!empty($member_winner[$k]) && property_exists($member_winner[$k], "voucher_data_int") && $member_winner[$k]->voucher_data_int > 0){
						$l = '<a href="'. cdn_url() . 'admin/voucherpdf/details_see_pdf?vpid=' . $member_winner[$k]->voucher_data_int . '&h='. sha1( $member_winner[$k]->voucher_data_int . SALT ) .'" target="_blank">KLIK</a>';
					}
					
					if (empty($l)){
					?>
					<input type="checkbox" class="" name="members[]" id="members" value="<?php echo $v['tiket_id']; ?>" />
					<?php 
					}else{
					?>
					<span class="glyphicon glyphicon-ok"></span><br />
					<b>See Voucher : <?php echo $l; ?></b>
					<?php	
					}
					?>
				</td>
			</tr>
			
			<?php
				
			}
			
			?>

        </tbody>
    </table>
    
    <?php }else{
    	
	?>
	
	<div class="alert alert-warning" style="margin-top:10px;">
		<p>Member Lists is Empty</p>
	</div>
	
	<?php	
		
    } ?>
	
		</div>
		
		<div class="tab-pane fade in project-tab-section" id="scantikets">
			
			<div class="panel panel-default" id="panel-voucher-upload" style="border-top:0;border-radius:0 0 4px 4px;">
			  <div class="panel-body">
			      <div class="col-lg-6" style="float:none;margin:0 auto;">
				    <div class="input-group">
				      <input type="text" class="form-control" id="tiket-barcode">
				      <span class="input-group-btn">
				        <button class="btn btn-default btn-primary" type="button" id="btn-search-tiket">Search!</button>
				      </span>
				    </div><!-- /input-group -->
				    <p class="help-block" id="loading" style="display:none;">Loading...</p>
				  </div><!-- /.col-lg-6 -->
			  </div>
			</div>
			
			<div class="modal fade" id="modal-confirm-tiket">
			  <div class="modal-dialog" style="margin-top:200px;">
			    <div class="modal-content">
			      <div class="modal-body" style="padding-bottom:0;">
			        <p id="message-success" style="display:none;">Click Yes to confirm his/her presence at "<?php echo ucwords($this->project->project_name); ?>"</p>
			        <p id="message-error1" style="display:none;">Sorry, This ticket number is not valid.</p>
			        <p id="message-error2" style="display:none;">Sorry, This ticket number has been used.</p>
			      </div>
			      <div class="modal-footer">
			      	<button type="button" class="btn btn-default" data-dismiss="modal" id="btn-close" style="display:none;">Close</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-cancel" style="display:none;">Cancel</button>
			        <button type="button" class="btn btn-primary" id="btn-confirm" style="display:none;">Yes</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			
		</div>	
		
	</div>	
	

    <?php 
	/*
	}else{
    	
		
		echo '<p>Tidak ada data</p>';
		
		echo '<p>Oooppsss... sudah ada yang menang nih : </p>';
		echo '<pre>';
		print_r($member_winner);
		echo '</pre>';
		
	?>	 
	
	<?php }*/ ?>
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>