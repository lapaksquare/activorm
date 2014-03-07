<?php $this->load->view('a/general/header_view', $this->data); ?>
		
		<?php 
		$business_id = $this->session->userdata('business_id');
		$account_id = $this->session->userdata('account_id');
		if (!empty($this->access->business_account) && $business_id == $this->access->business_account->business_id && $this->project->project_live != "Online"){
		?>
		<div class="pop-warning">
			<p>Project ini dalam keadaan : <b><?php echo ucwords( $this->project->project_live ); ?></b></p>

			<p><?php if ($this->project->project_live == "Draft"){ ?><a href="<?php echo base_url(); ?>project/edit/<?php echo $this->project->project_uri; ?>" class="btn btn-wd btn-green">Edit</a>
				
				<?php //if ($this->project->premium_plan == 0){ ?>
					
				
				<?php if ($freeplan > 0 || $this->project->premium_plan == 1){ ?>	
					or 
				<a href="#" class="btn btn-wd btn-yellow" id="submit_project">Submit</a>
				<?php } ?>
			<?php } ?></p>
		</div>
		<?php } ?>

		<div id="main" class="container" style="padding-top:10px;">
			
			<div class="section-header">
				<div class="row">
					<div class="col-xs-12 section-title">
						<div class="section-nav">
							<a href="<?php echo base_url(); ?>">Home</a>
							<span>&gt;</span>
							<a href="<?php echo base_url(); ?>project/<?php echo $this->project->project_uri; ?>"><?php echo ucwords($this->project->project_name); ?></a>
							<span>&gt;</span>
							<span class="green">Project Details</span>
						<!-- .section-nav --></div>
					</div>
				</div>
			<!-- .section-header --></div>

			<?php 
			$message_project_actions_error = $this->session->userdata('message_project_actions_error');
			if (!empty($message_project_actions_error)){
				$this->session->unset_userdata('message_project_actions_error');
			?>
			<div class="alert alert-danger">
				<ul>
					<?php echo $message_project_actions_error; ?>
				</ul>
			</div>
			<?php } ?>
			
			<?php 
			$message_project_actions_success = $this->session->userdata('message_project_actions_success');
			if (!empty($message_project_actions_success)){
				$this->session->unset_userdata('message_project_actions_success');
			?>
			<div class="alert alert-success">
				<ul>
					<?php echo $message_project_actions_success; ?>
				</ul>
			</div>
			<?php } ?>

			<div class="row">
				<div id="content" class="col-md-9">
					<div class="box">
						
						<div class="row">
							<div class="col-xs-1">
								<div class="members-count"><strong><?php echo $jml_tiket; ?></strong><br /> Member<?php echo ($jml_tiket > 1) ? 's' : ''; ?></div>
							</div>

							<div class="col-sm-5 col-xs-11">
								<div class="entry-image">
									<?php 
									
									/*
									if (empty($project_prize)){
										$photo = 'img/bg-banner-blog.png';
									}else{
										$photo = $project_prize->prize_primary_photo;
										//$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
									}*/
									
									
									
									/*
									 * <img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->project->project_uri; ?>" />
									 * */
									?>
									
									
									<?php if (empty($this->project_photos) || (!empty($this->project_photos) && count($this->project_photos) == 1)){ 
							            		
										$photo = $this->project->project_primary_photo;
										$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
					            		
					            		?>
					                <img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->project->project_uri; ?>" />
					                <?php }else{  ?>
									
									<div class="slider-wrapper theme-light">
							            <div id="slider" class="nivoSlider">
							            	
							                <?php	
												foreach($this->project_photos as $k=>$v){
													
													$photo = $v->photo_file;
													$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
											?>
											
													<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->project->project_uri; ?>" />
											
											<?php
													
												}	
							                ?>
							                	
							                
							            </div>
							        </div>
							        
							        <?php } ?>
									
								</div>
							</div>

							<div class="col-sm-6">
								<div class="clearfix entry-counter">
									
									<?php 
		        						$tiket_enddate = strtotime($this->project->project_period);
		        						$server_end = strtotime($this->project->project_period);
										$server_start = strtotime(date('Y-m-d H:i:s'));
		        						
										$project_period = strtotime($this->project->project_period);
										$project_now = strtotime(date('Y-m-d H:i:s'));
										//$period = $project_period - $project_now;
										//$period = date('d', $period); 
										
										$stoped = 0;
										//if ( ($server_start >= $server_end && $server_start <= $tiket_enddate) || $this->input->get_post('tiketstart') == 1 ){
										if (
											$project_period < $project_now || 
											in_array($this->project->project_live, array('Draft', 'Offline')) ||
											!empty($project_win_tiket)
										){	
											//redirect(base_url() . '404');
											if ($project_period < $project_now || !empty($project_win_tiket)) { $stoped = 1;
									?>
									
									<h4 class="project_details_h4">The Project has Ended</h4>		
									
									<div class="project-closed"></div>
									
									<?php }else{ ?>
									
									<h4 class="project_details_h4"><?php echo ucwords($this->project->project_name); ?>.</h4>
									
									<p>The Project has not been Started</p>
									
									<?php } ?>
									
									<div class="counter-num"><strong id="hari">00</strong> Days</div>
									<div class="counter-sep">:</div>
									<div class="counter-num"><strong id="jam">00</strong> Hours</div>
									<div class="counter-sep">:</div>
									<div class="counter-num"><strong id="menit">00</strong> Minutes</div>
									
									<?php		
											
										}else{
		        					?>
		        					
		        					<!--<h4 class="project_details_h4"><?php echo ucwords($this->project->project_name); ?></h4>-->
		        					
		        					<p style="color: #e82355;margin-bottom: 0;margin-top: 20px;font-weight: bold;font-size: 18px;">Time Remaining</p>
		        					
		        					<script type="text/javascript">
	        							var server_end = <?php echo $server_end * 1000; ?>;
	        							var server_start = <?php echo $server_start * 1000; ?>;
	        							var client = new Date().getTime();
	        							var end = server_end - server_start + client;
	        							var _second = 1000;
	        							var _minute = _second * 60;
	        							var _hour = _minute * 60;
	        							var _day = _hour * 24;
	        							var timer;
	        							function showCountdown(){
	        								var now = new Date();
	        								var distance = end - now;
	        								if (distance < 0){
	        									clearInterval(showCountdown);
	        									window.location = window.location;
	        									//document.getElementById('countdown_container').style.display = "none";
	        								}
	        								var days = Math.floor(distance / _day);
	        								var hours = Math.floor( (distance % _day) / _hour );
	        								var total_hours = (days * 24) + hours;
	        								var minutes = Math.floor( (distance % _hour) / _minute );
	        								var seconds = Math.floor( (distance % _minute) / _second );
	        								
	        								var days_html = document.getElementById('hari');
	        								var hours_html = document.getElementById('jam');
	        								var menit_html = document.getElementById('menit');
	        								var detik_html = document.getElementById('detik');
	        								
	        								days_html.innerHTML = days;
	        								hours_html.innerHTML = hours;
	        								menit_html.innerHTML = minutes;
	        								//detik_html.innerHTML = seconds;
	        							}
	        							timer = setInterval(showCountdown, 10);
	        						</script>
										
									<div class="counter-num"><strong id="hari">00</strong> Days</div>
									<div class="counter-sep">:</div>
									<div class="counter-num"><strong id="jam">00</strong> Hours</div>
									<div class="counter-sep">:</div>
									<div class="counter-num"><strong id="menit">00</strong> Minutes</div>
									
									<?php 
										}
									?>
									
								<!-- .entry-counter --></div>
								
							</div>
						</div>
					</div>

					<div class="box entry-project" id="project-body">
						<div class="entry-header">
							<h1 class="entry-title"><?php echo ucwords($this->project->project_name); ?></h1>
							<span class="entry-meta">Posted on <?php echo date('d M Y', strtotime($this->project->project_posted)); ?></span>
						<!-- .entry-header --></div>
						
						
						
					        	
					        	
					        				
						
						<?php
						
						if ($stoped == 0){
						
						$account_id = $this->session->userdata('account_id');
						if (empty($account_id)){
							
						?>
						
						<div class="wizard-project">
							<div class="wizard-step step-4">
								<h2>You should login first!</h2>
								<a class="btn btn-big btn-yellow" href="#" id="navbar-login-button">Log In</a>
								<?php /*
								<a class="btn btn-big btn-yellow" href="#">Download Voucher</a> */ ?>
							</div>
						<!-- .wizard-project --></div>
						
						<?php
							
						}else{
							
						?>
						
						
						<?php if ($this->access->member_account->register_step == 4){ ?>
						
						
						<div class="wizard-project">
							<div class="wizard-step step-4">
								<h2>Please complete your contact information</h2>
								<a class="btn btn-big btn-yellow" href="<?php echo base_url(); ?>settings/contact" id="navbar-settings">Settings</a>
								<?php /*
								<a class="btn btn-big btn-yellow" href="#">Download Voucher</a> */ ?>
							</div>
						<!-- .wizard-project --></div>
						
						
						<?php }else if (count($socialmedia_required) != $socialmedia_required_isok){ ?>
						<div class="wizard-project">
							<div class="wizard-step step-2">
								<h4>To join this project, you must first connect your social network account below.</h4>
								
								<ul class="row user-connect user-connect-project">
									<?php 
									//echo '<pre>';
									//print_r($socialmedia_required);
									//echo '</pre>';
									foreach($socialmedia_required as $k=>$v){
										
										if ($v['isok'] == 0){
									?>
									<li class="col-sm-4">
										<i class="icon-<?php echo $k; ?>"></i>
										<div>
											<?php echo ucwords($v['type_name']); ?><br />
											<a href="<?php echo $v['link_oauth']; ?>" class="btn btn-small btn-green">Connect</a>
										</div>
									</li>
									<?php 
										}
									} 
									?>
									<?php /*
									<li class="col-sm-4">
										<i class="icon-facebook"></i>
										<div>
											Facebook
											<span class="btn btn-small btn-wd btn-yellow">Connected</span>
										</div>
									</li>
									<li class="col-sm-4">
										<i class="icon-facebook"></i>
										<div>
											Facebook
											<span class="btn btn-small btn-wd btn-yellow">Connected</span>
										</div>
									</li>*/ ?>
									
								</ul>
								
							</div>
						</div>
						<?php }else{ ?>
						
						
						<?php // ================================================= // ?>
						
						<?php 
						$flag = 1;	
						$tutup_action = 0;					
						if (empty($project_actions) || ($project_actions['action_1'] == 0 && $project_actions['action_2'] == 0 && $project_actions['action_3'] == 0) ){
							
							$flag = 0;
							
							
							if ($jml_tiket_user < 3){
						?>

						<div class="wizard-project">
							<div class="wizard-step step-1">
								<h2>Click on <strong>Start</strong> button to grab the prize</h2>
								<a class="btn btn-big btn-wd btn-yellow" href="#" id="btn-start-action">Start</a>
							</div>
						<!-- .wizard-project --></div>
						
						<?php
						
							}else{
								
						?>
						
						<div class="wizard-project">
							<div class="wizard-step step-1">
								<h2>You may only join maximum 3 projects per day. <br /> Thank you</h2>
								<?php /*<a class="btn btn-big btn-wd btn-yellow" href="#" id="btn-start-action">Start</a>*/?>
							</div>
						<!-- .wizard-project --></div>	
						
						<?php		
								
								$tutup_action = 1;
								
							}
						
						}
						?>
						
						
						
						<?php	
						
						$jml_action_premium = 2;
						
						if ( ($project_actions['action_1'] == 1 && $project_actions['action_2'] == 1 && $project_actions['action_3'] == 1) ){
						?>
						
						<?php if ( ($project_actions['action_premium'] >= $jml_action_premium && $this->project->premium_plan == 1) || 
						($project_actions['action_1'] == 1 && $project_actions['action_2'] == 1 && $project_actions['action_3'] == 1 && $this->project->premium_plan == 0)
						){ ?>
							
							
							<?php 
							if (!empty($business_id)){
								
							
							?>
							
							
							<div class="wizard-project">
								<div class="wizard-step step-4">
									<h2>Sorry, You may only get the ticket as a user account</h2>
								</div>
							<!-- .wizard-project --></div>
							
							
							<?php	
								
								
							}else{
									
									
								//if (empty($this->project->project_file_data)){ 
							?>
							
							<div class="wizard-project">
								<div class="wizard-step step-4">
									<h2>Thank you for completing it!</h2>
									
									<a class="btn btn-big btn-yellow" href="<?php echo base_url(); ?>tickets">Check Your Ticket</a>
								</div>
							<!-- .wizard-project --></div>
							
							<?php /*}else{ ?>
							
							<div class="wizard-project">
								<div class="wizard-step step-4">
									<h2>Thank you for completing it</h2>
									<a class="btn btn-big btn-yellow" href="<?php echo base_url(); ?>download?h=<?php echo sha1($this->project->project_id.$account_id.SALT); ?>&p=<?php echo $this->project->project_id; ?>&a=<?php echo $account_id; ?>" target="_blank">Download Voucher</a>
								</div>
							<!-- .wizard-project --></div>	
									
							<?php } */
							
							
							}
							
							?>
							
						<?php }else{ ?>
						
						<?php 
						$social_format_data = $this->project->social_format_data;
						if (!empty($social_format_data)){
							$social_format_data = json_decode($social_format_data);
							$pid = $this->project->project_id;
						?>
						
						<div class="wizard-project">
							<div class="wizard-step step-3" style="height: 185px;padding-top: 40px;">
								<h2>More Tickets (max. 2 tickets)</h2>

								<div class="row" id="premium_action" style="margin-left:60px;margin-top:35px;">
									
									<?php if (property_exists($social_format_data, "facebook_format")){ 
										$sc = "facebook";
										$sc_hash = sha1($pid . $sc . SALT);
										?>
									<div class="col-sm-4" style="margin-right:30px;">
										<a class="btn btn-block btn-fb1" href="<?php echo base_url() . 'actions/premium?type=' . $sc . '&pid='. $pid .'&hash=' . $sc_hash; ?>"><i class="icon-facebook"></i> Share Status Facebook <?php if ($project_actions['action_premium_fb'] == 1){ ?><i class="check"></i><?php } ?></a>
									</div>
									<?php } ?>

									<?php if (property_exists($social_format_data, "twitter_format")){ 
										$sc = "twitter";
										$sc_hash = sha1($pid . $sc . SALT);
										?>
									<div class="col-sm-4">
										<a class="btn btn-block btn-tw1" href="<?php echo base_url() . 'actions/premium?type=' . $sc . '&pid='. $pid .'&hash=' . $sc_hash; ?>"><i class="icon-twitter"></i> Share Status Twitter <?php if ($project_actions['action_premium_tw'] == 1){ ?><i class="check"></i><?php } ?></a>
									</div>
									<?php } ?>

								</div>
							</div>
						<!-- .wizard-project --></div>
						<?php }else if (!empty($this->project->project_file_data)){
						?>
							<div class="wizard-project">
								<div class="wizard-step step-4">
									<h2>Thank you for completing it</h2>
									<a class="btn btn-big btn-yellow" href="<?php echo base_url(); ?>download?h=<?php echo sha1($this->project->project_id.$account_id.SALT); ?>&p=<?php echo $this->project->project_id; ?>&a=<?php echo $account_id; ?>" target="_blank">Download Voucher</a>
								</div>
							<!-- .wizard-project --></div>	
						<?php
						} else if (!empty($this->project->redeem_tiket_merchant)){
							
							if ($this->checkTiket->used_tiket == 0){
						?>	
						
							<div class="wizard-project">
								<div class="wizard-step step-4" style="padding-top: 29px;padding-bottom: 9px;">
									<h2>Thank You for completing the steps</h2>
									<a class="btn btn-big btn-yellow" id="redeem_prize_btn" href="#">Redeem Prize</a>
									<p style="line-height: 20px;margin-top: 30px;">This prize can be claimed for one time only once you click on “Redeem Prize.” <br />Please ask for assistance from merchant for prize claiming.</p>
								</div>
							<!-- .wizard-project --></div>	
							
							<?php $this->load->view('a/project/project_redeem_tiket_view', $this->data); ?>					
						
						<?php
						
							}else{
								
						?>
							
							<div class="wizard-project">
								<div class="wizard-step step-4" style="padding-top: 29px;padding-bottom: 33px;">
									<h2 style="line-height:28px;">Congratulations! You just redeemed a prize.<br />Check out other projects on Activorm!</h2>
									<a class="btn btn-big btn-yellow" href="<?php echo base_url(); ?>">Go to Homepage</a>
								</div>
							<!-- .wizard-project --></div>	
								
						<?php		
								
							}
						
						}else{
							
						
						?>
						
							<div class="wizard-project">
								<div class="wizard-step step-4">
									<h2>Thank you for completing it!</h2>
									
									<a class="btn btn-big btn-yellow" href="<?php echo base_url(); ?>tickets">Check Your Ticket</a>
								</div>
							<!-- .wizard-project -->
							</div>
						
						
						<?php	
							
							
						} ?>
						
						<?php } ?>
						
						<?php }else{ 
							
							
							
							if ($tutup_action == 0){
							
							
							?>
						
						<div class="wizard-project" <?php if ($flag == 0) { ?>style="display:none;"<?php } ?>>
							<div class="wizard-step step-2">
								
								<div class="overlay-wizard" id="overlay-wizard" style="display:none;">
																		
									<div class="overlay-box" id="overlay-box" style="display:none;">
										
										<?php 
										foreach($project_actions_data as $k=>$v){
											
											$key = 'action_' . ($k+1);
											$check_active = 0;
											if ($project_actions[$key] == 1){
												$check_active = 1;
											}
											
											if ($v->type_step == "facebook-like" && $check_active == 0){
										?>
										
										<div id="<?php echo $v->type_step; ?>-container" style="display:none;">
										
										<div class="overlay-header"><?php echo ucwords( $v->type_name ); ?></div>
										
										<div class="overlay-container <?php echo $v->type_step; ?>-container">
											<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo $v->id; ?>&amp;width=300&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=<?php echo FACEBOOK_APP_ID; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:62px;" allowTransparency="true"></iframe>
										</div>
										
										<div class="overlay-btn-container">
											<?php /*
											<a href="#" class="btn-c-blue overlay-btn-close" id="overlay-btn-close">Close</a>
											*/ ?>
											
											<?php 
											$url = array(
												'projectid' => $this->project->project_id,
												'hash' => sha1($this->project->project_id . SALT),
												'actions' => $k,
												'hashactions' => sha1($k . SALT)
											);
											$url = http_build_query($url);
											
											
											
											
											?>
											
											<a href="<?php echo base_url(); ?>actions/trigger_actions?<?php echo $url; ?>" class="btn-c-blue overlay-btn-continue" id="overlay-btn-continue">Continue</a>
										</div>
										
										</div>
										
										<?php 
											}
										}
										?>

									</div>
									
								</div>
												
								<?php 
								//echo '<pre>';print_r($project_actions_data);echo '</pre>';
								?>				
																
								<?php if ($flag == 0) { ?><button type="button" class="close" id="btn-action-close">&times;</button><?php } ?>

								<h2>Click on 3 Engagement-Action Buttons below</h2>
								
								<div class="action-steps" id="action-steps">
									<ul class="row">

										<?php 
										
										foreach($project_actions_data as $k=>$v){
											$class = "";
											$url_string = "#";
											
											$url = array(
												'projectid' => $this->project->project_id,
												'hash' => sha1($this->project->project_id . SALT),
												'actions' => $k,
												'hashactions' => sha1($k . SALT)
											);
											$url = http_build_query($url);
											
											if (!property_exists($v, "type_step")) continue;
											
											$type_step = $v->type_step;
											if (property_exists($v, "custom_actions") && !empty($v->custom_actions)){
												list($type_step, $type_step_key) = explode("_", $type_step);
											}
											
											switch($type_step){
												
												// facebok
												case "facebook-like" :
													$class = "actions-facebook-like-fb-small";
													break; 
												case "facebook-follow" :
													$class = "actions-facebook-follow-fb-user-small";
													$url_string = base_url() . 'actions/trigger_actions?' . $url;
													break; 
												case "facebook-send" :
													$class = "actions-facebook-send-content-friend-small";
													$url_string = base_url() . 'actions/trigger_actions?' . $url;
													break; 
													
												//twitter	
												case "twitter-tweet" :
													$class = "actions-twitter-tweet-small";
													$url_string = base_url() . 'actions/trigger_actions?' . $url;
													break; 
												case "twitter-follow" :
													$class = "actions-twitter-follow-account-small";
													$url_string = base_url() . 'actions/trigger_actions?' . $url;
													break; 
												case "twitter-hashtag" :
													$class = "actions-twitter-tweet-hashtag-small";
													$url_string = base_url() . 'actions/trigger_actions?' . $url;
													break; 
												case "twitter-to" :
													$class = "actions-twet-to-small";
													$url_string = base_url() . 'actions/trigger_actions?' . $url;
													break; 
											}
											// <span class="active"><i class="check"></i></span>
										?>
										
										<?php
										$key = 'action_' . ($k+1);
										$check_active = 0;
										if ($project_actions[$key] == 1){
											$check_active = 1;
										}
										
										$script = "";
										if ($business_id == $this->project->business_id ){
											$url_string = "#";
											$script = "onclick='return false;'";
										} 
										
										
										?>
										
										<li class="col-sm-4">
											<?php if ($check_active == 0){ ?>
											<a <?php echo $script; ?> href="<?php echo $url_string; ?>" data-id="<?php echo $v->type_step; ?>-container" <?php if ($script == ""){ ?>id="<?php echo $v->type_step; ?>-btn" <?php } ?>>
											<?php } ?>
												<div class="step-ico <?php echo $class; ?>">
													<span class="active">
														
														<?php if ($check_active == 1){ ?>
														<span class="active"><i class="check"></i></span>
														<?php } ?>
														
													</span>
												</div>
												<strong class="step-desc"><a href="#"><?php echo $v->type_name; ?></a></strong>
											<?php if ($check_active == 0){ ?>
											</a>
											<?php } ?>
										</li>
										<?php	
										} 
										?>
										
										<?php /*
										<li class="col-sm-4">
											<div class="step-ico actions-facebook-follow-fb-user-small">
												<span class="active"><i class="check"></i></span>
											</div>
											<strong class="step-desc"><a href="#">Like Facebook</a></strong>
										</li>
										<li class="col-sm-4">
											<div class="step-ico ico-tw-follow">
												<span class="active"><i class="check"></i></span>
											</div>
											<strong class="step-desc"><a href="#">Follow Twitter</a></strong>
										</li>
										<li class="col-sm-4">
											<div class="step-ico ico-fb-share">
												<span><a href="#">&nbsp;</a></span>
											</div>
											<strong class="step-desc"><a href="#">Post Facebook</a></strong>
										</li> */ ?>
									</ul>
								<!-- .action-steps --></div>
							</div>
						<!-- .wizard-project --></div>
						
						
						<?php // ================================================= // ?>
						
						<?php
								}
						 ?>
						
						
						<?php } 

								}


						
						}

						}
						
						if (!empty($project_win_tiket)){
							
							$wins = "";
							$count_wins = count($project_win_tiket);
							foreach($project_win_tiket as $k=>$v){
								if ($k > 0){
									if ($k != ($count_wins-1)) $wins .= ", ";
									else $wins .= " and ";	
								}
								$wins .= ucwords( $v->account_name );
							}
							
						?>
						
						<div class="wizard-project">
							<div class="wizard-step step-4">
								<h2>This project has been closed and <br />the winner is <b style="color:#f8ed31;"><?php echo $wins; ?></b>, Congratulations!</h2>
							</div>
						<!-- .wizard-project --></div>
						
						<?php	
							
						}
						
						?>
						
						
						
						
						

						<?php /*
						<div class="wizard-project">
							<div class="wizard-step step-3">
								<button type="button" class="close">&times;</button>
								<h2>More Tickets (max. 3 tickets)</h2>

								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<input type="text" name="tickets" placeholder="" class="form-control form-light" />
										</div>
									</div>

									<div class="col-sm-4">
										<a class="btn btn-block btn-tw" href="#"><i class="icon-twitter"></i> Share Status Twitter</a>
									</div>

									<div class="col-sm-5">
										<a class="btn btn-block btn-fb" href="#"><i class="icon-facebook"></i> Share Status Facebook</a>
									</div>

									<div class="col-sm-3">
										<a class="btn btn-block btn-green btn-copy" href="#">Copy Link</a>
									</div>
								</div>
							</div>
						<!-- .wizard-project --></div>
						*/ ?>
						
						<?php /*
						<div class="wizard-project">
							<div class="wizard-step step-4">
								<h2>Thank you for completing it</h2>
								<a class="btn btn-big btn-yellow" href="#">Download Voucher</a>
							</div>
						<!-- .wizard-project --></div>
						*/ ?>
						
						<!-- TABBED START -->
						<ul class="nav nav-tabs project_tab" id="project_tab">
						  <li class="active"><a href="#description" data-rel="description">Terms & Condition</a></li>
						  <li><a href="#embed" data-rel="embed">Embed</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
					        <div class="tab-pane fade active in project-tab-section" id="description">
						
						
						<div class="entry-content">
							<p>
								<?php echo nl2br( ucfirst($this->project->project_description) ); ?>
							</p>

							<?php /*
							<h3 class="green">Term &amp; Conditions</h3>
							<ol>
								<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
								<li>sed do eiusmod tempor incididunt ut labore et</li>
								<li>dolore magna aliqua. Ut enim ad minim veniam, quis</li>
								<li>nostrud exercitation ullamco laboris nisi ut aliquip</li>
								<li>ex ea commodo consequat</li>
							</ol>
							 * 
							 */ ?>
						<!-- .entry-content --></div>
						
							</div>
						
							<div class="tab-pane fade project-tab-section" id="embed">
					          
					          <textarea class="ttx-widget" id="ttx-widget" onclick="this.select()" readonly="readonly"><iframe src="<?php echo base_url(); ?>project/<?php echo $this->project->project_uri; ?>/widget" frameborder="0" scrolling="no" style="margin:0;padding:0; overflow:hidden;" width="300" height="660"></iframe></textarea>
					          
					          <p><small>*) CTRL+C in Windows or Command+C in Mac</small></p>
					          
					        </div>
					   
					      </div>
						<!-- TABBED END -->	
						
						
						<div class="clearfix"></div>	

						<div class="entry-footer" style="">
							
							<h5>Recommend this project to friends</h5>
							
							<?php /*
							<ul class="clearfix list-unstyled entry-share">
								<li class="share-facebook" data-url="http://google.com" data-text="Sharing text goes here" data-title="share"></li>
								<li class="share-twitter" data-url="http://google.com" data-text="Sharing text goes here" data-title="tweet"></li>
								<li class="share-googleplus" data-url="http://google.com" data-text="Sharing text goes here" data-title="+1"></li>
								<li class="share-comments sharrre">
									<div class="box">
										<a class="count" href="#">999</a>
										<a class="share" href="#">comments</a>
									</div>
								</li>
							</ul>*/ ?>
							<div id="shareme" data-url="<?php echo base_url(); ?>project/<?php echo $this->project->project_uri; ?>" data-text="<?php echo ucwords($this->project->project_name); ?>"></div>
						<!-- .entry-footer -->
							
							<div class="clearfix clear"></div>	
						
						</div>

						<div class="clearfix"></div>	

						
						
							
						
							

						
						<?php /* */ 
						$account_id = $this->session->userdata('account_id');
						if (!empty($account_id)){
						?>

						<div class="entry-comments" id="entry-comments">
							<form class="form-activorm form-comment" action="#" method="post" id="comment_form" data-pid="<?php echo $this->project->project_id; ?>" data-pidhash="<?php echo sha1($this->project->project_id . SALT); ?>">
								
								<div class="alert alert-success" id="comment-success" style="display:none;">
									<p>Comment berhasil diposting</p>
								</div>	
								
								<div class="alert alert-danger" id="comment-danger" style="display:none;">
									<p>Comment gagal diposting</p>
								</div>	
								
								<div class="form-group">
									<textarea name="comment" id="comment" class="form-control form-light comment_limiter" placeholder="Write your comment here.." rows="4"></textarea>
								</div>
								<div class="clearfix form-submit">
									<button type="button" id="post-comment" class="pull-right btn btn-green">Post Comment</button>
									<p class="pull-right help-block counter"><span>300</span> characters</p>
								</div>
							</form>

							<ul class="list-unstyled list-comments" id="list-comments">
								
								<?php 
								foreach($comments as $k=>$v){
									
									$comment = $v['comment'];
									
									$photo = (empty($comment->account_primary_photo)) ? 'img/user-default.gif' : $comment->account_primary_photo;
									$photo = $this->mediamanager->getPhotoUrl($photo, "100x100");
									
								?>	
								
								<li class="clearfix comment" id="comment" data-cid="<?php echo $comment->comment_id; ?>">
									<div class="comment-avatar">
										<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $comment->account_name; ?>" />
									</div>

									<div class="comment-body" id="comment-body">
										<div class="comment-meta">
											<strong class="comment-author"><?php echo $comment->account_name; ?></strong>
											<span class="comment-date"><?php echo date('d M Y H:i', strtotime($comment->postdate)); ?></span>
										</div>

										<div class="comment-content">
											<p><?php echo $comment->comment_text; ?></p>
										</div>

										<div class="comment-reply">
											<a href="#" id="btn-reply"><i class="icon-reply"></i> Reply Comment</a>
											<form class="form-activorm form-comment" action="#" method="post" id="reply_form" 
											data-pid="<?php echo $this->project->project_id; ?>" 
											data-pidhash="<?php echo sha1($this->project->project_id . SALT); ?>" 
											data-cid="<?php echo $comment->comment_id; ?>"
											data-cidhash="<?php echo sha1($comment->comment_id . SALT); ?>"
											style="margin-top:8px;display:none;">
								
												<div class="alert alert-success" id="comment-success" style="display:none;">
													<p>Reply Comment berhasil diposting</p>
												</div>	
												
												<div class="alert alert-danger" id="comment-danger" style="display:none;">
													<p>Reply Comment gagal diposting</p>
												</div>	
												
												<div class="form-group">
													<textarea name="comment" id="comment" class="form-control form-light reply_comment_limiter" placeholder="Write your reply here.." rows="4"></textarea>
												</div>
												<div class="clearfix form-submit">
													<button type="button" id="post-reply-comment" class="pull-right btn btn-green">Reply Comment</button>
													<p class="pull-right help-block reply_counter"><span>300</span> characters . <a href="#" id="close-reply-btn">Close</a></p>
												</div>
											</form>
										</div>

									</div>
									
									<ul class="children" id="reply_child">
										
										<?php 
										if (!empty($v['reply'])){
												
											$replys = $v['reply'];	
											
											ksort($replys);
											
											foreach($replys as $a=>$b){
												
												$photo = (empty($comment->account_primary_photo)) ? 'img/user-default.gif' : $b->account_primary_photo;
												$photo = $this->mediamanager->getPhotoUrl($photo, "100x100");
												
										?>
										
										<li class="clearfix comment">
											<div class="comment-avatar">
												<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $b->account_name; ?>" />
											</div>

											<div class="comment-body">
												<div class="comment-meta">
													<strong class="comment-author"><?php echo $b->account_name; ?></strong>
													<span class="comment-date"><?php echo date('d M Y H:i', strtotime($b->postdate)); ?></span>
												</div>

												<div class="comment-content">
													<p><?php echo $b->comment_text; ?></p>
												</div>
											</div>
										<!-- .comment --></li>
										
										<?php		
												
											}
											
										?>
										
										<?php
											
										}
										?>
										
										<?php /*
										<li class="clearfix comment">
											<div class="comment-avatar">
												<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
											</div>

											<div class="comment-body">
												<div class="comment-meta">
													<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
													<span class="comment-date">12 August 2013 12:35</span>
												</div>

												<div class="comment-content">
													<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
												</div>
											</div>
										<!-- .comment --></li>
										 */ ?>
										  
									</ul>
									
								<!-- .comment --></li>
								
								<?php	
								}
								?>
								
								<?php /*
								<li class="clearfix comment">
									<div class="comment-avatar">
										<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
									</div>

									<div class="comment-body">
										<div class="comment-meta">
											<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
											<span class="comment-date">12 August 2013 12:35</span>
										</div>

										<div class="comment-content">
											<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
										</div>

										<div class="comment-reply">
											<a href="#"><i class="icon-reply"></i> Reply Comment</a>
										</div>
									</div>
								<!-- .comment --></li>

								<li class="clearfix comment">
									<div class="comment-avatar">
										<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
									</div>

									<div class="comment-body">
										<div class="comment-meta">
											<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
											<span class="comment-date">12 August 2013 12:35</span>
										</div>

										<div class="comment-content">
											<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
										</div>

										<div class="comment-reply">
											<a href="#"><i class="icon-reply"></i> Reply Comment</a>
										</div>
									</div>

									<ul class="children">
										<li class="clearfix comment">
											<div class="comment-avatar">
												<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
											</div>

											<div class="comment-body">
												<div class="comment-meta">
													<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
													<span class="comment-date">12 August 2013 12:35</span>
												</div>

												<div class="comment-content">
													<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
												</div>
											</div>
										<!-- .comment --></li>
									</ul>
								<!-- .comment --></li>

								<li class="clearfix comment">
									<div class="comment-avatar">
										<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
									</div>

									<div class="comment-body">
										<div class="comment-meta">
											<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
											<span class="comment-date">12 August 2013 12:35</span>
										</div>

										<div class="comment-content">
											<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
										</div>

										<div class="comment-reply">
											<a href="#"><i class="icon-reply"></i> Reply Comment</a>
										</div>
									</div>
								<!-- .comment --></li>
								 */ ?>
								  
							<!-- .list-comments --></ul>
							
							
							<?php if ($total_comments > 10){ ?>
							<div class="load-more" id="load-more">
								<a href="#" class="btn btn-default btn-blue" data-tc="<?php echo $total_comments; ?>" data-pid="<?php echo $this->project->project_id; ?>" style="display:block;">Load More</a>
							</div>
							<?php } ?>
							
						<!-- .entry-comments --></div>
						
							
						<?php /* */

						}
						?>
						
							
						
					<!-- .entry-project --></div>
						
							

				<!-- #content --></div>

				<div id="sidebar" class="col-md-3">
					<div class="widget box widget-project">
						
						<?php 
						$photo = (empty($this->project->account_primary_photo)) ? 'img/company-avatar.gif' : $this->project->account_primary_photo;
						$photo = $this->mediamanager->getPhotoUrl($photo, "200x200");
						?>
						
						<?php 
						//$photo = $this->project->project_primary_photo;
						//$photo = $this->mediamanager->getPhotoUrl($photo, "200x200");
						?>
						
						<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->project->account_name; ?>" />

						<h4>Description</h4>
						<p><?php echo ucfirst($this->project->business_description); ?></p>

						<div class="divider"></div>

						<h4>Follow</h4>
						<ul class="row list-unstyled profile-social">
							
							<li class="col-sm-12 col-xs-6">
								<?php if (!empty($this->project->website) && $this->project->website != "http://"){ ?>
								<a href="<?php echo $this->project->website; ?>" target="_blank">
									<i class="glyphicon glyphicon-globe" style="font-size: 21px;margin: 0 8px 0 2px;vertical-align: middle;position: relative;top: -2px;"></i>
									<?php echo ucwords($this->project->business_name); ?></a>
								<?php } ?>	
							</li>
							
							<?php 
							foreach($socialmedia as $k=>$v){
								if (empty($v->link) || empty($v->name)) continue;
							?>
							<li class="col-sm-12 col-xs-6"><a href="<?php echo $v->link; ?>" target="_blank"><i class="icon-<?php echo $v->icon; ?>"></i> <?php echo $v->name; ?></a></li>
							<?php
							}
							?>
							
							<?php /*
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-facebook"></i> Starbucks</a></li>
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-twitter"></i> Starbucks</a></li>
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-gplus"></i> Starbucks</a></li>
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-instagram"></i> Starbucks</a></li>
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-tumblr"></i> Starbucks</a></li> */ ?>
						</ul>
					</div>
				<!-- #sidebar --></div>
			</div>
		<!-- #main --></div>

<script type="text/javascript">
	var freeplan = <?php echo $freeplan; ?>;
</script>		
<?php if ($freeplan > 0 || $this->project->premium_plan == 1){ ?>			
<?php $this->load->view('a/project/project_modal_thankyou_view', $this->data); ?>					
<?php }else{
	
	if ($this->project->business_id == $this->access->business_account->business_id){
	
?>
<?php $this->load->view('a/project/project_topup_view', $this->data); ?>					
<?php	

	}

} ?>

<?php $this->load->view('a/general/footer_view', $this->data); ?>