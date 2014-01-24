<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<!--<span class="page-subtitle">Check list if you want the notification send to your email.</span>-->
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<?php 
					$msg_settingemail = $this->session->userdata('msg_settingemail');
					if (!empty($msg_settingemail)){
						$this->session->unset_userdata('msg_settingemail');
					?>
					<div class="alert alert-success">Email setting saved!</div>
					<?php
					}
					?>

					<form class="form-activorm form-user-email" action="<?php echo base_url(); ?>settings/save_settingemail" method="post">
						<div class="box">
							
							<?php if ($this->access->member_account->account_type == "user"){ ?>
							
							<div class="box-header">
								<h2 class="box-title">Email notification when...</h2>
							</div>

							<div class="form-group">
								<?php 
								$set = (!empty($member_email['set1'])) ? 'checked' : '';
								?>
								<input type="checkbox" <?php echo $set; ?> class="custom-checkgrey" value="email-new" name="email-new" data-label="New project posted by publisher"  />
							</div>
							<div class="form-group">
								<?php 
								$set = (!empty($member_email['set2'])) ? 'checked' : '';
								?>
								<input type="checkbox" <?php echo $set; ?> class="custom-checkgrey" value="email-winner" name="email-winner" data-label="Winner announcement of project I join"  />
							</div>
							<div class="form-group">
								<?php 
								$set = (!empty($member_email['set3'])) ? 'checked' : '';
								?>
								<input type="checkbox" <?php echo $set; ?> class="custom-checkgrey" value="email-comment" name="email-comment" data-label="Someone reply on my comment in a project I join" />
							</div>
							
							<?php /*
							<div class="form-group">
								<?php 
								$set = (!empty($member_email['set4'])) ? 'checked' : '';
								?>
								<input type="checkbox" <?php echo $set; ?> class="custom-checkgrey" value="email-other" name="email-other" data-label="Winner announcement of project I join" />
							</div>
							
							 * 
							 */ ?>
							 
							 
							<?php }else if ($this->access->member_account->account_type == "business"){  ?>

							<h3 class="form-subtitle">Newsletter</h3>

							<div class="row">
								<div class="clearfix"></div>

								<div class="col-sm-6">
									<div class="form-group">
										<?php 
										$set = (!empty($member_email['set5'])) ? 'checked' : '';
										?>
										<input type="checkbox" <?php echo $set; ?> class="custom-checkgrey" value="email-newsletter" name="email-newsletter" data-label="I want to receive Activorm newsletter" />
									</div>
								</div>

								
							</div>
							
							<div class="clearfix"></div>
							
							<?php } ?>
							
							<div class="">
								<div class="form-submit">
									<input type="submit" class="btn btn-big bnt-mt btn-green pull-right" name="save_changes" value="Save Changes" />
								</div>
							</div>
							
							<div class="clearfix"></div>
							
						</div>
					</form>

				<!-- #content --></div>

				<?php $this->load->view('a/settings/settings_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>	

<?php $this->load->view('a/general/footer_view', $this->data); ?>