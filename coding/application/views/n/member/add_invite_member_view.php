<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Add User / Member Invitation</h2>	
	
	<hr />
	
	<?php /******* START MESSAGE */ ?>
	
	<?php 
	$msg_invite_member = $this->session->userdata('msg_invite_member');
	if (!empty($msg_invite_member)){
		$this->session->unset_userdata('msg_invite_member');
		if ($msg_invite_member == 1){
	?>
		<div class="bs-callout bs-callout-danger">
	      <p>Something Error. Please try again Invite Member Invitation.</p>
	    </div>
	    <?php } ?>
    
	    <?php 
		if ($msg_invite_member == 2){
		?>
		<div class="bs-callout bs-callout-info">
	      <p>Invite Member Invitation Successfull</p>
	    </div>
    <?php } 
	}
    ?>
	
	<?php /******* END MESSAGE */ ?>
	
	<form class="form-horizontal" role="form" method="post" 
	enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/member/sending_invite_member"
	>
	  <div class="form-group">
	    <label for="account_name" class="col-sm-2 control-label">Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Name" value="" />
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="account_email" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="account_email" name="account_email" placeholder="Email" value="" />
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="account_type" class="col-sm-2 control-label">Type</label>
	    <div class="col-sm-10">
	      <select name="account_type" id="account_type" class="form-control">
	      	<option value="quest">Quest</option>
	      	<option value="special_quest">Special Quest</option>
	      	<option value="merchant">Merchant</option>
	      </select>
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