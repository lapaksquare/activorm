<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<?php 
					if ($this->access->member_account->account_type == "user"){
					?>

					<form class="form-activorm form-user-contact" action="#" method="get">
						<div class="box">
							<div class="row">
								<div class="col-sm-7">
									<h2 class="acc-input account-title"><span><?php echo ucwords( $this->access->member_account->account_name ); ?></span> <a href="#"><i class="icon-pencil" data-edit="title"></i></a></h2>
									<div class="acc-input account-email"><span><?php echo ucwords( $this->access->member_account->account_email ); ?></span> <a href="#"><i class="icon-pencil" data-edit="email"></i></a></div>

									<div class="form-group file-upload">
										<input type="file" name="account-avatar" class="real-file" style="display:none;" />
										<div class="row">
											<div class="col-xs-8">
											<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" />
											</div>
											<div class="col-xs-4">
												<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-5">
									<div class="account-avatar">
										
										<?php 
										$photo = (empty($this->access->member_account->account_primary_photo)) ? 'img/company-avatar.gif' : $this->access->member_account->account_primary_photo;
										$photo = $this->mediamanager->getPhotoUrl($photo, "137x137");
										?>
										
										<img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo ucwords( $this->access->member_account->account_name ); ?>" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-location">Province <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<select name="account-location" class="custom-select light-select select-city">
													<option>City</option>
													<option>Jakarta</option>
													<option>Bandung</option>
													<option>Surabaya</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-location">Kabupaten <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<select name="account-location" class="custom-select light-select select-city">
													<option>City</option>
													<option>Jakarta</option>
													<option>Bandung</option>
													<option>Surabaya</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="clearfix row-divider"></div>
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-location">Kecamatan <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<select name="account-location" class="custom-select light-select select-city">
													<option>City</option>
													<option>Jakarta</option>
													<option>Bandung</option>
													<option>Surabaya</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-location">Kelurahan <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<select name="account-location" class="custom-select light-select select-city">
													<option>City</option>
													<option>Jakarta</option>
													<option>Bandung</option>
													<option>Surabaya</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="clearfix row-divider"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-gender">Gender <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="radio" class="custom-checkgrey" value="1" name="gender" data-label="Male" checked />
										<input type="radio" class="custom-checkgrey" value="2" name="gender" data-label="Female" />
									</div>
								</div>
								
								<div class="clearfix row-divider"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-dob">Date of Birth <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input class="form-control form-light datepicker" placeholder="" type="text" name="birthday" value="" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-phone">Mobile Phone <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-phone" placeholder="+62" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="user-id">Identity Card Number <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="user-id" placeholder="" class="form-control form-light" />
										<p id="help-block-id" class="help-block"><i class="icon-attention"></i> Please ensure your identity card number is correct to confirm your background when you claim the prize you win. You may enter student card number if identity card number is not available.</p>
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-address">Address (optional)</label>
									</div>
									<div class="form-group">
										<textarea name="account-address" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-xs-7">
									<p class="help-block"><strong>Note:</strong> <em>We ensure none of your personal information will be given to the third party for any use.</em></p>
								</div>

								<div class="col-xs-5">
									<div class="form-submit">
										<button type="submit" class="btn btn-big btn-mt btn-green pull-right">Save Changes</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					
					<?php }else if ($this->access->member_account->account_primary_photo == "business"){ ?>
					
					<form class="form-activorm" action="#" method="get">
						<div class="box">
							<div class="row">
								<div class="col-sm-7">
									<h2 class="acc-input account-title"><span>Starbucks</span> <a href="#"><i class="icon-pencil" data-edit="title"></i></a></h2>
									<div class="acc-input account-email"><span>info@starbucks.com</span> <a href="#"><i class="icon-pencil" data-edit="email"></i></a></div>

									<div class="form-group file-upload">
										<input type="file" name="account-avatar" class="real-file" style="display:none;" />
										<div class="row">
											<div class="col-xs-8">
											<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" />
											</div>
											<div class="col-xs-4">
												<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-5">
									<div class="account-avatar">
										<img src="<?php echo cdn_url(); ?>img/company-avatar.gif" alt="starbucks" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-contact">Contact Person <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-contact" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-position">Position in the Company <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-position" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-number">Contact Number <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-number" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-description">Business Description <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<textarea name="account-description" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-address">Business Billing Address <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<textarea name="account-address" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-city">City <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-city" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-zipcode">Zip Code <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-zipcode" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-need">Business Needs (optional)</label>
									</div>
									<div class="form-group">
										<textarea name="account-need" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-sm-7">
									<p class="help-block"><strong>Note:</strong> <em>We ensure none of your personal information will be given to the third party for any use.</em></p>
								</div>

								<div class="col-sm-5">
									<div class="form-submit">
										<button type="submit" class="btn btn-big btn-mt btn-green pull-right">Save Changes</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					
					<?php } ?>

				<!-- #content --></div>

				<?php $this->load->view('a/settings/settings_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>