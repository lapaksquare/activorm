<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container" style="padding-top:50px;">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">
					
					<?php 
					$message_submit_premiumproject = $this->session->userdata('message_submit_premiumproject');
					$this->session->unset_userdata('message_submit_premiumproject');
					if (!empty($message_submit_premiumproject) && $message_submit_premiumproject == 2){
						$message = 'Project Anda berhasil disubmit.';
					?>
					<div class="alert alert-success"><?php echo $message; ?></div>
					<?php } ?>	
					
					<div class="box" style="overflow:hidden;">
						<div class="section-header">
							<div class="row">
								<div class="col-xs-6 section-status project-status">
									<strong class="pull-left">Status:</strong>
									<i class="status-closed"></i>
									<i class="status-ongoing"></i>
									<i class="status-draft"></i>
								</div>

								<?php /*
								<div class="col-xs-6 section-sorting">
									<div class="clearfix">
									<form class="sorting-select pull-right" action="#" method="get">
										<label for="sorting" class="control-label pull-left"><strong>Sort by:</strong></label>
										<select name="sorting" class="custom-select dark-select small-select">
											<option>Deadline</option>
											<option>Status</option>
											<option>Prize</option>
											<option>Author</option>
										</select>
									</form>
									</div>
								<!-- .section-sorting --></div> */ ?>
							</div>
						<!-- .section-header --></div>

						<div class="row-divider"></div>


						<?php foreach($projects as $k=>$v){ ?>

						<div class="project-item">
							<div class="row">
								<div class="col-xs-8">
									<h3 class="project-title"><a href="<?php echo base_url(); ?>project/<?php echo $v->project_uri; ?>" target="_blank"><?php echo ucwords($v->project_name); ?></a></h3>
									<span class="project-author">by <a href="<?php echo base_url() . $this->access->business_account->business_uri; ?>"><?php echo $this->access->business_account->business_name; ?></a></span><br />
									
									<?php 
									$project_period = strtotime($v->project_period);
									$project_now = strtotime(date('Y-m-d H:i:s'));
									$period = $project_period - $project_now;
									$period = ($period > 0) ? date('d', $period) : 0; 
									
									?>
									
									<span class="project-expiry"><?php echo $period; ?> Day<?php echo ($period == 1) ? '' : 's'; ?> Left</span><br />
									<span class="project-date">Posted on <?php echo date('d M Y', strtotime($v->project_posted)); ?></span>
								</div>

								<div class="col-xs-4">
									
									<?php 
									$status = "";
									
									$project_live = $v->project_live;
									if ($project_period < $project_now){
										$project_live = "Closed";
									}
									
									switch($project_live){
										case "Closed" :
											$status = "closed";
											$project_live = "Closed";
											break;
										case "Online" :
											$status = "ongoing";
											$project_live = "On Going";
											break;
										case "Offline" : 
											$status = "draft";
											$project_live = "Pending";
											break;
										case "Draft" :
											$status = "draft";
											$project_live = "Draft";
											break; 
									}
									?> 
									
									<span class="project-status pull-right"><span><?php echo $project_live; ?></span>
									
									<i class="status-<?php echo $status; ?>"></i>
									</span>
								</div>
							</div>
						<!-- .project-item --></div>

						<div class="row-divider"></div>
						
						<?php } ?>
						
						<?php 
						if (!empty($pagination)) echo $pagination;
						?>

						<?php /*
		
						<div class="project-item">
							<div class="row">
								<div class="col-xs-8">
									<h3 class="project-title">Macbook Pro Competition ASD</h3>
									<span class="project-author">by <a href="#">JuraganGadget</a></span><br />
									<span class="project-expiry">10 Days Left</span><br />
									<span class="project-date">Posted on 1 August 2013</span>
								</div>

								<div class="col-xs-4">
									<span class="project-status pull-right"><span>Closed</span> <i class="status-closed"></i></span>
								</div>
							</div>
						<!-- .project-item --></div>

						<div class="row-divider"></div>

						<div class="project-item">
							<div class="row">
								<div class="col-xs-8">
									<h3 class="project-title">Macbook Pro Competition ASD</h3>
									<span class="project-author">by <a href="#">JuraganGadget</a></span><br />
									<span class="project-expiry">10 Days Left</span><br />
									<span class="project-date">Posted on 1 August 2013</span>
								</div>

								<div class="col-xs-4">
									<span class="project-status pull-right"><span>Draft</span> <i class="status-draft"></i></span>
								</div>
							</div>
						<!-- .project-item --></div>
						 * 
						 */ ?>
						 
						 
					<!-- .box --></div>

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>
			
<?php $this->load->view('a/general/footer_view', $this->data); ?>