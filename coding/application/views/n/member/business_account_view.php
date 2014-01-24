<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Business Account - User</h2>	
	
	<hr />
	
	<form class="form-inline" role="form" method="get">
	  <div class="form-group">
	    <label class="sr-only" for="search_by">Search By</label>
	    <select class="form-control" name="search_by" id="search_by">
	    	<?php 
	    	$sb = array(
				"ma.account_id" => "Account Id",
				"bp.business_id" => "Business Id",
				"bp.business_name" => "Business Name",
				"ma.account_email" => "Account Email"
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
	</form>
	
	<hr />
	
	<table class="table table-hover">
        <thead>
          <tr>
            <th>Business Id</th>
            <th>Account Id</th>
            <th>Business Name</th>
            <th>Email</th>
            <th>Total Points</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        	
        	<?php foreach($members as $k=>$v){ ?>
          <tr>
            <td><?php echo $v->business_id; ?></td>
            <td><?php echo $v->account_id; ?></td>
            <td><?php echo ucwords($v->business_name); ?></td>
            <td><?php echo $v->account_email; ?></td>
            <td><?php echo $v->point; ?> Point</td>
            <td><?php echo ucfirst($v->account_live); ?></td>
            <td><a href="<?php echo base_url(); ?>admin/member/business_account_details?bai=<?php echo $v->business_id; ?>&mai=<?php echo $v->account_id; ?>&h=<?php echo sha1($v->business_id . $v->account_id . SALT); ?>" class="btn btn-primary">Details</a></td>
          </tr>
          	<?php } ?>
        </tbody>
      </table>

		<?php 
			if (!empty($pagination)) echo $pagination;
		?>

</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>