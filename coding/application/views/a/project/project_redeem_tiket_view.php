<div id="modal-project-redeem-confirmation" class="modal modal-activorm" style="display:none;">
	<div class="modal-dialog" style="width:520px;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			
			<div class="modal-body" style="padding-bottom:18px;padding-top: 0;">
				
				<h4 class="modal-title" style="font-size:35px;">Redeem Prize</h4>
				
				<div class="modal-confirm">
					<p style="font-size: 16px;line-height: 18px;padding-top: 2px;">This “Redeem” button may only be used by merchant’s waiter. 
Once you hit “Redeem” button, redeem prize is no longer available.</p>

					<div class="image-price-container" style="margin-top:30px;">
						
						<?php 
						$image = $this->project_photos[0]->photo_file;
						$image = $this->mediamanager->getPhotoUrl($image, "300x300");
						
						$prize_name = $this->project->project_prize_detail;
						?>
						
						<img src="<?php echo cdn_url() . $image; ?>" class="img-circle" width="150" height="150" />
						<h4 style="font-weight:normal;margin-top:18px;"><?php echo $prize_name; ?></h4>
						
						<p style="margin-top:38px;"><a href="#" class="btn btn-blue" id="cancel-btn" style="margin-top: 8px;padding: 14px 25px;font-size: 20px;line-height: 17px;color:#fff;margin-right:30px;width:140px;">Cancel</a><a href="<?php echo base_url(); ?>actions/redeem_tiket?tid=<?php echo $this->checkTiket->tiket_barcode; ?>&h=<?php echo sha1($this->checkTiket->tiket_barcode . SALT); ?>" class="btn btn-yellow" id="btn_next_topup" style="margin-top: 8px;padding: 14px 25px;font-size: 20px;line-height: 17px;width:140px;">Redeem</a></p>
					</div> 

				</div>
				
			</div>
		</div>
	</div>
<!-- .modal --></div>	