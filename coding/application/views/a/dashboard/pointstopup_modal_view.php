<div id="modal-topup" class="modal modal-activorm fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="padding-bottom:0;">
				
				<h4 class="modal-title">You need more points than listed above?</h4>

				<form method="post" action="<?php echo base_url(); ?>dashboard/submit_pointtopup_needed">

				<div class="form-group" style="margin-bottom: 15px;">
					<input type="text" name="note_topup_amount" id="topup_amount" placeholder="write your points" class="form-control">
					<input type="submit" class="btn btn-yellow" name="submit_needed_topup" id="submit_needed_topup" value="Submit" />
				</div>
				
				</form>
				
				<?php /*
				<div class="modal-confirm">
					<strong>Confirmation</strong>
					<p>Our representative will contact you in 1x24 hours to assist.</p>
				</div> */ ?>
				
			</div>
		</div>
	</div>
<!-- .modal --></div>	