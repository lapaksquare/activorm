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
					
					
					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Gender &amp; Age </h2>
						</div>
						
						<?php
						$data_gender = array(
							'11-17' => array(
								'male' => 0,
								'female' => 0
							),
							'18-23' => array(
								'male' => 0,
								'female' => 0
							),
							'24-30' => array(
								'male' => 0,
								'female' => 0
							),
							'31-40' => array(
								'male' => 0,
								'female' => 0
							),
							'41-50' => array(
								'male' => 0,
								'female' => 0
							),
							'51+' => array(
								'male' => 0,
								'female' => 0
							)
						); 
						$data_gender_string = array();
						foreach($this->gender_data as $k=>$v){
							if ($v->umur >= 11 && $v->umur <= 17){
								$key = "11-17";
							}else if ($v->umur >= 18 && $v->umur <= 23){
								$key = "18-23";
							}else if ($v->umur >= 24 && $v->umur <= 30){
								$key = "24-30";
							}else if ($v->umur >= 31 && $v->umur <= 40){
								$key = "31-40";
							}else if ($v->umur >= 41 && $v->umur <= 50){
								$key = "41-50";
							}else if ($v->umur >= 51){
								$key = "51+";
							}
							$data_gender[$key][$v->gender] += $v->jml_umur;
						}
						
						foreach($data_gender as $k=>$v){
							$data_gender_string[] = "['".$k."', ".$v['male'].", ".$v['female']."]";
						}
						?>

						<script type="text/javascript">
							$dataGAGender = [
								['Age', 'Male', 'Female'],
								<?php echo implode(", ", $data_gender_string); ?>
							];
						</script>
						<div id="chart-genderage"></div>
					<!-- .box --></div>


					<div class="box dashboard-traffic">
						<div class="box-header">
							<h2 class="box-title title-light" style="float:left;">Traffic to Project Page</h2>
							
							<div class="pull-right">
								<select id="aldate" class="form-control">
									<?php
									//$date1 = date("Y-m-d", strtotime("- 7 days"));
									//$date2 = date("Y-m-d", strtotime("- 1 days")); 
									/*
									$date1 = date('d M Y', strtotime($this->project->project_period . "- 7 days"));
									$date2 = date('d M Y', strtotime($this->project->project_period));
									for($i=1;$i<=4;$i++){
										$h = sha1($date1 . $date2 . SALT);
										$v = "s=".$date1."&e=".$date2."&h=".$h;
										$class = ($v == $this->keyal) ? 'selected' : '';
									?>
									<option value="<?php echo base_url() . 'dashboard/project/' . $this->project->project_uri . '?' . $v; ?>" <?php echo $class; ?>><?php echo date("d M Y", strtotime($date1)).' s/d '.date("d M Y", strtotime($date2)); ?></option>
									<?php	
										$date2 = $date1;
										$date1 = date("Y-m-d", strtotime($date2 . " - 7 days"));
									}*/
									
									$c_array = array();
									$c = $this->project->project_period_int;
									if ($c < 7){
										$date1 = date('Y-m-d', strtotime($this->project->project_period . "- ".$c." days"));
										$date2 = date('Y-m-d', strtotime($this->project->project_period));
										$h = sha1($date1 . $date2 . SALT);
										$v = "s=".$date1."&e=".$date2."&h=".$h;
										$t = date("d M Y", strtotime($date1)).' s/d '.date("d M Y", strtotime($date2));
										$c_array[] = array(
											'value' => $v,
											'text' => $t
										);
									}else{
										$ca = 7;
										$date1 = date('Y-m-d', strtotime($this->project->project_period . "- ".$ca." days"));
										$date2 = date('Y-m-d', strtotime($this->project->project_period));
										while($c > 0){
											$h = sha1($date1 . $date2 . SALT);
											$v = "s=".$date1."&e=".$date2."&h=".$h;
											$t = date("d M Y", strtotime($date1)).' s/d '.date("d M Y", strtotime($date2));
											$c_array[] = array(
												'value' => $v,
												'text' => $t,
												'c' => $c
											);
											
											$c = $c - $ca;
											$date2 = $date1;
											$date1 = date("Y-m-d", strtotime($date2 . " - " . $c . " days"));
										}
									}
									
									foreach($c_array as $k=>$v){
										$class = ($v['value'] == $this->keyal) ? 'selected' : '';
									?>
									
									<option value="<?php echo base_url() . 'dashboard/project/' . $this->project->project_uri . '?' . $v['value']; ?>" <?php echo $class; ?>><?php echo $v['text']; ?></option>
									
									<?php
									}
									?>
								</select>
								<?php //echo $this->project->project_period_int. '<pre>';print_r($c_array);echo '</pre>'; ?>
							</div>
							
							<div class="clearfix"></div>
							
							<script type="text/javascript">
								<?php 
								$chart_traffic = array();
								$gchart_type_js = "";
								foreach($this->trafficwebsite as $k=>$v){
									
									$analytic_visit = $v->analytic_visit;
									$analytic_visitors = $v->analytic_visitors;
									
									$y = date('Y', strtotime($v->analytic_date));
									$m = date('m', strtotime($v->analytic_date));
									$d = date('d', strtotime($v->analytic_date));
									
									if ($this->gchart_type == "daily"){
										$tgl = 'new Date('.$y.', '.($m-1).', '.$d.')';
										$gchart_type_js = "date";
									}else if ($this->gchart_type == "monthly"){
										$tgl = "'".date("d M Y", strtotime($v->analytic_date))."'";
										$gchart_type_js = "string";
									}else if ($this->gchart_type == "weekly"){
										//$tgl1 = date("d M Y", strtotime($v->analytic_date . " - 7 days"));
										//$tgl2 = date("d M Y", strtotime($v->analytic_date));
										//$tgl = "'$tgl1 s/d $tgl2'";
										$tgl = "'".date("d M Y", strtotime($v->analytic_date))."'";
										$gchart_type_js = "string";
									}
									
									$chart_traffic[] = '['.$tgl.', '.$analytic_visit.', '.$analytic_visitors.']';
									
								}
								?>
								var $gchart_type = '<?php echo $gchart_type_js; ?>';
								var $chart_traffic = [
									<?php echo implode(", ", $chart_traffic); ?>
								];
							</script>
							<div id="chart-traffic"></div>
							
							<div class="row">
								<div class="col-sm-6">
									<?php
									$chart_source = array();
									foreach($this->contentdata as $k=>$v){
										$chart_source[] = "['".ucwords($v->medium)."', ".$v->visits."]"; 
									}
									$chart_type = array();
									foreach($this->visitorsdata as $k=>$v){
										$chart_type[] = "['".ucwords($v->visitor_type)."', ".$v->visits."]"; 
									}
									?>
									<script type="text/javascript">
										var $chart_source = [
											['Source', 'Amount'],
											<?php echo implode(", ", $chart_source); ?>
										];
										var $chart_type = [
											['Type', 'Amount'],
											<?php echo implode(", ", $chart_type); ?>
										];
									</script>
									<div id="chart-source"></div>
									<div id="chart-type"></div>
									
									<p style="line-height:20px;"><small>*) Move your mouse to the pie chart to see the percentage.</small></p>
									
								</div>
	
								<div class="col-sm-6">
									<div class="table-responsive">
										<table class="table table-activorm">
											<thead>
												<tr>
													<th>Referrer</th>
													<th>Visitor</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($this->reffererdata as $k=>$v){ ?>
												<tr>
													<td><?php echo $v->source; ?></td>
													<td><?php echo $v->visits; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
					
					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Geography </h2>
						</div>
						
						<div class="row">
							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm table-align-alt table-scrollable">
										<thead>
											<tr>
												<th width="60%">Province</th>
												<th width="40%">Users</th>
											</tr>
										</thead>
										<tbody class="scrollable-area">
											<?php 
											if (!empty($this->province_data)){
												foreach($this->province_data as $k=>$v){
											?>
											<tr>
												<td><?php echo ucwords( $v->province_name ); ?></td>
												<td><?php echo $v->jml_account; ?></td>
											</tr>
											<?php } 
											}
											?>
										</tbody>
									</table>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm table-align-alt table-scrollable">
										<thead>
											<tr>
												<th width="60%">City</th>
												<th width="40%">Users</th>
											</tr>
										</thead>
										<tbody class="scrollable-area">
											<?php 
											if (!empty($this->city_data)){
												foreach($this->city_data as $k=>$v){
											?>
											<tr>
												<td><?php echo ucwords( $v->city_name ); ?></td>
												<td><?php echo $v->jml_account; ?></td>
											</tr>
											<?php } 
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<!-- .box --></div>
					
					<?php if (!empty($this->interests)){ ?>
					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Interest</h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm table-align-alt">
								<thead>
									<tr>
										<th width="25%">Rangking</th>
										<th width="75%">Interest</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($this->interests as $k=>$v){ ?>
									<tr>
										<td style="text-align:center;"><?php echo ($k+1); ?></td>
										<td style="text-align:left;"><?php echo ucwords($v->mip_name); ?>
											<div><small><?php echo ucfirst($v->mip_details); ?></small></div></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					<!-- .box --></div>
					<?php } ?> 
					
				<!-- #content -->
				</div>


			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>