<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="banner" class="block" style="background:#000;">
			<img class="img-responsive" src="<?php echo cdn_url(); ?>img/bg-header-projects.png" alt="#" style="margin:0 auto;" />
		<!-- #banner --></div>
		
		<div id="main" class="container" style="padding-top:10px;">
			
			<div class="section-header">
				<div class="row">
					<div class="col-md-7 col-xs-5 section-title">
						<div class="section-nav">
							<a href="#">Home</a>
							<span>&gt;</span>
							Projects
						<!-- .section-nav --></div>

						<form class="sorting-select" action="#" method="get">
							<select name="sorting" class="custom-select dark-select small-select">
								<option>Macbook Pro</option>
								<option>iPhone 5s</option>
								<option>Galaxy Note</option>
								<option>Nokia Lumia</option>
							</select>
						</form>
					</div>

					<div class="col-md-3 col-xs-4 section-sorting">
						<form class="sorting-select pull-right" action="#" method="get">
							<label for="sorting" class="pull-left"><strong>Sort by:</strong></label>
							<select name="sorting" class="custom-select dark-select small-select">
								<option>Deadline</option>
								<option>Status</option>
								<option>Prize</option>
								<option>Author</option>
							</select>
						</form>
					<!-- .section-sorting --></div>

					<div class="col-md-2 col-xs-3 section-layout">
						<strong>View:</strong>
						<a class="active" href="#"><i class="icon-th-list"></i></a>
						<a href="#"><i class="icon-th-grid"></i></a>
					<!-- .section-layout --></div>
				</div>
			<!-- .section-header --></div>

			<div class="row projects projects-list">
				<div class="col-xs-12 project-item">				
					<div class="box">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<img class="project-thumb" src="<?php echo cdn_url(); ?>img/content/project-image.gif" alt="macbook" />
							</div>

							<div class="col-md-7 col-sm-6">
								<h3 class="project-title">Macbook Pro Competition ASD</h3>
								<span class="project-author">by <a href="#">JuraganGadget</a></span>
								<span class="project-expiry">10 Days Left</span>
								<span class="project-date">Posted on 1 August 2013</span>
							</div>

							<div class="col-sm-2">
								<a class="btn btn-green project-join" href="#">Join Now!</a>
							</div>
						</div>
					</div>
				<!-- .project-item --></div>

				<div class="col-xs-12 project-item">				
					<div class="box">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<img class="project-thumb" src="<?php echo cdn_url(); ?>img/content/project-image.gif" alt="macbook" />
							</div>

							<div class="col-md-7 col-sm-6">
								<h3 class="project-title">Macbook Pro Competition ASD</h3>
								<span class="project-author">by <a href="#">JuraganGadget</a></span>
								<span class="project-expiry">10 Days Left</span>
								<span class="project-date">Posted on 1 August 2013</span>
							</div>

							<div class="col-sm-2">
								<a class="btn btn-green project-join" href="#">Join Now!</a>
							</div>
						</div>
					</div>
				<!-- .project-item --></div>

				<div class="col-xs-12 project-item">				
					<div class="box">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<img class="project-thumb" src="<?php echo cdn_url(); ?>img/content/project-image.gif" alt="macbook" />
							</div>

							<div class="col-md-7 col-sm-6">
								<h3 class="project-title">Macbook Pro Competition ASD with a Very Long Title for Test Purpose Only</h3>
								<span class="project-author">by <a href="#">JuraganGadget</a></span>
								<span class="project-expiry">10 Days Left</span>
								<span class="project-date">Posted on 1 August 2013</span>
							</div>

							<div class="col-sm-2">
								<a class="btn btn-green project-join" href="#">Join Now!</a>
							</div>
						</div>
					</div>
				<!-- .project-item --></div>

				<div class="col-xs-12 project-item">				
					<div class="box">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<img class="project-thumb" src="<?php echo cdn_url(); ?>img/content/project-image.gif" alt="macbook" />
							</div>

							<div class="col-md-7 col-sm-6">
								<h3 class="project-title">Macbook Pro Competition ASD</h3>
								<span class="project-author">by <a href="#">JuraganGadget</a></span>
								<span class="project-expiry">10 Days Left</span>
								<span class="project-date">Posted on 1 August 2013</span>
							</div>

							<div class="col-sm-2">
								<a class="btn btn-green project-join" href="#">Join Now!</a>
							</div>
						</div>
					</div>
				<!-- .project-item --></div>

				<div class="col-xs-12 project-item">				
					<div class="box">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<img class="project-thumb" src="<?php echo cdn_url(); ?>img/content/project-image.gif" alt="macbook" />
							</div>

							<div class="col-md-7 col-sm-6">
								<h3 class="project-title">Macbook Pro Competition ASD</h3>
								<span class="project-author">by <a href="#">JuraganGadget</a></span>
								<span class="project-expiry">10 Days Left</span>
								<span class="project-date">Posted on 1 August 2013</span>
							</div>

							<div class="col-sm-2">
								<a class="btn btn-green project-join" href="#">Join Now!</a>
							</div>
						</div>
					</div>
				<!-- .project-item --></div>
			<!-- .projects --></div>
			
		</div>
		
<?php $this->load->view('a/general/footer_view', $this->data); ?>