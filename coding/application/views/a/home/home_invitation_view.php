<?php $this->load->view('a/general/head_view', $this->data); ?>

<div class="home_invite_container">
	
	<div class="home_invite_wrapper">
		
		<div class="logo_invite">
			<img src="<?php echo cdn_url(); ?>img/bg_logo_invitation.png" alt="logo invitation" />
		</div>
		
		<form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>ajax/invitation_submit">
		  <div class="form-group">
		    <label class="sr-only" for="email_address">Email address</label>
		    <input type="email" class="form-control form-light" id="email_address" name="email_address" placeholder="Enter invitation email">
		  </div>
		  <input type="submit" class="btn btn-yellow" value="Confirm" name="confirm" />
		  
		  <?php 
		  $message_invitation_error = $this->session->userdata('message_invitation_error');
		  if (!empty($message_invitation_error)){
		  	 $this->session->unset_userdata('message_invitation_error');
		  ?>
		  <div class="alert alert-danger">Sorry, You're not in <b>Activorm's Private Beta The Invitation List</b>.</div>
		  <?php } ?>
		  
		  <p class="note_email">Please enter your invitation email. Contact : <a href="mailto:beta@activorm.com">beta@activorm.com</a></p>
		</form>
		
	</div>
	
</div>

<?php $this->load->view('a/general/footer_head_view', $this->data); ?>