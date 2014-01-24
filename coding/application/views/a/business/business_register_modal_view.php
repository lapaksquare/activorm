<div id="modal-signup" class="modal modal-activorm fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>

			<div class="modal-body">
				<h4 class="modal-title">Thank You for Signing Up!</h4>
				
				<?php 
				$msg_resend_businessaccount = $this->session->userdata('msg_resend_businessaccount');
				if (!empty($msg_resend_businessaccount)){
					$this->session->unset_userdata('msg_resend_businessaccount');
					if ($msg_resend_businessaccount == 1){
				?>
				<div class="alert alert-danger">Failed to send email to you.</div>
				<?php }else if ($msg_resend_businessaccount == 2){ ?>
				<div class="alert alert-success">Email has been resent successfully</div>
				<?php } ?>
				<?php } ?>

				<p id="text-1">Please kindly check your email to complete registration. Our representative will contact you to check if you are the official account.</p>
				<?php 
				$tmp_email_business = $this->session->userdata('tmp_email_business');
				$link_resend = base_url() . 'auth/resend_businessaccount?e=' . $tmp_email_business . '&eh=' . sha1(SALT . $tmp_email_business);
				?>
				<p id="text-2">Didn't get the email ? try checking your spam folder or click <a href="<?php echo $link_resend; ?>">here</a> to resend it</p>

				<button type="button" class="btn btn-big btn-wd btn-yellow" data-dismiss="modal" aria-hidden="true">Done</button>
			</div>
		</div>
	</div>
<!-- .modal --></div>