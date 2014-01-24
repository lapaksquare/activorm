						<h4 class="modal-title"><?php echo ucwords( $this->result->project_name ); ?></h4>

						<div class="row project-overview">
							<div class="col-xs-5">
								<span>Start: <strong class="green"><?php echo date('d M Y', strtotime($this->result->project_period . ' -' . $this->result->project_period_int . ' days')); ?></strong></span>
								<span>Ends: <strong class="green"><?php echo date('d M Y', strtotime($this->result->project_period)); ?></strong></span>
							</div>

							<div class="col-xs-7">
								<span>Views: <strong><?php echo $this->project_analytic['pageviews']; ?></strong></span>
								<span>Bounce Rate: <strong><?php echo $this->project_analytic['bouncerate']; ?>%</strong></span>
							</div>
						<!-- .project-overview --></div>
						
						<?php 
						$project_actions_data = json_decode( $this->result->project_actions_data );
						?>

						<div class="action-steps project-engagement">
							<h3>Engagement</h3>
							<ul class="row">
								<?php 
								foreach($project_actions_data as $k=>$v){
									$j = 'jml_action'.($k+1);
									
									$class = '';
									switch($v->type_step){
												
										// facebok
										case "facebook-like" :
											$class = "actions-facebook-like-fb-small";
											break; 
										case "facebook-follow" :
											$class = "actions-facebook-follow-fb-user-small";
											break; 
										case "facebook-send" :
											$class = "actions-facebook-send-content-friend-small";
											break; 
											
										//twitter	
										case "twitter-tweet" :
											$class = "actions-twitter-tweet-small";
											break; 
										case "twitter-follow" :
											$class = "actions-twitter-follow-account-small";
											break; 
										case "twitter-hashtag" :
											$class = "actions-twitter-tweet-hashtag-small";
											break; 
										case "twitter-to" :
											$class = "actions-twet-to-small";
											break; 
									}
									
								?>
								<li class="col-xs-4">
									<div class="step-no"><?php echo $k+1; ?>.</div>
									<div class="step-ico <?php echo $class; ?>">
										<span class="active" style="background-color: #1ab99b;border-color: #1ab99b;"></span>
									</div>
									<div class="step-desc">
										<?php echo ucwords($v->type_name); ?>
										<strong><?php echo $this->result->member_join; //$this->result->$j; ?></strong>
									</div>
								</li>
								<?php } ?>
							</ul>
						<!-- .project-engagement --></div>