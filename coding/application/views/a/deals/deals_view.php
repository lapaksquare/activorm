<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="banner" class="block" style="background:#000;">

			<?php /*	
			<img class="img-responsive" src="<?php echo cdn_url(); ?><?php echo cdn_url(); ?>img/bg-header-projects.png" alt="#" style="margin:0 auto;" /> */ ?>
			
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
						
						$utm = array(
							'utm_source' => 'banner_ads',
							'utm_medium' => 'banner',
							'utm_campaign' => $v->banner_name
						);
						
				  	?>
				  	<div class="item <?php echo $class; ?>">
				  		<a href="<?php echo $v->banner_link; ?>?<?php echo http_build_query($utm); ?>">
				      <img src="<?php echo cdn_url() . $v->banner_image; ?>" alt="<?php echo $v->banner_name; ?>" />
				      	</a>
				    </div>
				    <?php 
					}
				    ?>
				    
				    <?php /*
				    <div class="item">
				      <img src="http://bejanamu.local/<?php echo cdn_url(); ?>img/b1.jpg" alt="b1" />
				    </div>
				    <div class="item">
				      <img src="http://bejanamu.local/<?php echo cdn_url(); ?>img/b2.jpg" alt="b1"/>
				    </div>
				    <div class="item">
				      <img src="http://bejanamu.local/<?php echo cdn_url(); ?>img/b3.jpg" alt="b1" />
				    </div>
				    <div class="item">
				      <img src="http://bejanamu.local/<?php echo cdn_url(); ?>img/b4.jpg" alt="b1" />
				    </div>
				    <div class="item">
				      <img src="http://bejanamu.local/<?php echo cdn_url(); ?>img/b5.jpg" alt="b1" />
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
		


	<div id="main" class="block block-light">
			<div class="container">

				<div class="page-header">
					<h1 class="pull-left page-title">All Deals</h1>
					<div class="clearfix"></div>
				</div>

				<div class="row deals">
					<div class="col-sm-6 col-md-4 deal">
						<div class="deal-box">
							<h3 class="deal-title"><span>Cupcake Bouquet From Hitokuchi Shoppu</span></h3>

							<div class="deal-thumb">
								<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-1.jpg" alt="deal title" />
								<div class="deal-sale">
									disc
									<strong>65%</strong>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="deal-excerpt">Try Shoes Liquid Elektrik, Protection from Mosquitos You and Your Family</p>
								</div>

								<div class="col-xs-6">
									<div class="deal-prices">
										<strong>Rp 156.000</strong>
										<del>Rp 112.000</del>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-8">
									<div class="deal-time">
										<small>Time Remaining</small>
										<strong>02 : 52 : 08</strong>
									</div>
								</div>

								<div class="col-xs-4">
									<a class="deal-more" href="#">View</a>
								</div>
							</div>
						</div>
					<!-- .deal --></div>

					<div class="col-sm-6 col-md-4 deal">
						<div class="deal-box">
							<h3 class="deal-title"><span>Denim & Reality Shirt</span></h3>

							<div class="deal-thumb">
								<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-2.jpg" alt="deal title" />
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="deal-excerpt">Try Shoes Liquid Elektrik, Protection from Mosquitos You and Your Family</p>
								</div>

								<div class="col-xs-6">
									<div class="deal-prices">
										<strong>Rp 156.000</strong>
										<del>Rp 112.000</del>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-8">
									<div class="deal-time">
										<small>Time Remaining</small>
										<strong>02 : 52 : 08</strong>
									</div>
								</div>

								<div class="col-xs-4">
									<a class="deal-more" href="#">View</a>
								</div>
							</div>
						</div>
					<!-- .deal --></div>

					<div class="col-sm-6 col-md-4 deal">
						<div class="deal-box">
							<h3 class="deal-title"><span>Cupcake Bouquet From Hitokuchi Shoppu</span></h3>

							<div class="deal-thumb">
								<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-1.jpg" alt="deal title" />
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="deal-excerpt">Try Shoes Liquid Elektrik, Protection from Mosquitos You and Your Family</p>
								</div>

								<div class="col-xs-6">
									<div class="deal-prices">
										<strong>Rp 156.000</strong>
										<del>Rp 112.000</del>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-8">
									<div class="deal-time">
										<small>Time Remaining</small>
										<strong>02 : 52 : 08</strong>
									</div>
								</div>

								<div class="col-xs-4">
									<a class="deal-more" href="#">View</a>
								</div>
							</div>
						</div>
					<!-- .deal --></div>

					<div class="col-sm-6 col-md-4 deal">
						<div class="deal-box">
							<h3 class="deal-title"><span>Denim & Reality Shirt</span></h3>

							<div class="deal-thumb">
								<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-2.jpg" alt="deal title" />
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="deal-excerpt">Try Shoes Liquid Elektrik, Protection from Mosquitos You and Your Family</p>
								</div>

								<div class="col-xs-6">
									<div class="deal-prices">
										<strong>Rp 156.000</strong>
										<del>Rp 112.000</del>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-8">
									<div class="deal-time">
										<small>Time Remaining</small>
										<strong>02 : 52 : 08</strong>
									</div>
								</div>

								<div class="col-xs-4">
									<a class="deal-more" href="#">View</a>
								</div>
							</div>
						</div>
					<!-- .deal --></div>

					<div class="col-sm-6 col-md-4 deal">
						<div class="deal-box">
							<h3 class="deal-title"><span>Cupcake Bouquet From Hitokuchi Shoppu</span></h3>

							<div class="deal-thumb">
								<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-1.jpg" alt="deal title" />
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="deal-excerpt">Try Shoes Liquid Elektrik, Protection from Mosquitos You and Your Family</p>
								</div>

								<div class="col-xs-6">
									<div class="deal-prices">
										<strong>Rp 156.000</strong>
										<del>Rp 112.000</del>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-8">
									<div class="deal-time">
										<small>Time Remaining</small>
										<strong>02 : 52 : 08</strong>
									</div>
								</div>

								<div class="col-xs-4">
									<a class="deal-more" href="#">View</a>
								</div>
							</div>
						</div>
					<!-- .deal --></div>

					<div class="col-sm-6 col-md-4 deal">
						<div class="deal-box">
							<h3 class="deal-title"><span>Denim & Reality Shirt</span></h3>

							<div class="deal-thumb">
								<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-2.jpg" alt="deal title" />
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="deal-excerpt">Try Shoes Liquid Elektrik, Protection from Mosquitos You and Your Family</p>
								</div>

								<div class="col-xs-6">
									<div class="deal-prices">
										<strong>Rp 156.000</strong>
										<del>Rp 112.000</del>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-8">
									<div class="deal-time">
										<small>Time Remaining</small>
										<strong>02 : 52 : 08</strong>
									</div>
								</div>

								<div class="col-xs-4">
									<a class="deal-more" href="#">View</a>
								</div>
							</div>
						</div>
					<!-- .deal --></div>
				<!-- .deals --></div>

				<div class="content-nav product-nav">
					<span class="current">1</span>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">4</a>
					<a href="#">5</a>
				<!-- .content-nav --></div>

			</div>
		<!-- #main -->
	</div>		
		

<?php $this->load->view('a/general/footer_view', $this->data); ?>