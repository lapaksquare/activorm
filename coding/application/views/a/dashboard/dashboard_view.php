<?php $this->load->view('a/general/header_view', $this->data); ?>

	<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Trend Prize</h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm table-scrollable">
								<thead>
									<tr>
										<th>Prize</th>
										<th>Fans</th>
									</tr>
								</thead>
								<tbody class="scrollable-area">
									
									<?php 
									foreach($this->trendprizedata as $k=>$v){
									?>
									<tr>
										<td><?php echo $v->prize_name; ?></td>
										<td><?php echo $v->jml_click; ?> Fan<?php echo ($v->jml_click > 1) ? 's' : ''; ?></td>
									</tr>
									<?php
									}
									?>
									
									
								</tbody>
							</table>
						</div>
					<!-- .box --></div>

					<div class="box dashboard-traffic">
						<div class="box-header">
							<h2 class="box-title title-light" style="float:left;">Traffic to Website</h2>
							
							<div class="pull-right">
								<select id="aldate" class="form-control">
									<?php
									$date1 = date("Y-m-d", strtotime("- 7 days"));
									$date2 = date("Y-m-d", strtotime("- 1 days")); 
									for($i=1;$i<=4;$i++){
										$h = sha1($date1 . $date2 . SALT);
										$v = "s=".$date1."&e=".$date2."&h=".$h;
										$class = ($v == $this->keyal) ? 'selected' : '';
									?>
									<option value="<?php echo $v; ?>" <?php echo $class; ?>><?php echo date("d M Y", strtotime($date1)).' s/d '.date("d M Y", strtotime($date2)); ?></option>
									<?php	
										$date2 = $date1;
										$date1 = date("Y-m-d", strtotime($date2 . " - 7 days"));
									}
									?>
								</select>
							</div>
							
							<div class="clearfix"></div>
							
						</div>

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
						
						<?php /*
						<div class="btn-group">
							<?php 
							$btn_group = array(
								"daily" => array(
									'name' => 'Daily',
									'url' => base_url() . 'dashboard/overview?ct=daily&ha=' . sha1("daily".SALT)
								),
								"weekly" => array(
									'name' => 'Weekly',
									'url' => base_url() . 'dashboard/overview?ct=weekly&ha=' . sha1("weekly".SALT)
								),
								"monthly" => array(
									'name' => 'Monthly',
									'url' => base_url() . 'dashboard/overview?ct=monthly&ha=' . sha1("monthly".SALT)
								)
							);
							foreach($btn_group as $k=>$v){
								$class = ($k == $this->gchart_type) ? "btn-green" : "btn-blue";
							?>
							<a class="btn btn-big <?php echo $class; ?>" href="<?php echo $v['url']; ?>"><?php echo ucwords($v['name']); ?></a>
							<?php	
							}
							?>
						</div> */ ?>

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
					<!-- .box --></div>

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>