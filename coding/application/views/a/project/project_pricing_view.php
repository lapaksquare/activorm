<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="row">
				
			<?php 
			$message_submit_premiumproject = $this->session->userdata('message_submit_premiumproject');
			$this->session->unset_userdata('message_submit_premiumproject');
			if (!empty($message_submit_premiumproject) && $message_submit_premiumproject == 1){
				$message_error = 'Terjadi kesalahan dalam pengiriman data.';
			?>
			<div class="alert alert-danger"><?php echo $message_error; ?></div>
			<?php } ?>	
				
			<form class="form-activorm" action="<?php echo base_url(); ?>project/submit_premiumproject" method="post" id="form_pricing">
				<div class="col-sm-8 pricing-budget">
					<div class="box">
						<div class="row">
							<div class="col-sm-6 pricing-slider">
								<strong style="margin-bottom:0;">Budget IDR 100.000 - 1.000.000</strong>
								
								<?php /*
								<input id="project-budget" name="project-budget" data-slider-id="slider-period" type="text" data-slider-min="100000" data-slider-max="1000000" data-slider-step="10000" data-slider-value="100000" />
								*/ ?>
								 
								 <div style="font-size:45px;">IDR 100.000</div>
								 
								 </div>

							<div class="col-sm-6 pricing-counter">
								<div class="counter-box">
									<span>1 Point IDR 1.000</span>
									<strong class="green">100 Points</strong>
								</div>
							</div>
						</div>
					</div>
				<!-- .pricing-budget --></div>

				<div class="col-sm-4 pricing-balance">
					<div class="box">
						<strong>Your Point Balance Now</strong>
						<span class="balance-box" data-balance="<?php echo $points_user; ?>"><?php echo $points_user; ?> Points</span>
						<span class="balance-note">You don't have enough balance, please <a href="#">Top Up</a></span>
					</div>
				<!-- .pricing-balance --></div>

				<div class="clearfix"></div>

				<div class="col-xs-12 pricing-plans">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Pricing per Project</h3>
						</div>

						<div class="row pricing-panel">
							<div class="col-sm-4">
								<div class="panel panel-plan">
									<div class="panel-heading">
										<h3 class="panel-title">CPM (Cost per Impression)</h3>
									</div>

									<div class="panel-body" data-plantype="cpm">
										<div class="panel-price">
											<?php /*
											<span>IDR 150/impression</span>
											<strong>0,15 Points</strong> */ ?>
											<span>IDR 100K/project</span>
											<strong>100 Points</strong>
											<span class="panel-stars star-1"></span>
										</div>

										<ul>
											<li>Full Dashboard &amp; Analytics</li>
											<li>Campaign in Activorm Newsletter</li>
											<li>Get more tickets by more sharing</li>
											<li>Direct Prize</li>
											<li>Display merchant social accounts</li>
										</ul>
										
										<input type="hidden" name="plan_type[cpm]" value="cpm" />	
										<input type="hidden" name="plan_type_hash[cpm]" value="<?php echo sha1("cpm" . SALT); ?>" />	
										<button type="submit" class="btn btn-big btn-yellow" id="btn_select_point">Select This Plan</button>
									</div>
								<!-- .panel-plan --></div>
							</div>

							<div class="col-sm-4 blur-block">
								<div class="panel panel-plan">
									<div class="panel-heading">
										<h3 class="panel-title">PPC (Pay per Click)</h3>
									</div>

									<div class="panel-body" data-plantype="ppc">
										<div class="panel-price">
											<span>IDR 1.000/click</span>
											<strong>1 Points</strong>
											<span class="panel-stars star-2"></span>
										</div>

										<ul>
											<li>Full Dashboard &amp; Analytics</li>
											<li>Campaign in Activorm Newsletter</li>
											<li>Get more tickets by more sharing</li>
											<li>Direct Prize</li>
											<li>Display merchant social accounts</li>
											<li>Campaign featured in first 3 pages</li>
										</ul>
										
										<input type="hidden" name="plan_type[ppc]" value="ppc" />	
										<input type="hidden" name="plan_type_hash[ppc]" value="<?php echo sha1("ppc" . SALT); ?>" />	
										<?php /*
										<button type="submit" class="btn btn-big btn-yellow" id="btn_select_point">Select This Plan</button> */ ?>
									</div>
								<!-- .panel-plan --></div>
							</div>

							<div class="col-sm-4 blur-block">
								<div class="panel panel-plan">
									<div class="panel-heading">
										<h3 class="panel-title">Member Join</h3>
									</div>

									<div class="panel-body" data-plantype="mj">
										<div class="panel-price">
											<span>IDR 2.500/member join</span>
											<strong>2,5 Points</strong>
											<span class="panel-stars star-3"></span>
										</div>

										<ul>
											<li>Full Dashboard &amp; Analytics</li>
											<li>Campaign in Activorm Newsletter</li>
											<li>Get more tickets by more sharing</li>
											<li>Direct Prize</li>
											<li>Display merchant social accounts</li>
											<li>Campaign featured in first 3 pages</li>
											<li>Free Ads Banner</li>
										</ul>

										<input type="hidden" name="plan_type[mj]" value="mj" />	
										<input type="hidden" name="plan_type_hash[mj]" value="<?php echo sha1("mj" . SALT); ?>" />
										<?php /*
										<button type="submit" class="btn btn-big btn-yellow" id="btn_select_point">Select This Plan</button> */ ?>
									</div>
								<!-- .panel-plan --></div>
							</div>
						<!-- .pricing-panel --></div>

						<div class="clearfix row-divider"></div>

						<a class="btn btn-green btn-back" href="<?php echo base_url(); ?>project/edit/<?php echo $this->project->project_uri; ?>">Back</a>
					</div>
				<!-- .pricing-plans --></div>
				
				<input type="hidden" name="cplan" id="cplan" value="" />
				<input type="hidden" name="pid" id="pid" value="<?php echo $this->project->project_id; ?>" />
				<input type="hidden" name="pid_hash" id="pid_hash" value="<?php echo sha1($this->project->project_id . SALT); ?>" />
				<?php $this->load->view('a/project/project_modal_thankyou_view', $this->data); ?>
				
			</form>
			</div>

		<!-- #main --></div>

<?php $this->load->view('a/project/project_modal_thankyou_view', $this->data); ?>

<?php $this->load->view('a/general/footer_view', $this->data); ?>