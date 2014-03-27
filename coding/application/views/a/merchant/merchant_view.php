<?php $this->load->view('a/general/header_view', $this->data); ?>	

		<div id="content" class="block block-white">
			<div class="container">

				<h2 class="block-title">Our Merchants</h2>
				
				<div class="row list-merchant merchants">
					
					<?php 
					foreach($merchants as $k=>$v){
						$photo = $v->merchant_logo;
						$photo = $this->mediamanager->getPhotoUrl($photo, "185x90");
						?>
						<a href="<?php echo base_url() . $v->business_uri; ?>" target="_blank">
							<div class="col-md-3 col-sm-4 col-xs-6 item merchant-item" style="background:url('<?php echo cdn_url() . $photo; ?>') no-repeat center center;">
							</div>
						</a>
					<?php } ?>

				</div>
				
			</div>
		<!-- #content --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>