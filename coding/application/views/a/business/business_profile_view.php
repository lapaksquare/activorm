<?php $this->load->view('a/general/header_view', $this->data); ?>	

	<div id="main" class="container">

			<div class="row">
				<div class="col-md-9 col-sm-8 profile-details">
					<div class="box">
						<div class="row">
							<div class="col-xs-4 profile-image">
								<?php 
								$photo = $this->business->account_primary_photo;
								if (empty($photo)){
									$photo = "img/company-avatar_200x200.gif";
								}else{
									$photo = $this->mediamanager->getPhotoUrl($photo, "164x164");
								}
								?>
								<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->business->business_name; ?>" />
							</div>

							<div class="col-xs-8 profile-desc">
								<h1 class="profile-title"><?php echo ucwords($this->business->business_name); ?></h1>
								<p><?php echo ucfirst($this->business->business_description); ?></a></p>
							</div>
						</div>
					</div>
				<!-- .profile-details --></div>

				<div class="col-md-3 col-sm-4 profile-social">
					<div class="box" style="padding:30px 0 30px 20px;">
						<?php if (!empty($this->business->website) && $this->business->website != "http://"){ ?>
							<a href="<?php echo $this->business->website; ?>" target="_blank" style="margin-bottom: 6px;display: inline-block;">
								<i class="glyphicon glyphicon-globe" style="font-size: 21px;margin: 0 8px 0 2px;vertical-align: middle;position: relative;top: -2px;"></i>
								<?php echo ucwords($this->business->business_name); ?></a>
						<?php } ?>	
						<ul class="row list-unstyled">
							
							<?php 
							foreach($socialmedia as $k=>$v){
								$socialmedia_name = $link = "";
								$social_page_active = $v->social_page_active;
								if ($k == "facebook" && !empty($social_page_active)){
									$social_page_active = json_decode($social_page_active);
									$socialmedia_name = $social_page_active->name;
									$link = "http://www.facebook.com/" . $social_page_active->id;
								}else if ($k == "twitter"){
									$social_data = json_decode($v->social_data);
									$socialmedia_name = $social_data->name;
									$link = "http://www.twitter.com/" . $social_data->screen_name;
								}
							?>
							<li class="col-sm-12 col-xs-6"><a href="<?php echo $link; ?>" target="_blank"><i class="icon-<?php echo $k; ?>"></i> <?php echo ucfirst( $socialmedia_name ); ?></a></li>
							<?php
							}
							?>
							
							<?php /*
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-facebook"></i> <?php echo ucwords($this->business->business_name); ?></a></li>
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-twitter"></i> <?php echo ucwords($this->business->business_name); ?></a></li>
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-gplus"></i> <?php echo ucwords($this->business->business_name); ?></a></li>
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-instagram"></i> <?php echo ucwords($this->business->business_name); ?></a></li>
							<li class="col-sm-12 col-xs-6"><a href="#"><i class="icon-tumblr"></i> <?php echo ucwords($this->business->business_name); ?></a></li> */ ?>
						</ul>
					</div>
				<!-- .profile-social --></div>
			</div>

			<?php if ($this->type == "business"){ ?>
		
			<div class="section-header">
				<div class="row">
					<div class="col-md-7 col-xs-5 section-title">
						<h3>Project Post <?php echo ucwords($this->business->business_name); ?></h3>
					</div>

					<?php /*
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
					 * 
					 */ ?>
				</div>
			<!-- .section-header --></div>

			<div class="row projects projects-list">
				
				<?php
				if (!empty($this->projects)){
				 
					foreach($this->projects as $k=>$v){ 
				?>
				
				<div class="col-xs-12 project-item">				
					<div class="box">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								
								<?php 
								if (empty($v->photo_file)){
									$photo = $v->project_primary_photo;
								}else{
									$photo = $v->photo_file;
								}
								$photo = $this->mediamanager->getPhotoUrl($photo, "200x125");
								?>
								
								<img style="max-width:200px;" class="project-thumb" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo ucwords($v->project_name); ?>" />
							</div>

							<div class="col-md-7 col-sm-6">
								<h3 class="project-title"><?php echo ucwords($v->project_name); ?></h3>
								<span class="project-author">by <a href="<?php echo base_url() . $this->business->business_uri; ?>"><?php echo $this->business->business_name; ?></a></span>
								
								<?php 
								$project_period = strtotime($v->project_period);
								$project_now = strtotime(date('Y-m-d H:i:s'));
								$period = $project_period - $project_now;
								$period = ($period > 0) ? date('d', $period) : 0; 
								
								?>
								
								<span class="project-expiry"><?php echo $period; ?> Day<?php echo ($period == 1) ? '' : 's'; ?> Left</span>
								<span class="project-date">Posted on <?php echo date('d M Y', strtotime($v->project_posted)); ?></span>
							</div>

							<div class="col-sm-2">
								<a class="btn btn-green project-join" href="<?php echo base_url(); ?>project/<?php echo $v->project_uri; ?>">Join Now!</a>
							</div>
						</div>
					</div>
				<!-- .project-item --></div>
				
				<?php 
					}

				?>
				
				<div class="content-nav project-nav" style="margin-left: 12px;">
				<?php 
				if (!empty($pagination)) echo $pagination;
				?>
				</div>
				
				<?php
					
				}else{
					
				?>
				
				<div class="alert alert-warning">Tidak ada project</div>
				
				<?php
					
				}
				?>


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
			<!-- .projects -->
				 * 
				 */ ?>
				 
			</div>	 
			
			<?php /*	
			<div class="content-nav project-nav">
				<span class="current">1</span>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#">5</a>
			<!-- .content-nav --></div>
			*/ ?>
			
			<?php } ?>
			
		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>