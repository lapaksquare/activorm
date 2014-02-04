<div id="modal-project" class="modal modal-activorm fade">
	<div class="modal-dialog">
		<div class="modal-content" style="padding-bottom:40px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>

			<div class="modal-body">
				<h4 class="modal-title">Thank you for creating project on Activorm. Our representative will contact you in 1x24 hours to confirm this project.</h4>

				<form method="post" action="<?php echo base_url(); ?>project/submit_contactproject">

					<div class="form-group">
						<input type="text" name="contact_name" placeholder="Person In Charge" class="form-control form-green" />
					</div>

					<div class="form-group">
						<input type="text" name="contact_email" placeholder="Email" class="form-control form-green" />
					</div>

					<div class="form-group">
						<input type="text" name="contact_phone" placeholder="Phone Number" class="form-control form-green" />
					</div>

					<div class="form-submit">
						<?php 
						$pid = (!empty($this->project) && !empty($this->project->project_id)) ? $this->project->project_id : 0;
						$hash = sha1($pid . SALT); 
						?>
						<input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>" />
						<input type="hidden" name="pid_hash" id="pid_hash" value="<?php echo $hash; ?>" />
						<input type="submit" class="btn btn-big btn-wd btn-yellow pull-right" value="Submit" name="submit-btn" id="submit-btn" />
					</div>
					
				</form>	
					
			</div>
		</div>
	</div>
<!-- .modal --></div>