<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="banner" class="block" style="background:#000;">

			<?php /*	
			<img class="img-responsive" src="<?php echo cdn_url(); ?>img/bg-header-projects.png" alt="#" style="margin:0 auto;" /> */ ?>
			
			<div class="bs-slide-container">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="overflow:hidden;height:234px;">
					
					<?php /*
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
				  </ol> */ ?>
				
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				  	
				  	<?php 
				  	foreach($this->banners as $k=>$v){
				  		$class = ($k == 0) ? 'active' : '';
				  	?>
				  	<div class="item <?php echo $class; ?>">
				  		<a href="<?php echo $v->banner_link; ?>">
				      <img src="<?php echo cdn_url() . $v->banner_image; ?>" alt="<?php echo $v->banner_name; ?>" />
				      	</a>
				    </div>
				    <?php 
					}
				    ?>
				    
				    <?php /*
				    <div class="item">
				      <img src="http://bejanamu.local/img/b1.jpg" alt="b1" />
				    </div>
				    <div class="item">
				      <img src="http://bejanamu.local/img/b2.jpg" alt="b1"/>
				    </div>
				    <div class="item">
				      <img src="http://bejanamu.local/img/b3.jpg" alt="b1" />
				    </div>
				    <div class="item">
				      <img src="http://bejanamu.local/img/b4.jpg" alt="b1" />
				    </div>
				    <div class="item">
				      <img src="http://bejanamu.local/img/b5.jpg" alt="b1" />
				    </div> */ ?>
				    
				  </div>
				
				  <!-- Controls -->
				  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				  </a>
				</div>
			</div>
			
		<!-- #banner -->
		</div>
		
		<div id="main" class="container" style="padding-top:10px;">
			
			<div class="section-header">
				<div class="row">
					<div class="col-md-7 col-xs-5 section-title">
						<div class="section-nav">
							<a href="<?php echo base_url(); ?>">Home</a>
							<span>&gt;</span>
							<a href="<?php echo base_url(); ?>prize/<?php echo $this->prize_profile->prize_uri; ?>"><?php echo ucwords($this->prize_profile->prize_name); ?></a>
							<span>&gt;</span>
							Projects
						<!-- .section-nav --></div>

						<?php /*
						<form class="sorting-select" action="#" method="get">
							<select name="sorting" class="custom-select dark-select small-select">
								<option>Macbook Pro</option>
								<option>iPhone 5s</option>
								<option>Galaxy Note</option>
								<option>Nokia Lumia</option>
							</select>
						</form>*/ ?>
					</div>

					
					<div class="col-md-3 col-xs-4 section-sorting">
						<?php /*
						<form class="sorting-select pull-right" action="#" method="get">
							<label for="sorting" class="pull-left"><strong>Sort by:</strong></label>
							<select name="sorting" class="custom-select dark-select small-select">
								<option>Deadline</option>
								<option>Status</option>
								<option>Prize</option>
								<option>Author</option>
							</select>
						</form>*/ ?>
					<!-- .section-sorting --></div>

					<div class="col-md-2 col-xs-3 section-layout">
						<strong>View:</strong>
						<?php $list_active = ($view_type == "list") ? 'active' : ''; ?>
						<a class="<?php echo $list_active; ?>" href="<?php echo base_url(); ?>ajax/prize_layout?l=list&lh=<?php echo sha1("list" . SALT); ?>"><i class="icon-th-list"></i></a>
						<?php $grid_active = ($view_type == "grid") ? 'active' : ''; ?>
						<a class="<?php echo $grid_active; ?>" href="<?php echo base_url(); ?>ajax/prize_layout?l=grid&lh=<?php echo sha1("grid" . SALT); ?>"><i class="icon-th-grid"></i></a>
					<!-- .section-layout --></div>
				</div>
			<!-- .section-header --></div>

			<div class="row projects projects-<?php echo $view_type; ?>">
				
				<?php
				$class_box = "col-xs-12"; 
				if ($view_type == "grid") {
					$class_box = "col-md-3 col-sm-4 col-xs-6";
				}
				?>
				
				<?php foreach($this->project_prize as $k=>$v){
					
					if (empty($v->photo_file)){
						$photo = $v->project_primary_photo;
					}else{
						$photo = $v->photo_file;
					}
					 
					$photo = $this->mediamanager->getPhotoUrl($photo, "200x125");
					?>
					
					<?php 
					$project_period = strtotime($v->project_period);
					$project_now = strtotime(date('Y-m-d H:i:s'));
					$period = $project_period - $project_now;
					$period = ($period > 0) ? date('d', $period) : 0; 
					
					?>
					
				<div class="<?php echo $class_box; ?> project-item">				
					<div class="box">
						<div class="row">
							
							<?php if ($view_type == "list"){ ?>
							<div class="col-md-3 col-sm-4">
								<img class="project-thumb" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo ucwords($v->project_name); ?>" style="display: block;height: auto;max-width: 100%;margin: 0 auto;" />
							</div>

							<div class="col-md-7 col-sm-6">
								<h3 class="project-title"><?php echo ucwords($v->project_name); ?></h3>
								<span class="project-author">by <a href="<?php echo base_url() . $v->business_uri; ?>"><?php echo ucwords($v->business_name); ?></a></span>
								
								
								
								<span class="project-expiry">
									<?php if ($period > 0){ ?>
									<?php echo $period; ?> Day<?php echo ($period == 1) ? '' : 's'; ?> Left
									<?php }else echo "Closed"; ?>
								</span>
								<span class="project-date">Posted on <?php echo date('d M Y', strtotime($v->project_posted)); ?></span>
							</div>

							<div class="col-sm-2">
								<a class="btn btn-green project-join" href="<?php echo base_url(); ?>project/<?php echo $v->project_uri; ?>">Join Now!</a>
							</div>
							
							<?php }else if ($view_type == "grid"){ ?>
								
							<div class="col-xs-12">
								<img class="img-responsive project-thumb" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo ucwords($v->project_name); ?>" style="display: block;height: auto;max-width: 100%;margin: 0 auto;" />
							</div>

							<div class="col-xs-4 project-meta">
								<span class="project-expiry"><?php echo $period; ?> Day<?php echo ($period == 1) ? '' : 's'; ?> Left</span>
								<a class="btn btn-green project-join" href="<?php echo base_url(); ?>project/<?php echo $v->project_uri; ?>">Join Now!</a>
							</div>

							<div class="col-xs-8 project-details">
								<h3 class="project-title"><?php echo ucwords($v->project_name); ?></h3>
								<span class="project-author">by <a href="<?php echo base_url() . $v->business_uri; ?>"><?php echo ucwords($v->business_name); ?></a></span>
								<span class="project-date">Posted on <?php echo date('d M Y', strtotime($v->project_posted)); ?></span>
							</div>	
								
							<?php } ?>
							
						</div>
					</div>
				<!-- .project-item --></div>
				<?php } ?>

				<?php /*
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
								<a class="btn btn-green project-join" href="<?php echo base_url(); ?>project/activorm-demo-project">Join Now!</a>
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
								<a class="btn btn-green project-join" href="<?php echo base_url(); ?>project/activorm-demo-project">Join Now!</a>
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
								<a class="btn btn-green project-join" href="<?php echo base_url(); ?>project/activorm-demo-project">Join Now!</a>
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
								<a class="btn btn-green project-join" href="<?php echo base_url(); ?>project/activorm-demo-project">Join Now!</a>
							</div>
						</div>
					</div>
				<!-- .project-item --></div>*/ ?>
			<!-- .projects --></div>
			
		</div>
		
<?php $this->load->view('a/general/footer_view', $this->data); ?>