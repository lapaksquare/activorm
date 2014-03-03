<?php $this->load->view('a/general/header_widget_view', $this->data); ?>

<body>
	
	<div class="widget">
		
		<?php 
		$photo = $this->project->project_primary_photo;
		$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
		?>
		
		<div class="widget-header-cover" >
			<div class="header-cover" style="background-image:url(<?php echo cdn_url() . $photo; ?>);"></div>
			<img src="<?php echo cdn_url() . $photo; ?>" alt="cover" />
			<div class="widget-badge">
				<?php if ($jml_tiket == 0){ ?>
					Be The First!
				<?php }else{ ?>
					<span><?php echo $jml_tiket; ?></span> <br />Joined
				<?php } ?>
			</div>
		</div>
		
		<div class="widget-project-title"><?php echo ucwords($this->project->project_name); ?></div>
		
		<?php 
			$tiket_enddate = strtotime($this->project->project_period);
			$server_end = strtotime($this->project->project_period);
			$server_start = strtotime(date('Y-m-d H:i:s'));
			
			$project_period = strtotime($this->project->project_period);
			$project_now = strtotime(date('Y-m-d H:i:s'));
			//$period = $project_period - $project_now;
			//$period = date('d', $period); 
			
			$stoped = 0;
			$time_note = "Time Remaining";
			$class_time = "";
			//if ( ($server_start >= $server_end && $server_start <= $tiket_enddate) || $this->input->get_post('tiketstart') == 1 ){
			if ($project_period < $project_now || in_array($this->project->project_live, array('Draft', 'Offline'))){	
				//redirect(base_url() . '404');
				if ($project_period < $project_now) {
					$stoped = 1; 
					$time_note = "The Project has Ended";
				}else{
					$time_note = "The Project has not been Started";
				}
				$class_time = "time-ended";
			}else{
				
			?>
			
			
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
								//var detik_html = document.getElementById('detik');
								
								days_html.innerHTML = days;
								hours_html.innerHTML = hours;
								menit_html.innerHTML = minutes;
								//detik_html.innerHTML = seconds;
							}
							timer = setInterval(showCountdown, 10);
						</script>
			
			
			<?php	
				
			}
			
			
			
			
		?>
		
		<div class="widget-time-count">
			<div class="time-note"><?php /*Time Remaining*/ ?><?php echo $time_note; ?></div>
			<div class="time-count <?php echo $class_time; ?>">
				<div class="time-section time-days"><span id="hari">00</span> <span class="time-sp">days</span></div>
				<div class="time-section time-hours"><span id="jam">00</span> <span class="time-sp">hours</span></div>
				<div class="time-section time-minutes"><span id="menit">00</span> <span class="time-sp">mins</span></div>
			</div>
		</div>
		
		<div class="widget-body">
			
			<?php 
			if ($stoped == 0){
				
				$account_id = $this->session->userdata('account_id');
				if (empty($account_id)){
					
			?>
			
				<div class="widget-auth" >
					<a href="<?php echo $this->access->loginUrl; ?>" class="btn-login-fb">Login with Facebook</a>
					<div class="widget-auth-sp">OR, <span>Login with Activorm Account</span></div>
					<div class="widget-auth-form">
						<form action="<?php echo base_url(); ?>auth/login" method="post">
							<input type="text" name="email" class="email-field input-field" placeholder="Email Address" />
							<input type="password" name="password" class="password-field input-field" placeholder="Password" />
							<?php 
							$message_login_error = $this->session->userdata('message_login_error');
							if (!empty($message_login_error)){
								$this->session->unset_userdata('message_login_error');
							?>
							<div class="error-message">Wrong Password!</div>
							<?php } ?>
							<input type="submit" name="login" value="login" class="btn-submit-login" />
						</form>
						<div class="widget-auth-sp" style="color:#333;padding-bottom:0;padding-top:10px;">Don’t have Activorm Account? <a href="<?php echo base_url(); ?>ajax/signup_invitation?hj=612af6c51bc3d226f64ee4058c511358f02ea507" target="_blank" style="text-decoration: underline;">Sign Up Now</a></div>
					</div>
				</div>
			
			<?php		
					
				}else{
					
					if ($this->access->member_account->register_step == 4 || (count($socialmedia_required) != $socialmedia_required_isok)){
						
			?>
			
					<div class="widget-auth" >
						<div class="widget-auth-sp">Please complete your contact information!. <a  href="<?php echo base_url(); ?>settings/contact" target="_blank" id="navbar-settings">Settings</a></div>
					</div>	
			
			<?php			
						
					}else{
						
						/** START **/
						$flag = 1;	
						$tutup_action = 0;					
						if (empty($project_actions) || ($project_actions['action_1'] == 0 && $project_actions['action_2'] == 0 && $project_actions['action_3'] == 0) ){
							
							$flag = 0;
							
							if ($jml_tiket_user < 3){
								
							}else{
								$tutup_action = 1;
			?>	
			
					<div class="widget-auth" >
						<div class="widget-auth-sp">You may only join maximum 3 projects per day. <br /> Thank you</div>
					</div>	
					
			<?php					
								
							}
							
						}
						/** END **/
						
						
						
						if ( ($project_actions['action_1'] == 1 && $project_actions['action_2'] == 1 && $project_actions['action_3'] == 1) ){
							
							if ( ($project_actions['action_premium'] == 1 && $this->project->premium_plan == 1) || 
								($project_actions['action_1'] == 1 && $project_actions['action_2'] == 1 && $project_actions['action_3'] == 1 && $this->project->premium_plan == 0)
								){
									
									if (!empty($business_id)){
										
			?>
										<div class="widget-auth" >
											<div class="widget-auth-sp">Sorry, You may only get the ticket as a user account</div>
										</div>	
			<?php							
										
									}else{
										
										
										if (empty($this->project->project_file_data)){
											
			?>
			
											<div class="widget-actions-completed">
												<div>
													<h3>Thank You!</h3>
													<span>Please check your ticket at <br />Activorm website.</span>
													<a href="<?php echo base_url(); ?>tickets" target="_blank" class="btn-see-tiket">CHECK YOUR TICKET</a>	
													<span>Or <a href="<?php echo base_url(); ?>prize" target="_blank">See Another Project</a></span>	
												</div>
											</div>
			
			<?php								
											
										}else{
											
											
			?>
			
											<div class="widget-actions-completed">
												<div>
													<h3>Thank You!</h3>
													<span>Please check your ticket at <br />Activorm website.</span>
													<a href="<?php echo base_url(); ?>download?h=<?php echo sha1($this->project->project_id.$account_id.SALT); ?>&p=<?php echo $this->project->project_id; ?>&a=<?php echo $account_id; ?>" target="_blank" class="btn-see-tiket">CHECK YOUR TICKET</a>	
													<span>Or <a href="<?php echo base_url(); ?>prize" target="_blank">See Another Project</a></span>	
												</div>
											</div>
			
			<?php
											
											
										}
										
										
									}
	
								}else{
									
									
									/* PREMIUM CONTEST*/
			?>
			
									<div class="widget-auth" >
										<div class="widget-auth-sp">More Tickets (max. 2 tickets). <br />Please check <a href="<?php echo base_url(); ?>project/<?php echo $this->project->project_uri; ?>" target="_blank">here</a>.</div>
									</div>	
		
			<?php
									
									
								}
								
						}else{
							
							
							if ($tutup_action == 0){
								
							
			?>
			
							
							<div class="widget-actions">
								<div class="widget-actions-header">
									Complete Three Actions
									<span></span>
								</div>
								
								<?php 
								foreach($project_actions_data as $k=>$v){
									
									$key = 'action_' . ($k+1);
									$check_active = 0;
									if ($project_actions[$key] == 1){
										$check_active = 1;
									}
									
									if ($v->type_step == "facebook-like" && $check_active == 0){
								?>
								
								<div class="widget-overlay" style="display:none;" id="<?php echo $v->type_step; ?>-container">
									<div class="overlay-header" style="margin-bottom:15px;"><?php echo ucwords( $v->type_name ); ?></div>
													
									<div class="overlay-container">
										<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo $v->id; ?>&amp;width=300&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=<?php echo FACEBOOK_APP_ID; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:62px;" allowTransparency="true"></iframe>
										
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
								
								<div class="widget-actions-body" id="action-steps">
									
									<?php 
									$co = 0;
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
										
										switch($v->type_step){
											
											// facebok
											case "facebook-like" :
												$class = "ico-facebook-like";
												break; 
											case "facebook-send" :
												$class = "ico-facebook-send-content";
												$url_string = base_url() . 'actions/trigger_actions?' . $url;
												break; 
												
											//twitter	
											case "twitter-tweet" :
												$class = "ico-twitter-tweet";
												$url_string = base_url() . 'actions/trigger_actions?' . $url;
												break; 
											case "twitter-follow" :
												$class = "ico-twitter-follow";
												$url_string = base_url() . 'actions/trigger_actions?' . $url;
												break; 
											case "twitter-hashtag" :
												$class = "ico-twitter-hashtag";
												$url_string = base_url() . 'actions/trigger_actions?' . $url;
												break; 
										}

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
									
									<div class="action-container">
										<?php if ($check_active == 0){ ?>
										<a <?php echo $script; ?> href="<?php echo $url_string; ?>" data-id="<?php echo $v->type_step; ?>-container" <?php if ($script == ""){ ?>id="<?php echo $v->type_step; ?>-widget-btn" <?php } ?>>
										<?php } ?>
											<div class="action-logo
												<?php if ($check_active == 1){ ?>
												action-completed ico-check
												<?php }else{ ?>
													<?php echo $class; ?>
												<?php } ?> 
											"></div>
											<div class="action-note"><?php echo $v->type_name; ?></div>
											<div class="clearfix"></div>
										<?php if ($check_active == 0){ ?>
										</a>
										<?php } ?>
									</div>
									
									<?php if ($co < 2){ ?>
									<div class="action-sp <?php if ($check_active == 1){ ?>action-sp-complete<?php } ?>"></div>
									<?php } $co++; ?>
									
			<?php 
				
									}
							
			?>
									
								</div>
							</div>		
			
			
			<?php
							
								
							}
							
							
						}
			?>
			
			
						
			
			
			<?php			
						
						
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
			
			<div class="widget-action-winner">
				<div class="widget-action-winner-container">
					<h3>Congratulations!</h3>
					<span>The Winner of This Project is</span>
					<span class="winneris"><?php echo $wins; ?></span>
				</div>
				<a href="<?php echo base_url(); ?>prize" target="_blank" class="btn-join-project">JOIN ANOTHER PROJECT</a>	
			</div>
			
			<?php	
				
			}

			?>
			
			
			<?php /*
			<div class="widget-auth" >
				<a href="#" class="btn-login-fb">Login with Facebook</a>
				<div class="widget-auth-sp">OR, <span>Login with Activorm Account</span></div>
				<div class="widget-auth-form">
					<form>
						<input type="text" name="email" class="email-field input-field" placeholder="Email Address" />
						<input type="password" name="password" class="password-field input-field" placeholder="Password" />
						<div class="error-message">Wrong Password!</div>
						<input type="submit" name="submit" value="login" class="btn-submit-login" />
					</form>
					<div class="widget-auth-sp" style="color:#333;padding-bottom:0;padding-top:10px;">Don’t have Activorm Account? <a href="#" style="text-decoration: underline;">Sign Up Now</a></div>
				</div>
			</div> */ ?>
			
			<?php /*
			<div class="widget-actions">
				<div class="widget-actions-header">
					Complete These Actions
					<span></span>
				</div>
				<div class="widget-actions-body">
					<div class="action-container">
						<div class="action-logo action-completed ico-check"></div>
						<div class="action-note">Like Facebook Page</div>
						<div class="clearfix"></div>
					</div>
					<div class="action-sp action-sp-complete"></div>
					<div class="action-container">
						<a href="#">
							<div class="action-logo ico-twitter-follow"></div>
							<div class="action-note">Like Facebook Page</div>
							<div class="clearfix"></div>
						</a>
					</div>
					<div class="action-sp"></div>
					<div class="action-container">
						<a href="#">
							<div class="action-logo ico-twitter-tweet"></div>
							<div class="action-note">Like Facebook Page</div>
							<div class="clearfix"></div>
						</a>
					</div>
				</div>
			</div>
			*/ ?>
			
			<?php /*
			<div class="widget-actions-completed">
				<div>
					<h3>Thank You!</h3>
					<span>Please check your ticket at <br />Activorm website.</span>
					<a href="#" class="btn-see-tiket">CHECK YOUR TICKET</a>	
					<span>Or <a href="#">See Another Project</a></span>	
				</div>
			</div> */ ?>
			
			<?php /*
			<div class="widget-action-winner">
				<div class="widget-action-winner-container">
					<h3>Congratulations!</h3>
					<span>The Winner of This Project is</span>
					<span class="winneris">Karen Kamal</span>
				</div>
				<a href="#" class="btn-join-project">JOIN ANOTHER PROJECT</a>	
			</div> */ ?>
			
		</div>
		
		<div class="widget-footer">
			<span><a href="<?php echo base_url(); ?>project/<?php echo $this->project->project_uri; ?>" target="_blank">Terms & Conditions</a></span>
			<span><a href="<?php echo base_url(); ?>" target="_blank">Powered by <b>Activorm</b></a></span>
		</div>
		
	</div>
	
</body>

<?php $this->load->view('a/general/footer_widget_view', $this->data); ?>