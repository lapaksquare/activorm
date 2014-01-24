<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Tickets</h1>
				<span class="page-subtitle">Claim your ticket if you win the prize.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<?php 
				
				if (!empty($tikets)){
				
				foreach($tikets as $k=>$v){
					
					$project_period = strtotime($v->project_period);
					$project_now = strtotime(date('Y-m-d H:i:s'));
					$period = $project_period - $project_now;
					$period = ($period > 0) ? date('d', $period) : 0; 
					
				?>
				<div class="col-md-6 ticket">
					<div class="ticket-inner">
						<div class="row">
							<div class="col-xs-8 col-sm-9 col-md-8">
								<span class="project-meta">Your ticket number</span>
								<h4 class="project-number"><?php echo strtoupper($v->tiket_barcode); ?></h4>

								<span class="project-meta">Project</span>
								<h3 class="project-title"><a href="<?php echo base_url() . 'project/' . $v->project_uri; ?>"><?php echo ucwords($v->project_name); ?></a></h3>
								<span class="project-author">by <a href="<?php echo base_url() . $v->business_uri; ?>"><?php echo ucwords($v->business_name); ?></a></span>

								<span class="project-date">Posted on <?php echo date('d M Y', strtotime($v->lastupdate)); ?></span>
							</div>

							<div class="col-xs-4 col-sm-3 col-md-4">
								<span class="project-meta">Period</span>
								<span class="project-expiry">
									<?php if ($period != 0){ ?>
									<?php echo $period; ?> Day<?php echo ($period == 1) ? '' : 's'; ?> Left
									<?php }else{ ?>
									Expired
									<?php } ?>
								</span>
								
								<?php 
								if ($v->iswin == 1 && !empty($v->voucher_data)){
								?>
								<a class="btn btn-block btn-green project-claim" href="<?php echo base_url(); ?>download/claim_tiket?p=<?php echo $v->project_id; ?>&a=<?php echo $v->account_id; ?>&h=<?php echo sha1($v->project_id.$v->account_id.SALT); ?>">Claim</a>
								<?php 
								}
								?>
							</div>
						</div>
					</div>
				<!-- .ticket --></div>
				<?php 
				}
				
				}
				?>

				<?php 
				if (!empty($pagination)) echo $pagination;
				?>

				<?php /*
				<div class="col-md-6 ticket">
					<div class="ticket-inner">
						<div class="row">
							<div class="col-xs-8 col-sm-9 col-md-8">
								<span class="project-meta">Your ticket number</span>
								<h4 class="project-number">1234688877</h4>

								<span class="project-meta">Project</span>
								<h3 class="project-title">Macbook Pro Competition ASD</h3>
								<span class="project-author">by <a href="#">JuraganGadget</a></span>

								<span class="project-date">Posted on 1 August 2013</span>
							</div>

							<div class="col-xs-4 col-sm-3 col-md-4">
								<span class="project-meta">Period</span>
								<span class="project-expiry">10 Days Left</span>

								<a class="btn btn-block btn-green project-claim" href="#">Claim</a>
							</div>
						</div>
					</div>
				<!-- .ticket --></div>

				<div class="col-md-6 ticket">
					<div class="ticket-inner">
						<div class="row">
							<div class="col-xs-8 col-sm-9 col-md-8">
								<span class="project-meta">Your ticket number</span>
								<h4 class="project-number">1234688877</h4>

								<span class="project-meta">Project</span>
								<h3 class="project-title">Macbook Pro Competition ASD</h3>
								<span class="project-author">by <a href="#">JuraganGadget</a></span>

								<span class="project-date">Posted on 1 August 2013</span>
							</div>

							<div class="col-xs-4 col-sm-3 col-md-4">
								<span class="project-meta">Period</span>
								<span class="project-expiry">10 Days Left</span>

								<span class="btn btn-block btn-grey project-claim" href="#">Expired</span>
							</div>
						</div>
					</div>
				<!-- .ticket --></div>

				<div class="col-md-6 ticket">
					<div class="ticket-inner">
						<div class="row">
							<div class="col-xs-8 col-sm-9 col-md-8">
								<span class="project-meta">Your ticket number</span>
								<h4 class="project-number">1234688877</h4>

								<span class="project-meta">Project</span>
								<h3 class="project-title">Macbook Pro Competition ASD</h3>
								<span class="project-author">by <a href="#">JuraganGadget</a></span>

								<span class="project-date">Posted on 1 August 2013</span>
							</div>

							<div class="col-xs-4 col-sm-3 col-md-4">
								<span class="project-meta">Period</span>
								<span class="project-expiry">10 Days Left</span>

								<span class="btn btn-block btn-grey project-claim" href="#">Expired</span>
							</div>
						</div>
					</div>
				<!-- .ticket --></div>
				*/ ?>
				
			<!-- .row --></div>

			<div class="content-nav">
				<?php /*
				<span class="current">1</span>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#">5</a>*/ ?>
			<!-- .content-nav --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>