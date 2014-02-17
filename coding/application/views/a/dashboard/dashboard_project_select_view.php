<?php $this->load->view('a/general/header_view', $this->data); ?>

	<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Analytic For Project</h1>
				<select name="projects" class="form=control" id="projects_selected">
					<?php foreach($this->projects as $k=>$v){ 
						$class = ($v->project_uri == $this->project->project_uri) ? "selected" : "";
						?>
					<option value="<?php echo $v->project_uri; ?>" <?php echo $class; ?>><?php echo ucwords($v->project_name); ?></option>
					<?php } ?>
				</select>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-3 col-sm-3">

					<div class="dashboard-start-endtime">
						<div class="dashboard-time-block time-start"><i>Start</i> <?php echo date('d M Y', strtotime($this->project->project_period . "-" . $this->project->project_period_int . " days")); ?></div>
						<div class="dashboard-time-block time-end"><i>End</i> <?php echo date('d M Y', strtotime($this->project->project_period)); ?></div>
					</div>
					
					<div class="dashboard-stats">
						<div class="dashboard-stat"><i><span class="glyphicon glyphicon-eye-open"></span> Views</i> <?php echo $this->project_analytic['pageviews']; ?></div>
						<div class="dashboard-stat"><i><span class="glyphicon glyphicon-star"></span> Bounce Rate</i> <?php echo $this->project_analytic['bouncerate']; ?>%</div>
						<div class="dashboard-stat"><i><span class="glyphicon glyphicon-user"></span> Member Join</i> <?php echo $this->result->member_join; ?></div>
					</div>
					
				<!-- #content -->
				</div>
				
				<div id="content" class="col-md-9 col-sm-9">

					
					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Engagement</h2>
						</div>
						<div class="action-steps project-engagement" style="margin-bottom:0;">
							<ul class="row dashboard-project-graph" style="background:none;">
								<?php 
								$project_actions_data = json_decode( $this->result->project_actions_data );
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
									<div class="step-ico <?php echo $class; ?>">
										<span class="active" style="background-color: #1ab99b;border-color: #1ab99b;"></span>
									</div>
									<div class="step-desc">
										<?php echo ucwords($v->type_name); ?>
										<strong>(<?php echo $this->result->member_join; //$this->result->$j; ?>)</strong>
									</div>
								</li>
								<?php } ?>
							</ul>
							
						<!-- .project-engagement --></div>
					</div>
					
					
				<!-- #content -->
				</div>


			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>