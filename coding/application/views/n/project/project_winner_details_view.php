<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Project Active - #<?php echo $this->project->project_id.'#'.ucwords($this->project->project_name); ?> - Members</h2>	
	
	<hr />
	
	<?php 	
	if (!empty($members)){ ?>
	
	<h3>Members</h3>
	
	<table class="table table-hover">
        <thead>
          <tr>
			<th>Tiket Barcode</th>
			<th>Project Name</th>
			<th>Account Name</th>
			<th>Account Email</th>
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
						$v->social_name => $social_data
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
				
				echo '<tr>
					<td>'.strtoupper($v['tiket_barcode']).'</td>
					<td>'.ucwords($v['project_name']).'</td>
					<td>'.ucwords($v['account_name']).'</td>
					<td>'.$v['account_email'].'</td>
					<td>'.$facebook_url.'</td>
					<td>'.$twitter_url.$twitter_followers_count.'</td>
				</tr>';	
			}
			
			?>

        </tbody>
    </table>
    
    <?php } ?>
    
    <?php if (!empty($winner)){ ?>
    <h3>Pilih Para Pemenang</h3>
    
    <table class="table table-hover">
        <thead>
          <tr>
			<th>Tiket Barcode</th>
			<th>Project Name</th>
			<th>Account Name</th>
			<th>Account Email</th>
			<th>Account Address</th>
			<th>Actions</th>
		  </tr>
        </thead>
        <tbody>
        	
        	<?php 
        	
        	foreach($winner as $k=>$v){
				
				echo '<tr>
					<td>'.strtoupper($v->tiket_barcode).'</td>
					<td>'.ucwords($v->project_name).'</td>
					<td>'.ucwords($v->account_name).'</td>
					<td>'.$v->account_email.'</td>
					<td>'.$v->address.'</td>
					<td><a href="'.base_url().'admin/project_winner/confirmWinnerProjectTiket?pid='.$v->project_id.'&tid='.$v->tiket_id.'&h='.sha1($v->project_id . $v->tiket_id . SALT).'">Confirm</a></td>
				</tr>';	
				
			}
        	
        	?>
        	
        </tbody>
    </table>
    <?php } ?>
    
    
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
			<th>Project Name</th>
			<th>Account Name</th>
			<th>Account Email</th>
			<th>Account Address</th>
		  </tr>
        </thead>
        <tbody>
        	<?php 
        	foreach($member_winner as $k=>$v){
        		echo '<tr>
					<td>'.strtoupper($v->tiket_barcode).'</td>
					<td>'.ucwords($v->project_name).'</td>
					<td>'.ucwords($v->account_name).'</td>
					<td>'.$v->account_email.'</td>
					<td>'.$v->address.'</td>
					</tr>
				';
			?>
			
			<tr>
				<td colspan="5">
					<b>Upload Voucher untuk <?php echo strtoupper($v->tiket_barcode); ?></b>
					<br />
					<b>See Voucher : <?php echo (!empty($v->voucher_data)) ? '<a href="'. cdn_url() . $v->voucher_data . '" target="_blank">KLIK</a>' : '-'; ?></b>
					<br />
					<form class="form-inline" role="form" method="post" 
					enctype="multipart/form-data"
					action="<?php echo base_url(); ?>admin/project_winner/submit_voucher"
					>
						<div class="form-group"><input type="file" name="voucher_data" id="voucher_data" /></div>
						<input type="hidden" name="tiket_id" value="<?php echo $v->tiket_id; ?>" />
						<input type="hidden" name="project_id" value="<?php echo $v->project_id; ?>" />
						<input type="submit" class="btn btn-default" name="voucher_submit" id="voucher_submit" value="Submit" />
					</form>
				</td>
			</tr>
			
			<?php	
        	}
        	?>
        </tbody>
    </table>
    
    <?php } ?>
    
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