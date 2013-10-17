<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<div class="box" style="overflow:hidden;">
						<div class="section-header">
							<div class="row">
								<div class="col-xs-6 section-status project-status">
									<strong class="pull-left">Status:</strong>
									<i class="status-closed"></i>
									<i class="status-ongoing"></i>
									<i class="status-draft"></i>
								</div>

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
								<!-- .section-sorting --></div>
							</div>
						<!-- .section-header --></div>

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
									<span class="project-status pull-right"><span>On Going</span> <i class="status-ongoing"></i></span>
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
					<!-- .box --></div>

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>
			
<?php $this->load->view('a/general/footer_view', $this->data); ?>