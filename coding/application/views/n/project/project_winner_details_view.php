<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-12 lp-header" role="main">
	
	<h2><?php echo ucwords($this->project->project_name); ?></h2>	
	
	<hr />
	
	<!-- TABBED START -->
	<ul class="nav nav-tabs project_tab" id="project_tab">
	  <li class="active"><a href="#members" data-rel="members">Members Lists</a></li>
	  <li><a href="#winners_list" data-rel="winners_list">Choose Winner Lists</a></li>
	  <li><a href="#winner" data-rel="winner">Winner</a></li>
	</ul>
	
	<div id="myTabContent" class="tab-content">
		
		<div class="tab-pane fade active in project-tab-section" id="members">
	
	<?php 	
	if (!empty($members)){ ?>
	
	<h3>Members</h3>
	
	<table class="table table-hover">
        <thead>
          <tr>
			<th>Tiket Barcode</th>
			<th>Account Name</th>
			<th>Account Email</th>
			<th>Address</th>
			<th>Facebook</th>
			<th>Twitter</th>
          </tr>
        </thead>
        <tbody>
        	
        	<?php  
        	$return = array();
			foreach($members as $k=>$v){
						
				if (empty($return[$v->account_id])){
					$social_data = json_decode($v->social_data);
					$return[$v->account_id] = array(
						'tiket_barcode' => $v->tiket_barcode,
						'project_name' => $v->project_name,
						'account_name' => $v->account_name,
						'account_email' => $v->account_email,
						$v->social_name => $social_data,
						'address' => $v->address,
						'province_name' => $v->province_name,
						'kecamatan_name' => $v->kecamatan_name,
						'phone_number' => $v->phone_number
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
				
				echo '<tr>
					<td>'.strtoupper($v['tiket_barcode']).'</td>
					<td>'.ucwords($v['account_name']).'</td>
					<td>'.$v['account_email'].'</td>
					<td>'.$address_string.'</td>
					<td>'.$facebook_url.'</td>
					<td>'.$twitter_url.$twitter_followers_count.'</td>
				</tr>';	
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
    
    	<div class="tab-pane fade project-tab-section" id="winners_list">
    
    <?php if (!empty($winner)){ ?>
    <h3>Pilih Para Pemenang</h3>
    
    <table class="table table-hover">
        <thead>
          <tr>
			<th>Tiket Barcode</th>
			<th>Account Name</th>
			<th>Account Email</th>
			<th>Account Address</th>
			<th>Actions</th>
		  </tr>
        </thead>
        <tbody>
        	
        	<?php 
        	
        	foreach($winner as $k=>$v){
        		
				$address = (empty($v->address)) ? '-' : $v->address;
				$pronvince = (empty($v->province_name)) ? '-' : $v->province_name;
				$kecamatan = (empty($v->kecamatan_name)) ? '-' : $v->kecamatan_name;
				$phone_number = (empty($v->phone_number)) ? '-' : $v->phone_number;
				$address_string = '<b>Address:</b> ' . $address . '<br />';
				$address_string .= '<b>Province:</b> ' . $pronvince . '<br />';
				$address_string .= '<b>Kecamatan:</b> ' . $kecamatan . '<br />';
				$address_string .= '<b>Phone:</b> ' . $phone_number . '<br />';
				
				echo '<tr>
					<td>'.strtoupper($v->tiket_barcode).'</td>
					<td>'.ucwords($v->account_name).'</td>
					<td>'.$v->account_email.'</td>
					<td>'.$address_string.'</td>
					<td><a href="'.base_url().'admin/project_winner/confirmWinnerProjectTiket?pid='.$v->project_id.'&tid='.$v->tiket_id.'&h='.sha1($v->project_id . $v->tiket_id . SALT).'">Confirm</a></td>
				</tr>';	
				
			}
        	
        	?>
        	
        </tbody>
    </table>
    <?php }else{
    	
	?>
	
	<div class="alert alert-warning" style="margin-top:10px;">
		<p>Winner Lists is Empty</p>
	</div>
	
	<?php	
		
    } ?>
    
    	</div>
    
    
    	<div class="tab-pane fade project-tab-section" id="winner">	
    
    <?php if (!empty($member_winner)){ ?>
    <h3>Pemenang</h3>	
    <?php 
    /*echo '<pre>';
	print_r($member_winner);
	echo '</pre>';*/
    ?>
   
    
    <table class="table table-hover">
        <thead>
          <tr>
			<th>Tiket Barcode</th>
			<th>Account Name</th>
			<th>Account Email</th>
			<th>Account Address</th>
		  </tr>
        </thead>
        <tbody>
        	<?php 
        	foreach($member_winner as $k=>$v){
        		
				$address = (empty($v->address)) ? '-' : $v->address;
				$pronvince = (empty($v->province_name)) ? '-' : $v->province_name;
				$kecamatan = (empty($v->kecamatan_name)) ? '-' : $v->kecamatan_name;
				$phone_number = (empty($v->phone_number)) ? '-' : $v->phone_number;
				$address_string = '<b>Address:</b> ' . $address . '<br />';
				$address_string .= '<b>Province:</b> ' . $pronvince . '<br />';
				$address_string .= '<b>Kecamatan:</b> ' . $kecamatan . '<br />';
				$address_string .= '<b>Phone:</b> ' . $phone_number . '<br />';
				
        		echo '<tr>
					<td>'.strtoupper($v->tiket_barcode).'</td>
					<td>'.ucwords($v->account_name).'</td>
					<td>'.$v->account_email.'</td>
					<td>'.$address_string.'</td>
					</tr>
				';
			?>
			
			<tr>
				<td colspan="5">
					<b>Upload Voucher untuk <?php echo strtoupper($v->tiket_barcode); ?></b>
					<br />
					
					<?php 
					$l = '';
					if (!empty($v->voucher_data)){
						$l = '<a href="'. cdn_url() . $v->voucher_data . '" target="_blank">KLIK</a>';
					}
					if (!empty($v->voucher_data_int)){
						$l = '<a href="'. cdn_url() . 'admin/voucherpdf/details_see_pdf?vpid=' . $v->voucher_data_int . '&h='. sha1( $v->voucher_data_int . SALT ) .'" target="_blank">KLIK</a>';
					}
					?>
					
					<b>See Voucher : <?php echo $l; ?></b>
					<br />
					
					<b>Generate Voucher:</b>
					<ul>
						<li>
							<form class="form-inline" role="form" method="post" 
							enctype="multipart/form-data"
							action="<?php echo base_url(); ?>admin/project_winner/submit_voucher"
							>
								<div class="form-group"><input type="file" name="voucher_data" id="voucher_data" /></div>
								<input type="hidden" name="tiket_id" value="<?php echo $v->tiket_id; ?>" />
								<input type="hidden" name="project_id" value="<?php echo $v->project_id; ?>" />
								<input type="submit" class="btn btn-default" name="voucher_submit" id="voucher_submit" value="Submit" />
							</form>
						</li>
						<?php if (!empty($this->voucher_pdf_exists)){ ?>
						<li><a href="<?php echo base_url(); ?>admin/project_winner/generate_voucher?project_id=<?php echo $v->project_id; ?>&tiket_id=<?php echo $v->tiket_id; ?>&voucher_id=<?php echo $this->voucher_pdf_exists->voucher_id; ?>&h=<?php echo sha1($v->project_id . $v->tiket_id . $this->voucher_pdf_exists->voucher_id . SALT); ?>" class="btn btn-default">Generate Voucher</a></li>
						<?php } ?>
					</ul>
					
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
		<p>Winner Lists is Empty</p>
	</div>
	
	<?php	
		
    } ?>
    
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