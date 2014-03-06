<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Member Point</h2>	
	
	<hr />
	
	<?php 
	$manual_point_error = $this->session->userdata('manual_point_error');
	if (!empty($manual_point_error)){
		$this->session->unset_userdata('manual_point_error');
		$m = '<li>'.implode('</li><li>', $manual_point_error) . '</li>';
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
	$manual_point_success = $this->session->userdata('manual_point_success');
	if (!empty($manual_point_success)){
		$this->session->unset_userdata('manual_point_success');
	?>
	<div class="bs-callout bs-callout-info">
      <p>Save Successfull</p>
    </div>
    <?php } ?>
	
	<form class="form-inline" role="form" method="get">
	  <div class="form-group">
	  	<a href="#" class="btn btn-default" id="btn-point" data-toggle="modal" data-target="#myModal">Add Points</a>
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
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" style="margin-top:100px;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Tambah Point</i></h4>
	      </div>
	      
	      <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>admin/member/submit_manual_point">
	      
	      <div class="modal-body" style="padding-bottom:2px;">
	       	   <div class="form-group">
			    <label for="point" class="col-sm-2 control-label">Business</label>
			    <div class="col-sm-10">
			      <select name="account_id" id="account_id" class="form-control">
			      	<option value="0">Pilih Business</option>
			      	<?php 
			      	foreach($business as $k=>$v){
			      	?>
			      	<option value="<?php echo $v->account_id; ?>"><?php echo ucwords( $v->account_name ); ?></option>
			      	<?php
			      	}
			      	?>
			      </select>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="point" class="col-sm-2 control-label">Point</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="point" id="point" placeholder="Point" />
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="note" class="col-sm-2 control-label">Note</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="note" id="note" placeholder="Note" />
			    </div>
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <input type="submit" class="btn btn-primary" id="btn-add-point" name="btn_submit_point" value="Submit" />
	      </div>
	      
	     </form>
	      
	    </div>
	  </div>
	</div>
	
	<hr />
	
	<table class="table table-hover">
        <thead>
          <tr>
            <th>Business Id</th>
            <th>Account Id</th>
            <th>Business Name</th>
            <th>Email</th>
            <th>Total Points</th>
          </tr>
        </thead>
        <tbody>
        	
        	<?php foreach($members as $k=>$v){ ?>
          <tr>
            <td><?php echo $v->business_id; ?> </td>
            <td><?php echo $v->account_id; ?></td>
            <td><?php echo ucwords($v->business_name); ?></td>
            <td><?php echo $v->account_email; ?></td>
            <td><?php echo $v->point; ?> Point</td>
          </tr>
          	<?php } ?>
        </tbody>
      </table>

		<?php 
			if (!empty($pagination)) echo $pagination;
		?>

</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>