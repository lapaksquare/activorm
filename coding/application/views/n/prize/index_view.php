<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Prize Profile</h2>	
	
	<hr />
	
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
	
	<form class="form-inline" role="form" method="get">
	  <div class="form-group">
	    <label class="sr-only" for="search_by">Search By</label>
	    <select class="form-control" name="search_by" id="search_by">
	    	<?php 
	    	$sb = array(
				"pp.prize_id" => "Prize Id",
				"pp.prize_name" => "Prize Name",
				"bp.business_id" => "Business Id",
				"bp.business_name" => "Business Name",
				"ppp.project_id" => "Project Id",
				"ppp.project_name" => "Project Name"
			);
			foreach($sb as $k=>$v){
				$class = ($k == $this->search_by) ? "selected" : "";
			?>
			<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
			<?php
			}
	    	?>
	    </select>
	  </div>
	  <div class="form-group">
	    <input type="text" class="form-control" id="q" name="q" placeholder="Keyword" value="<?php echo $this->q; ?>">
	  </div>
	  <button type="submit" class="btn btn-default">Search</button>
	  <a href="<?php echo base_url(); ?>admin/prize/add_prize" class="btn btn-default">Add Prize</a>
	</form>
	
	<hr />
	
	<table class="table table-hover">
        <thead>
          <tr>
            <th>LastUpdate</th>
            <th>Prize Name</th>
            <th>Prize Photo</th>
            <th>Business Name</th>
            <th>Project Title</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        	<?php foreach($prizes as $k=>$v){ ?>
        		<tr>
        			<td><?php echo date("d M Y, H:i", strtotime($v->lastupdate)); ?></td>
        			<td><?php echo ucwords($v->prize_name); ?></td>
        			<td>
        				<?php
        				if (!empty($v->prize_primary_photo)){
        					$photo = $this->mediamanager->getPhotoUrl($v->prize_primary_photo, "200x200");
						?>
							<img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo ucwords($v->prize_name); ?>" />
						<?php
						}else{
							echo '-';
						}
						?>
        			</td>
        			<td><?php echo ucwords($v->business_name); ?></td>
        			<td><?php echo ucwords($v->project_name); ?></td>
        			<td><?php echo ($v->isactive == 1) ? "Active" : "Non Active"; ?></td>
        			<td><a href="<?php echo base_url(); ?>admin/prize/prize_detail?prid=<?php echo $v->prize_id; ?>&ppid=<?php echo $v->project_id; ?>&h=<?php echo sha1($v->prize_id . $v->project_id . SALT); ?>" class="btn btn-primary">Details</a></td>
        		</tr>
        	<?php } ?>	
        </tbody>
    </table>	
    
    <?php 
		if (!empty($pagination)) echo $pagination;
	?>
	
</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>