<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Create Project</h1>
				<span class="page-subtitle">Fill in the form and complete it.</span>
				<div class="clearfix"></div>
			</div>
			
			<?php 
			$message_create_project_error = $this->session->userdata('message_create_project_error');
			if (!empty($message_create_project_error)){
				$message_create_project_error = '<li>' . implode('</li><li>', $message_create_project_error) . '</li>';
				$this->session->unset_userdata('message_create_project_error');
			?>
			<div class="alert alert-danger"><?php echo $message_create_project_error; ?></div>
			<?php } ?>
			
			<?php 
			$message_create_project_success = $this->session->userdata('message_create_project_success');
			if (!empty($message_create_project_success)){
				$this->session->unset_userdata('message_create_project_success');
			?>
			<div class="alert alert-success"><?php echo $message_create_project_success; ?></div>
			<?php
			}
			?>

			<form action="<?php echo base_url(); ?>project/submit_createproject" method="post" enctype="multipart/form-data">
				<div id="step-1" class="box step">
					<h2 class="step-title">Step 1: <span class="green">Add Project Title</span></h2>

					<div class="form-group">
						<?php 
						$project_name = $this->session->userdata('project_name');
						$this->session->unset_userdata('project_name');					
						if (empty($project_name) && !empty($this->project)){
							$project_name = $this->project->project_name;
						}	
						?>
						<input type="text" name="project_name" placeholder="e.g. Win a Gift Voucher 250K from Activorm" class="form-control form-light limiter" maxlength="60" value="<?php echo $project_name; ?>" />
						<div class="counter pull-right">
							<strong><span></span> characters</strong>
						</div>
						<p class="help-block"><strong>Tips:</strong> <em>try to make a short title so it will be easier to be shared.</em> Minimum 5 characters.</p>
					</div>
				<!-- #step-1 --></div>

				<div id="step-2" class="box step">
					<h2 class="step-title">Step 2: <span class="green">Upload Project Image</span></h2>

					<div class="row">
						
						<?php if (!empty($this->project)){ 
							$photo = $this->project->project_primary_photo;
							$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
							?>
						<div class="col-sm-4">
							<div class="project-thumbnail">
								<img src="<?php echo cdn_url() . $photo; ?>" alt="photo" width="260" />
							</div>
						</div>
						<?php } ?>
						

						<div class="col-sm-8">
							<div class="form-group file-upload" style="margin:0;">
								
								<div class="row">
									<div class="col-xs-5">
										<?php /*
										<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" /> */ ?>
										
										<input type="file" name="project_photo" class="real-file" />
										
									</div>
									
									<?php /*
									<div class="col-xs-3">
										<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
									</div> */ ?>
								</div>

								<p class="help-block"><strong>Tips:</strong> <em>Project image could be your logo or other image that will boost this project exposure must be <strong>jpg/jpeg, gif, or png</strong> smaller than <strong>2 MB</strong>, dimension are limited to <strong>200x200 pixels</strong> image larger than this will be resized.</em></p>
							</div>
						</div>
					</div>
				<!-- #step-2 --></div>

				<div id="step-3" class="box step">
					<h2 class="step-title">Step 3: <span class="green">Set Period</span></h2>

					<div class="row slider-progress">
						<div class="col-sm-6">
							<span class="slider-label label-left">7 d</span>
							<span class="slider-label label-right">30 d</span>

							<?php 
							$project_period = $this->session->userdata('project_period');
							$this->session->unset_userdata('project_period');
							
							if (empty($project_period) && !empty($this->project)){
								$project_period = $this->project->project_period;
								$project_period = strtotime($project_period);
								$project_now = strtotime($this->project->project_posted);
								$project_period = $project_period - $project_now;
								$project_period = date('j', $project_period) - 1;
							}
							
							$project_period = (empty($project_period)) ? 20 : $project_period;
							?>

							<input name="project_period" id="project-period" data-slider-id="slider-period" type="text" data-slider-min="7" data-slider-max="30" data-slider-step="1" data-slider-value="<?php echo $project_period; ?>" value="<?php echo $project_period; ?>" />
							<p class="help-block"><strong>Tips:</strong> <em>your project may valid for maximum 30 days</em></p>

							<div class="slider-start"></div>
						</div>
					</div>
				<!-- #step-3 --></div>

				<div id="step-4" class="box step">
					<h2 class="step-title">Step 4: <span class="green">Describe Prize</span></h2>

					<div class="row">
						<div class="col-sm-9">
							<div class="form-group">
								<?php 
								$project_prize = $this->session->userdata('project_prize');
								$this->session->unset_userdata('project_prize');
								
								if (empty($project_prize) && !empty($this->project)){
									$project_prize = $this->project->project_prize_detail;
								}
								
								?>
								<input type="text" name="project_prize" placeholder="e.g. MAP Gift Voucher 250K" class="form-control form-light" value="<?php echo $project_prize; ?>" />
								<p class="help-block"><strong>Example:</strong> Minimum 5 characters.</p>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								
								<?php 
								$prize_category_cols = array(
									'gadget' => 'Gadget',
									'voucher-discounts' => 'Voucher & Discounts',
									'event_tickets' => 'Event Tickets',
									'promotional_items' => 'Promotional Items',
									'cash' => 'Cash',
									'other' => 'Other'
								);
								
								$prize_category = $this->session->userdata('prize_category');
								$this->session->unset_userdata('prize_category');
								
								if (empty($prize_category) && !empty($this->project)){
									$prize_category = $this->project->project_prize_category;
								}
								
								?>
								
								<select name="prize_category" class="custom-select light-select select-category">
									<?php 
									foreach($prize_category_cols as $k=>$v){
										$class = ($k == $prize_category) ? 'selected' : '';
									?>
									<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo ucwords($v); ?></option>
									<?php
									}
									?>
								</select>
								<div class="clearfix"></div>
								<p class="help-block"><em>Select prize category</em></p>
							</div>
						</div>
					</div>
				<!-- #step-4 --></div>

				<div id="step-5" class="box step">
					<h2 class="step-title">Step 5: <span class="green">Select 3 Actions</span></h2>
					<p class="step-subtitle">Select 3 actions that have to be followed by your fans to join this project. You have to connect your social media at <a href="<?php echo base_url(); ?>settings/socialmedia" target="_blank"><b>Settings</b></a></p>

					<div class="action-steps">
						<ul class="row pick-0">
							<li class="col-sm-4" id="step1">
								<div class="step-no">1.</div>
								<div class="step-ico"><span class="ico-ready"></span></div>
								<strong class="step-desc">Unknown</strong>
							</li>
							<li class="col-sm-4" id="step2">
								<div class="step-no">2.</div>
								<div class="step-ico"><span class="ico-ready"></span></div>
								<strong class="step-desc">Unknown</strong>
							</li>
							<li class="col-sm-4" id="step3">
								<div class="step-no">3.</div>
								<div class="step-ico"><span class="ico-ready"></span></div>
								<strong class="step-desc">Unknown</strong>
							</li>
						</ul>
					<!-- .action-steps --></div>

					<div class="action-select">
						<ul class="list-unstyled" id="actions-click">
							
							<?php 
							$actiondata = array(
								'facebook' => array(
									'facebook-like' => array(
										'value' => 'facebook-like',
										'name' => 'actions_step[facebook-like]',
										'label' => 'Like Facebook Page',
										'icon' => 'actions-facebook-like-fb'
									),
									'facebook-send' => array(
										'value' => 'facebook-send',
										'name' => 'actions_step[facebook-send]',
										'label' => 'Send Content to Friend',
										'icon' => 'actions-facebook-send-content-friend'
									)
								),
								'twitter' => array(
									'twitter-tweet' => array(
										'value' => 'twitter-tweet',
										'name' => 'actions_step[twitter-tweet]',
										'label' => 'Tweet Something',
										'icon' => 'actions-twitter-tweet'
									),
									'twitter-follow' => array(
										'value' => 'twitter-tweet',
										'name' => 'actions_step[twitter-follow]',
										'label' => 'Follow @ {brand name}',
										'icon' => 'actions-twitter-follow-account'
									),
									'twitter-hashtag' => array(
										'value' => 'twitter-hashtag',
										'name' => 'actions_step[twitter-hashtag]',
										'label' => 'Tweet #hashtag',
										'icon' => 'actions-twitter-tweet-hashtag'
									)
								)
							);
							
							//$project_actions_data_arr_session = $this->session->userdata('session_project_actions_data');
							//if (!empty($project_actions_data_arr_session)){
							//	$this->session->unset_userdata('session_project_actions_data');
							//	$project_actions_data_arr = $project_actions_data_arr_session;
							//}
							
							/*
							$pvc = $this->session->userdata('pvc');
							$project_actions_data_arr_session = $this->scache->read('project#'. $pvc . '#');
							//print_r($project_actions_data_arr_session);
							if (!empty($project_actions_data_arr_session)){
								$this->scache->clear('project#'. $pvc . '#');
								$this->session->unset_userdata('pvc');
								$project_actions_data_arr = json_decode( $project_actions_data_arr_session );
							}*/
														
							foreach($actiondata as $k=>$v){
							?>
							
							<li class="select-<?php echo $k; ?>">
								<i class="icon-<?php echo $k; ?>"></i>
								<div class="row">
									
									<?php foreach($v as $a=>$b){ 
										
										//if (!empty($project_actions_data_arr[$a]) && !empty($project_actions_data_arr[$a]->custom_actions)) continue;
										
										$checked = (array_key_exists($a, $project_actions_data_arr)) ? 'checked="checked"' : '';
										if (!empty($project_actions_data_arr[$a]) && !empty($project_actions_data_arr[$a]->custom_actions)){
											$checked = "";
										}
										
										?>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" <?php echo $checked; ?> class="custom-checkstep" value="<?php echo $b['value']; ?>" name="<?php echo $b['name']; ?>" data-label="<?php echo $b['label']; ?>" data-icon="<?php echo $b['icon']; ?>" />
											<?php if ($a == "twitter-hashtag"){ ?>
												
											<?php 
											$project_hashtags = $this->session->userdata('project_hashtags');
											$this->session->unset_userdata('project_hashtags');
											
											if (empty($project_hashtags) && !empty($this->project)){
												$project_hashtags = $this->project->project_hashtags;
											}
											
											?>	
												
											<div>#<input type="textbox" name="project_hashtags" class="form-control" id="project_hashtags" value="<?php echo $project_hashtags; ?>" style="width:96%;margin-top:5px;display:inline-block;" placeholder="Insert Hashtag" /></div>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
									
									<div class="clearfix"></div>
									
									<div style="width: 635px;margin: 0 15px;">
										<p style="line-height:18px;"><b>User Connect</b> : <code class="blue-code"><?php echo $actions_label_info[$k]; ?></code></p>
									</div>
									
									<br />
									
									<?php /*
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="facebook-follow" name="actions_step[facebook-follow]" data-label="Follow Facebook User" data-icon="actions-facebook-follow-fb-user" />
										</div>
									</div> */ ?>
									
									<?php /*
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="facebook-send" name="actions_step[facebook-send]" data-label="Send Content to Friend" data-icon="actions-facebook-send-content-friend" />
										</div>
									</div>*/ ?>
									
								</div>
							<!-- .select-facebook --></li>
							
							<?php 
							}
							?>

							<?php /*
							<li class="select-twitter">
								<i class="icon-twitter"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="twitter-tweet" name="actions_step[twitter-tweet]" data-label="Tweet Something" data-icon="actions-twitter-tweet" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="twitter-follow" name="actions_step[twitter-follow]" data-label="Follow @ ..." data-icon="actions-twitter-follow-account" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="twitter-hashtag" name="actions_step[twitter-hashtag]" data-label="Tweet #hashtag ..." data-icon="actions-twitter-tweet-hashtag" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="twitter-to" name="actions_step[twitter-to]" data-label="Tweet to @ ..." data-icon="actions-twet-to" />
										</div>
									</div>
								</div>
							<!-- .select-twitter --></li>
							 */ ?> 

							<?php /***

							<li class="select-tumblr">
								<i class="icon-tumblr"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="tumblr-follow" name="action-tumblr" data-label="Follow Blog" data-icon="action-tb-follow" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="tumblr-share" name="action-tumblr" data-label="Share Blog Content" data-icon="action-tb-share" />
										</div>
									</div>
								</div>
							<!-- .select-tumblr --></li>

							<li class="select-foursquare">
								<i class="icon-foursquare"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="foursquare-like" name="action-foursquare" data-label="Like a Venue" data-icon="action-fs-like" />
										</div>
									</div>
								</div>
							<!-- .select-foursquare --></li>

							<li class="select-pinterest">
								<i class="icon-pinterest"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="pinterest-pin" name="action-pinterest" data-label="Pin an Image" data-icon="action-pn-pin" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="pinterest-follow" name="action-pinterest" data-label="Follow Pinterest User" data-icon="action-pn-follow" />
										</div>
									</div>
								</div>
							<!-- .select-pinterest --></li>

							<li class="select-instagram">
								<i class="icon-instagram"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="instagram-follow" name="action-instagram" data-label="Follow Instagram User" data-icon="action-ig-follow" />
										</div>
									</div>
								</div>
							<!-- .select-instagram --></li>

							<li class="select-gplus">
								<i class="icon-gplus"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="gplus-follow" name="action-gplus" data-label="Follow Google+ Account" data-icon="action-gp-follow" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="gplus-plus" name="action-gplus" data-label="+1 for Post" data-icon="action-gp-plus" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="gplus-share" name="action-gplus" data-label="Share Content Circle" data-icon="action-gp-share" />
										</div>
									</div>
								</div>
							<!-- .select-gplus --></li>

							<li class="select-youtube">
								<i class="icon-youtube"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="youtube-subscribe" name="action-youtube" data-label="Subscribe to Channel" data-icon="action-yt-subscribe" />
										</div>
									</div>
								</div>
							<!-- .select-youtube --></li>
							 * 
							 * 
							 */
							
							?>
							 
							<?php /* 
							<li class="select-email">
								<i class="icon-email"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="email-send" name="actions_step[email-send]" data-label="Send an Email" data-icon="actions-email-send-email" />
										</div>
									</div>
								</div>
							<!-- .select-email --></li>
							 */ ?> 
						</ul>
					<!-- .action-select --></div>
				<!-- #step-5 --></div>

				<div id="step-6" class="box step">
					<h2 class="step-title">Step 6: <span class="green">Terms & Condition</span></h2>

					<div class="row">
						<div class="col-sm-9">
							<div class="form-group">
								<?php 
								$project_description = $this->session->userdata('project_description');
								$this->session->unset_userdata('project_description');
								
								if (empty($project_description) && !empty($this->project)){
									$project_description = $this->project->project_description;
								}
								
								?>
								<textarea name="project_description" placeholder="e.g. This gift voucher valids until 01 January 2014. You may use this gift voucher at Pondok Indah Mall, etc. Terms & Conditions apply." class="form-control form-light description_limiter" id="description_limiter" rows="5"><?php echo $project_description; ?></textarea>
								<p class="help-block" id="counter_description"><span>500</span> characters</p>
							</div>
						</div>

						<div id="tags" class="col-sm-3">
							<div class="form-group">
								<p class="help-block"><em>Use comma to separate tags</em></p>
								<?php 
								$project_tags = $this->session->userdata('project_tags');
								$this->session->unset_userdata('project_tags');
								
								if (empty($project_tags) && !empty($this->project)){
									$project_tags = $this->project->project_tags;
								}
								
								?>
								<input type="text" name="project_tags" placeholder="" class="form-control form-light" value="<?php echo $project_tags; ?>" />
							</div>
						</div>
							
						<?php /*						
						<div id="hashtags" class="col-sm-3" style="margin-top:20px;">
							<div class="form-group">
								<p class="help-block"><em>Use comma to separate #HashTags (Maximum 3)</em></p>
								<?php 
								$project_hashtags = $this->session->userdata('project_hashtags');
								$this->session->unset_userdata('project_hashtags');
								
								if (empty($project_hashtags) && !empty($this->project)){
									$project_hashtags = $this->project->project_hashtags;
								}
								
								?>
								<input type="text" name="project_hashtags" placeholder="" class="form-control form-light" value="<?php echo $project_hashtags; ?>" />
							</div>
						</div> */ ?>
						
					</div>
				<!-- #step-6 --></div>

				
				<div id="step-7" class="box step">
					
					
					<?php 
					if (PREMIUM_PLAN == 1){
					?>
					
					
					<h2 class="step-title">Additional Step:</h2>
					
					
					
					<div class="form-group">
						<?php 
						$checkupgrade = (!empty($this->project->premium_plan)) ? 'checked="checked"' : '';
						?>
						<input <?php echo $checkupgrade; ?> type="checkbox" class="custom-checkupgrade" value="upgrade_premium" name="step_upgrade" id="step_upgrade" data-label="Upgrade to Premium Plan" />
						<input type="hidden" name="step_upgrade_hash" value="<?php echo sha1('upgrade_premium' . SALT); ?>" />
					</div> 

					<div class="upgrade-divider"></div>

					
					<ul class="list-unstyled upgrade-options" id="upgrade-options">
						
						<?php 
						$social_format_data_checked = $social_format_data = '';
						if (!empty($this->project->social_format_data)){
							$social_format_data = json_decode( $this->project->social_format_data );
							$social_format_data_checked = '';
							if (property_exists($social_format_data, 'facebook_format') || (property_exists($social_format_data, 'twitter_format'))){
								if (!empty($social_format_data->facebook_format) || !empty($social_format_data->twitter_format)){
									$social_format_data_checked = 'checked="checked"';
								}
							}
						}
						?>
						
						<li>
							<div class="form-group">
								<input type="checkbox" <?php echo $social_format_data_checked; ?> class="custom-checkwhite" value="allow-share" name="option_share" data-label="Allow fans to share more about your business to get more tickets (max 3 tickets)" />
							</div>

							<div class="sub-options">
								<div class="form-label">
									<label for="facebook-format">Share Facebook Format (140 Character)</label>
								</div>
								<div class="form-group">
									<input type="text" name="facebook_format" placeholder="" class="form-control form-light" value="<?php echo (property_exists($social_format_data, 'facebook_format')) ? $social_format_data->facebook_format : ''; ?>" />
								</div>

								<div class="form-label">
									<label for="twitter-format">Share Twitter Format (120 Character)</label>
								</div>
								<div class="form-group">
									<input type="text" name="twitter_format" placeholder="" class="form-control form-light" value="<?php echo (property_exists($social_format_data, 'twitter_format')) ? $social_format_data->twitter_format : ''; ?>" />
								</div>
							</div>
						</li>

						<?php 
						$project_file_data_checked = $project_file_data = '';
						if (!empty($this->project->project_file_data)){
							$project_file_data = $this->project->project_file_data;
							$project_file_data_checked = 'checked="checked"';
						}
						?>
						<li>
							<div class="form-group">
								<input type="checkbox" <?php echo $project_file_data_checked; ?> class="custom-checkwhite" value="direct-tickets" name="option_tickets" data-label="Direct tickets/price for completed actions (e.g voucher images or ebook PDF)" />
								<?php if (!empty($project_file_data)){ ?><p style="margin-left:42px;">Your file/voucher : <a href="<?php echo cdn_url() . $project_file_data; ?>" target="_blank">Click here</p><?php } ?></a>
							</div>

							<div class="sub-options">
								<div class="form-group file-upload">
									<input type="file" name="attach_file" class="real-file" />
									
									<?php /*
									<div class="row">
										<div class="col-xs-4">
										<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" />
										</div>
										<div class="col-xs-3">
											<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
										</div>
									</div>  */ ?>
								</div>
							</div>
						</li>

					<!-- .upgrade-options --></ul>
					
					<?php } ?>

					<div class="clearfix form-submit" id="form-submit">
						<?php 
						$pid = (!empty($this->project) && !empty($this->project->project_id)) ? $this->project->project_id : 0;
						$hash = sha1($pid . SALT); 
						?>
						<input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>" />
						<input type="hidden" name="pid_hash" id="pid_hash" value="<?php echo $hash; ?>" />
						<input type="submit" class="btn btn-blue pull-right" value="Preview" name="preview-btn" />
						
						<?php /*
						<input type="submit" class="btn btn-green pull-right" value="Submit" name="submit-btn" id="submit-btn" />
						*/ ?>
						
						<?php /*
						<input type="submit" class="btn btn-green pull-right" value="Submit" name="submit-btn" id="submit-btn-create-f" style="display:none;" />
						<input type="button" class="btn btn-green pull-right" value="Submit" name="submit-btn-createproject" id="submit-btn-create-s" style="display:none;" />
						*/ ?>
						
						<input type="submit" class="btn btn-blue pull-right" value="Save Draft" name="save-draft" />
						
						<?php /*
						<input type="submit" class="btn btn-blue pull-right" value="Continue" name="premium-submit-draft" id="premium-submit-draft" 						
						style="display:none;" 	
						/>*/ ?>
						
					</div>
				<!-- #step-7 --></div>
				
			</form>

		<!-- #main --></div>
		

<?php $this->load->view('a/general/footer_view', $this->data); ?>