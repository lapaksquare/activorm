<?php $this->load->view('a/general/header_view', $this->data); ?>

<style type="text/css">
	.dk_theme_light {
		width: 100%;
		margin: 0;
		position: relative;
		background: #eef3f6;
	}
	.birth-year{
		display:inline-block !important;
		width:80px !important;
		margin-right: 0 !important;
	}
	.birth-month{
		display: inline-block !important;
		width: 115px !important;
		margin-right: 10px !important;
	}
	.birth-day{
		display: inline-block !important;
		width: 80px !important;
		margin-right: 10px !important;
	}
</style>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<!--<span class="page-subtitle">You must fill the form cause it's very important.</span>-->
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<?php 
					$message_settings_contact_error = $this->session->userdata('message_settings_contact_error');
					if (!empty($message_settings_contact_error)){
						$this->session->unset_userdata('message_settings_contact_error');
						$message_settings_contact_error = '<li>'.implode('</li><li>', $message_settings_contact_error) . '</li>';
					?>
					<div class="alert alert-danger">
						<ul>
							<?php echo $message_settings_contact_error; ?>
						</ul>
					</div>
					<?php } ?>
					
					<?php 
					$message_settings_contact_success = $this->session->userdata('message_settings_contact_success');
					if (!empty($message_settings_contact_success)){
						$this->session->unset_userdata('message_settings_contact_success');
					?>
					<div class="alert alert-success">
						<ul>
							<?php echo $message_settings_contact_success; ?>
						</ul>
					</div>
					<?php
					}
					?>

					<?php 
					if ($this->access->member_account->account_type == "user"){
					?>

					<form class="form-activorm form-user-contact" action="<?php echo base_url() . 'settings/save_settings_contact'; ?>" method="post" enctype="multipart/form-data">
						<div class="box">
							<div class="row">
								<div class="col-sm-7">
									
									<?php 
									$account_name = (!empty($this->access->member_account->account_name)) ? $this->access->member_account->account_name : '';
									$sess_account_name = $this->session->userdata('account_name');
									if (!empty($sess_account_name)){
										$this->session->unset_userdata('account_name');
										$account_name = $sess_account_name;
									}
									
									$account_email = (!empty($this->access->member_account->account_email)) ? $this->access->member_account->account_email : '';
									$sess_account_email = $this->session->userdata('account_email');
									if (!empty($sess_account_email)){
										$this->session->unset_userdata('account_email');
										$account_email = $sess_account_email;
									}
									?>
									
									<h2 class="acc-input account-title"><span><?php echo ucwords( $account_name ); ?></span> <a href="#"><i class="icon-pencil" data-edit="title"></i></a></h2>
									<div class="acc-input account-email"><span><?php echo ucwords( $account_email ); ?></span> <a href="#"><i class="icon-pencil" data-edit="email"></i></a></div>
									
									<input type="hidden" name="account_title" id="account_title" value="<?php echo $account_name; ?>" />
									<input type="hidden" name="account_email" id="account_email" value="<?php echo $account_email; ?>" />

									<div class="form-group file-upload">
										<input type="file" name="account_avatar" class="real-file" style="display:none;" />
										<div class="row">
											<div class="col-xs-8">
											<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" />
											</div>
											<div class="col-xs-4">
												<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
											</div>
											
											<div class="clearfix"></div>
											<p class="help-block" style="margin-left:20px;"><strong>Tips:</strong> <em>Image must be <strong>jpg/jpeg, gif, or png</strong> smaller than <strong>2 MB</strong>, dimension are limeted to <strong>200x200</strong> pixels image larger than this will be resized.</em></p>
											
										</div>
									</div>
								</div>

								<div class="col-sm-5">
									<div class="account-avatar">
										
										<?php 
										
										$account_primary_photo = (!empty($this->access->member_account->account_primary_photo)) ? $this->access->member_account->account_primary_photo : '';
										$sess_account_primary_photo = $this->session->userdata('account_primary_photo');
										if (!empty($sess_account_primary_photo)){
											$this->session->unset_userdata('account_primary_photo');
											$account_primary_photo = $sess_account_primary_photo;
										}
										
										$photo = (empty($account_primary_photo)) ? 'img/company-avatar.gif' : $account_primary_photo;
										$photo = $this->mediamanager->getPhotoUrl($photo, "137x137");
										?>
										
										<img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo ucwords( $account_name ); ?>" />
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
												<select name="account_province" id="account_province" class="custom-select light-select select-city">
													<option value="0">Select Province</option>
													
													<?php 
													$account_province = (!empty($this->access->member_account->province_id)) ? $this->access->member_account->province_id : '';
													$sess_account_province = $this->session->userdata('account_province');
													if (!empty($sess_account_province)){
														$this->session->unset_userdata('account_province');
														$account_province = $sess_account_province;
													}
													?>
													
													<?php foreach($provinces as $k=>$v){ 
														$class = ($account_province == $v->province_id) ? 'selected' : '';
														?>
													<option value="<?php echo $v->province_id; ?>" <?php echo $class; ?>><?php echo ucwords($v->province_name); ?></option>
													<?php } ?>
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
											<div class="col-xs-12" id="account_kabupaten_container">
												<select name="account_kabupaten" id="account_kabupaten" class="custom-select light-select select-city">
													<option value="0">Select Kabupaten</option>
													
													<?php 
													$account_kabupaten = (!empty($this->access->member_account->kabupaten_id)) ? $this->access->member_account->kabupaten_id : '';
													$sess_account_kabupaten = $this->session->userdata('account_kabupaten');
													if (!empty($sess_account_kabupaten)){
														$this->session->unset_userdata('account_kabupaten');
														$account_kabupaten = $sess_account_kabupaten;
													}
													?>
													
													<?php foreach($kabupatens as $k=>$v){ 
														$class = ($account_kabupaten == $v->city_id) ? 'selected' : '';
														?>
													<option value="<?php echo $v->city_id; ?>" <?php echo $class; ?>><?php echo ucwords($v->city_name); ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="clearfix row-divider"></div>
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="account_kecamatan">Kecamatan <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12" id="account_kecamatan_container">
												
												<select name="account_kecamatan" id="account_kecamatan" class="custom-select light-select select-city">
													<option value="0">Select Kecamatan</option>
													
													<?php 
													$account_kecamatan = (!empty($this->access->member_account->kecamatan_id)) ? $this->access->member_account->kecamatan_id : '';
													$sess_account_kecamatan = $this->session->userdata('account_kecamatan');
													if (!empty($sess_account_kecamatan)){
														$this->session->unset_userdata('account_kecamatan');
														$account_kecamatan = $sess_account_kecamatan;
													}
													?>
													
													<?php foreach($kecamatans as $k=>$v){ 
														$class = ($account_kecamatan == $v->kecamatan_id) ? 'selected' : '';
														?>
													<option value="<?php echo $v->kecamatan_id; ?>" <?php echo $class; ?>><?php echo ucwords($v->kecamatan_name); ?></option>
													<?php } ?>
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
											<div class="col-xs-12" id="account_kelurahan_container">
												<select name="account_kelurahan" id="account_kelurahan" class="custom-select light-select select-city">
 													<option value="0">Select Kelurahan</option>
 													
 													<?php 
													$account_kelurahan = (!empty($this->access->member_account->kelurahan_id)) ? $this->access->member_account->kelurahan_id : '';
													$sess_account_kelurahan = $this->session->userdata('account_kelurahan');
													if (!empty($sess_account_kelurahan)){
														$this->session->unset_userdata('account_kelurahan');
														$account_kelurahan = $sess_account_kelurahan;
													}
													?>
 													
 													<?php foreach($kelurahans as $k=>$v){ 
														$class = ($account_kelurahan == $v->kelurahan_id) ? 'selected' : '';
														?>
													<option value="<?php echo $v->kelurahan_id; ?>" <?php echo $class; ?>><?php echo ucwords($v->kelurahan_name); ?></option>
													<?php } ?>
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
										
										<?php 
										
										$gender = (!empty($this->access->member_account->gender)) ? $this->access->member_account->gender : '';
										$sess_gender = $this->session->userdata('gender');
										if (!empty($sess_gender)){
											$this->session->unset_userdata('gender');
											$gender = $sess_gender;
										}
										
										$genders = array(
											'male' => 'Male',
											'female' => 'Female'
										);
										$c = 0;
										foreach($genders as $k=>$v){
											$class = ($k == $gender) ? 'checked' : '';
											if (empty($gender) && $c == 0){
												$class = 'checked';
											}
											$c++;
										?>
										
										<input type="radio" class="custom-checkgrey" value="<?php echo $k; ?>" name="gender" data-label="<?php echo ucwords($v); ?>" <?php echo $class; ?>  />
										
										<?php 
										}
										?>
									</div>
								</div>
								
								<div class="clearfix row-divider"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-dob">Date of Birth <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										
										/*
										
										$birthday = (!empty($this->access->member_account->birthday)) ? $this->access->member_account->birthday : ''; 
										$sess_birthday = $this->session->userdata('account_birthday');
										if (!empty($sess_birthday)){
											$this->session->unset_userdata('account_birthday');
											$birthday = $sess_birthday;
										}
										
										$birthday_html = "";
										if (!empty($birthday)) $birthday_html = date('d M Y', strtotime($birthday));
										?>
										<input class="form-control form-light datepicker" placeholder="" type="text" name="birthday" value="<?php echo $birthday_html; ?>" autocomplete="none" />
										 */ ?>
										 
										 <?php 
										 	$birthday = (!empty($this->access->member_account->birthday)) ? $this->access->member_account->birthday : ''; 
											$sess_birthday = $this->session->userdata('account_birthday');
											if (!empty($sess_birthday)){
												$this->session->unset_userdata('account_birthday');
												$birthday = $sess_birthday;
											}
											
											$birthday_html = "";
											if (!empty($birthday)) $birthday_html = date('Y-m-d', strtotime($birthday));
										 ?>
										 
										 <div class="picker" id="picker1" data-date="<?php echo $birthday_html; ?>"></div>
										  
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-phone">Mobile Phone <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										$account_phone = (!empty($this->access->member_account->phone_number)) ? $this->access->member_account->phone_number : '';
										$sess_account_phone = $this->session->userdata('account_phone');
										if (!empty($sess_account_phone)){
											$this->session->unset_userdata('account_phone');
											$account_phone = $sess_account_phone;
										}
										?>
										<input type="text" name="account_phone" placeholder="" class="form-control form-light" value="<?php echo $account_phone; ?>" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="user-id">Identity Card Number <span class="req">*</span></label>
									</div>
									<div class="form-group">
										
										<?php 
										$account_idcard = (!empty($this->access->member_account->card_number)) ? $this->access->member_account->card_number : '';
										$sess_account_idcard = $this->session->userdata('account_idcard');
										if (!empty($sess_account_idcard)){
											$this->session->unset_userdata('account_idcard');
											$account_idcard = $sess_account_idcard;
										}
										?>
										
										<input type="text" name="user_idcard" placeholder="" value="<?php echo $account_idcard; ?>" class="form-control form-light" />
										<p id="help-block-id" class="help-block"><i class="icon-attention"></i> Please ensure your identity card number is correct to confirm your background when you claim the prize you win. You may enter student card number if identity card number is not available.</p>
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-address">Address (optional)</label>
									</div>
									<div class="form-group">
										
										<?php 
										$account_address = (!empty($this->access->member_account->address)) ? $this->access->member_account->address : '';
										$sess_account_address = $this->session->userdata('account_address');
										if (!empty($sess_account_address)){
											$this->session->unset_userdata('account_address');
											$account_address = $sess_account_address;
										}
										?>
										
										<textarea name="account_address" class="form-control form-light" rows="5"><?php echo $account_address; ?></textarea>
									</div>
								</div>

								<div class="col-xs-7">
									<p class="help-block"><strong>Note:</strong> <em>We ensure none of your personal information will be given to the third party for any use.</em></p>
								</div>

								<div class="col-xs-5">
									<div class="form-submit">
										<input type="submit" class="btn btn-big btn-mt btn-green pull-right" name="save_changes" value="Save Changes" />
									</div>
								</div>
							</div>
						</div>
					</form>
					
					<?php }else if ($this->access->member_account->account_type == "business"){ 
						
						/*
						echo '<pre>';
						print_r($this->access->business_account);
						echo '</pre>';
						*/
						
						?>
					
					<form class="form-activorm" action="<?php echo base_url() . 'settings/save_settingsbusiness_contact'; ?>" method="post" enctype="multipart/form-data">
						<div class="box">
							<div class="row">
								<div class="col-sm-7">
									
									<?php 
									$account_name = (!empty($this->access->member_account->account_name)) ? $this->access->member_account->account_name : '';
									$sess_account_name = $this->session->userdata('account_name');
									if (!empty($sess_account_name)){
										$this->session->unset_userdata('account_name');
										$account_name = $sess_account_name;
									}
									
									$account_email = (!empty($this->access->member_account->account_email)) ? $this->access->member_account->account_email : '';
									$sess_account_email = $this->session->userdata('account_email');
									if (!empty($sess_account_email)){
										$this->session->unset_userdata('account_email');
										$account_email = $sess_account_email;
									}
									?>
									
									<h2 class="acc-input account-title"><span><?php echo ucwords( $account_name ); ?></span> <a href="#"><i class="icon-pencil" data-edit="title"></i></a></h2>
									<div class="acc-input account-email"><span><?php echo ucwords( $account_email ); ?></span> <a href="#"><i class="icon-pencil" data-edit="email"></i></a></div>
									
									<input type="hidden" name="account_title" id="account_title" value="<?php echo $account_name; ?>" />
									<input type="hidden" name="account_email" id="account_email" value="<?php echo $account_email; ?>" />

									<div class="form-group file-upload">
										<input type="file" name="account_avatar" class="real-file" style="display:none;" />
										<div class="row">
											<div class="col-xs-8">
											<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" />
											</div>
											<div class="col-xs-4">
												<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
											</div>
											
											<div class="clearfix"></div>
											<p class="help-block" style="margin-left:20px;"><strong>Tips:</strong> <em>Image must be <strong>jpg/jpeg, gif, or png</strong> smaller than <strong>2 MB</strong>, dimension are limeted to <strong>200x200</strong> pixels image larger than this will be resized.</em></p>
										
										</div>
									</div>
								</div>

								<div class="col-sm-5">
									<div class="account-avatar">
										
										<?php 
										
										$account_primary_photo = (!empty($this->access->member_account->account_primary_photo)) ? $this->access->member_account->account_primary_photo : '';
										$sess_account_primary_photo = $this->session->userdata('account_primary_photo');
										if (!empty($sess_account_primary_photo)){
											$this->session->unset_userdata('account_primary_photo');
											$account_primary_photo = $sess_account_primary_photo;
										}
										
										$photo = (empty($account_primary_photo)) ? 'img/company-avatar.gif' : $this->access->member_account->account_primary_photo;
										$photo = $this->mediamanager->getPhotoUrl($photo, "137x137");
										?>
										
										<img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo ucwords( $account_name ); ?>" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-contact">Contact Person <span class="req">*</span></label>
									</div>
									<div class="form-group">
										
										<?php 										
										$contact_person = (!empty($this->access->business_account->contact_person)) ? $this->access->business_account->contact_person : '';
										$sess_contact_person = $this->session->userdata('contact_person');
										if (!empty($sess_contact_person)){
											$this->session->unset_userdata('contact_person');
											$contact_person = $sess_contact_person;
										}
										?>
										
										<input type="text" name="account_contact" placeholder="" value="<?php echo $contact_person; ?>" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-position">Position in the Company <span class="req">*</span></label>
									</div>
									<div class="form-group">
										
										<?php 
										$position_inthe_company = (!empty($this->access->business_account->position_inthe_company)) ? $this->access->business_account->position_inthe_company : '';
										$sess_position_inthe_company = $this->session->userdata('position_inthe_company');
										if (!empty($sess_position_inthe_company)){
											$this->session->unset_userdata('position_inthe_company');
											$position_inthe_company = $sess_position_inthe_company;
										}
										?>
										
										<input type="text" name="account_position" placeholder="" value="<?php echo $position_inthe_company; ?>" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-number">Contact Number <span class="req">*</span></label>
									</div>
									<div class="form-group">
										
										<?php 
										$contact_number = (!empty($this->access->business_account->contact_number)) ? $this->access->business_account->contact_number : '';
										$sess_contact_number = $this->session->userdata('contact_number');
										if (!empty($sess_contact_number)){
											$this->session->unset_userdata('contact_number');
											$contact_number = $sess_contact_number;
										}
										?>
										
										<input type="text" name="account_number" placeholder="" value="<?php echo $contact_number; ?>" class="form-control form-light" />
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-number">Website </label>
									</div>
									<div class="form-group">
										
										<?php 
										$website = (!empty($this->access->business_account->website)) ? $this->access->business_account->website : '';
										$sess_website = $this->session->userdata('website');
										if (!empty($sess_website)){
											$this->session->unset_userdata('website');
											$website = $sess_website;
										}
										?>
										
										<input type="text" name="website" placeholder="" value="<?php echo (empty($website)) ? "http://" : $website; ?>" class="form-control form-light" />
										<p class="help-block"><strong>Example:</strong> <i><?php echo base_url(); ?></i></p>
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-description">Business Description <span class="req">*</span></label>
									</div>
									<div class="form-group">
										
										<?php 
										$business_description = (!empty($this->access->business_account->business_description)) ? $this->access->business_account->business_description : '';
										$sess_business_description = $this->session->userdata('business_description');
										if (!empty($sess_business_description)){
											$this->session->unset_userdata('business_description');
											$business_description = $sess_business_description;
										}
										?>
										
										<textarea name="account_description" class="form-control form-light" rows="5"><?php echo $business_description; ?></textarea>
									</div>
								</div>

								<div class="row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-address">Business Billing Address <span class="req">*</span></label>
									</div>
									<div class="form-group">
										
										<?php 
										$business_billing_address = (!empty($this->access->business_account->business_billing_address)) ? $this->access->business_account->business_billing_address : '';
										$sess_business_billing_address = $this->session->userdata('business_billing_address');
										if (!empty($sess_business_billing_address)){
											$this->session->unset_userdata('business_billing_address');
											$business_billing_address = $sess_business_billing_address;
										}
										?>
										
										<textarea name="account_address" class="form-control form-light" rows="5"><?php echo $business_billing_address; ?></textarea>
									</div>
								</div>
								
								<div class="row-divider"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-location">Province <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<select name="account_province" id="account_province" class="custom-select light-select select-city">
													<option value="0">Select Province</option>
													
													<?php 
													$account_province = (!empty($this->access->member_account->province_id)) ? $this->access->member_account->province_id : '';
													$sess_account_province = $this->session->userdata('account_province');
													if (!empty($sess_account_province)){
														$this->session->unset_userdata('account_province');
														$account_province = $sess_account_province;
													}
													?>
													
													<?php foreach($provinces as $k=>$v){ 
														$class = ($account_province == $v->province_id) ? 'selected' : '';
														?>
													<option value="<?php echo $v->province_id; ?>" <?php echo $class; ?>><?php echo ucwords($v->province_name); ?></option>
													<?php } ?>
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
											<div class="col-xs-12" id="account_kabupaten_container">
												<select name="account_kabupaten" id="account_kabupaten" class="custom-select light-select select-city">
													<option value="0">Select Kabupaten</option>
													
													<?php 
													$account_kabupaten = (!empty($this->access->member_account->kabupaten_id)) ? $this->access->member_account->kabupaten_id : '';
													$sess_account_kabupaten = $this->session->userdata('account_kabupaten');
													if (!empty($sess_account_kabupaten)){
														$this->session->unset_userdata('account_kabupaten');
														$account_kabupaten = $sess_account_kabupaten;
													}
													?>
													
													<?php foreach($kabupatens as $k=>$v){ 
														$class = ($account_kabupaten == $v->city_id) ? 'selected' : '';
														?>
													<option value="<?php echo $v->city_id; ?>" <?php echo $class; ?>><?php echo ucwords($v->city_name); ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								
								<div class="clearfix row-divider"></div>
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="account_kecamatan">Kecamatan <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12" id="account_kecamatan_container">
												<select name="account_kecamatan" id="account_kecamatan" class="custom-select light-select select-city">
													<option value="0">Select Kecamatan</option>
													
													<?php 
													$account_kecamatan = (!empty($this->access->member_account->kecamatan_id)) ? $this->access->member_account->kecamatan_id : '';
													$sess_account_kecamatan = $this->session->userdata('account_kecamatan');
													if (!empty($sess_account_kecamatan)){
														$this->session->unset_userdata('account_kecamatan');
														$account_kecamatan = $sess_account_kecamatan;
													}
													?>
													
													<?php foreach($kecamatans as $k=>$v){ 
														$class = ($account_kecamatan == $v->kecamatan_id) ? 'selected' : '';
														?>
													<option value="<?php echo $v->kecamatan_id; ?>" <?php echo $class; ?>><?php echo ucwords($v->kecamatan_name); ?></option>
													<?php } ?>
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
											<div class="col-xs-12" id="account_kelurahan_container">
												<select name="account_kelurahan" id="account_kelurahan" class="custom-select light-select select-city">
 													<option value="0">Select Kelurahan</option>
 													
 													<?php 
													$account_kelurahan = (!empty($this->access->member_account->kelurahan_id)) ? $this->access->member_account->kelurahan_id : '';
													$sess_account_kelurahan = $this->session->userdata('account_kelurahan');
													if (!empty($sess_account_kelurahan)){
														$this->session->unset_userdata('account_kelurahan');
														$account_kelurahan = $sess_account_kelurahan;
													}
													?>
 													
 													<?php foreach($kelurahans as $k=>$v){ 
														$class = ($account_kelurahan == $v->kelurahan_id) ? 'selected' : '';
														?>
													<option value="<?php echo $v->kelurahan_id; ?>" <?php echo $class; ?>><?php echo ucwords($v->kelurahan_name); ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-need">Business Needs (optional)</label>
									</div>
									<div class="form-group">
										
										<?php 
										$business_needs = (!empty($this->access->business_account->business_needs)) ? $this->access->business_account->business_needs : '';
										$sess_business_needs = $this->session->userdata('business_needs');
										if (!empty($sess_business_needs)){
											$this->session->unset_userdata('business_needs');
											$business_needs = $sess_business_needs;
										}
										?>
										
										<textarea name="account_need" class="form-control form-light" rows="5"><?php echo $business_needs; ?></textarea>
									</div>
								</div>

								<div class="col-sm-7">
									<p class="help-block"><strong>Note:</strong> <em>We ensure none of your personal information will be given to the third party for any use.</em></p>
								</div>

								<div class="col-sm-5">
									<div class="form-submit">
										<input type="submit" name="save_changes" value="Save Changes" class="btn btn-big btn-mt btn-green pull-right" />
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