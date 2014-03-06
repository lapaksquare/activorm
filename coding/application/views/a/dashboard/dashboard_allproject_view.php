<?php $this->load->view('a/general/header_view', $this->data); ?>

	<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<div class="box dashboard-projects">
						<div class="box-header">
							<h2 class="box-title title-light">All Projects</h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm" id="dashboard_allproject">
								<thead>
									<tr>
										<th width="10%">Date</th>
										<th width="40%">Project Title</th>
										<th width="10%">Views</th>
										<th width="40%">Member Join</th>
										<th width="10%">Paid</th>
										<th width="10%">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$limit_time = "2014-03-03 18:00";
									$limit_time = strtotime($limit_time);
									//$limit_time = date("Y-m-d H:i", strtotime($limit_time));
									//echo $limit_time;
									foreach($this->results as $k=>$v){ 
										
										$pageviews = (empty($this->results_project_analytics[$v->project_id]['pageviews'])) ? 0 : $this->results_project_analytics[$v->project_id]['pageviews'];
										
										$href = base_url() . 'dashboard/project/' . $v->project_uri;
										$project_posted = strtotime($v->project_posted);
										//echo $limit_time . ' ' . $project_posted;
										if ($v->premium_plan == 0 && $freeplan <= 0 && $limit_time < $project_posted){
											$href = "#";	
										}
										
										?>
									<tr>
										<td><?php echo date("d M Y", strtotime($v->project_posted)); ?></td>
										<td><a id="" href="<?php echo $href; ?>" data-h="<?php echo sha1($v->project_id . SALT); ?>" data-pid="<?php echo $v->project_id; ?>" target="_blank"><?php echo ucwords($v->project_name); ?></a></td>
										<td><?php echo $pageviews; ?></td>
										<td><?php echo $v->member_join; ?></td>
										<td><?php echo ($v->premium_plan == 0) ? 'FREE' : 'PAID'; ?></td>
										<td><?php echo ucwords($v->project_live); ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						
						<?php 
						if (!empty($pagination)) echo $pagination;
						?>
						
					<!-- .box --></div>
				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/dashboard/dashboard_project_modal_view', $this->data); ?>		

<?php $this->load->view('a/general/footer_view', $this->data); ?>