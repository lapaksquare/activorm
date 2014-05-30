<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="block block-light">
			<div class="container">

				<ol class="breadcrumb">
					<li><a href="##">All Deals</a></li>
					<li class="active">Nama Deal</li>
				</ol>

				<div class="row deal deal-single">
					<div class="col-sm-6 deal-slides">
						<div id="carousel-deal" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carousel-deal" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-deal" data-slide-to="1"></li>
								<li data-target="#carousel-deal" data-slide-to="2"></li>
							</ol>

							<div class="carousel-inner">
								<div class="item active">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/img-carousel-1.jpg" alt="#">
								</div>
								<div class="item">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/img-carousel-2.jpg" alt="#">
								</div>
								<div class="item">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/img-carousel-1.jpg" alt="#">
								</div>
							</div>
						</div>
					<!-- .deal-slides --></div>

					<div class="col-sm-6 deal-details">
						<div class="deal-box">
							<h1 class="deal-title"><span>Cupcake Bouquet From Hitokuchi Shoppu</span></h1>

							<div class="row deal-action">
								<div class="col-xs-7">
									<div class="deal-prices">
										<strong>Rp 156.000</strong>
										<del>Rp 112.000</del>
									</div>
								</div>

								<div class="col-xs-5">
									<a class="btn btn-big btn-block btn-green" href="#">Buy Now</a>
								</div>
							</div>

							<div class="row deal-meta">
								<div class="col-xs-2">
									<div class="deal-sale">
										disc
										<strong>65%</strong>
									</div>
								</div>

								<div class="col-xs-5">
									<div class="deal-time">
										<small>Time Remaining</small>
										<strong>02 : 52 : 08</strong>
									</div>
								</div>

								<div class="col-xs-5">
									<ul class="deal-share">
										<li class="share-facebook" data-url="http://google.com" data-text="Sharing text goes here" data-title="share"></li>
										<li class="share-twitter" data-url="http://google.com" data-text="Sharing text goes here" data-title="tweet"></li>
										<li class="share-googleplus" data-url="http://google.com" data-text="Sharing text goes here" data-title="+1"></li>
									</ul>
								</div>
							</div>

							<div class="deal-content">
								<p>Try shoes liquid elektrik, protection from mosquitos for you and your family. Try shoes liquid elektrik, protection from mosquitos for you and your family.</p>
							</div>
						</div>
					<!-- .deal-details --></div>
				<!-- .deal-single --></div>

				<div class="row related-deals">
					<div class="col-xs-12">
						<h2 class="block-subtitle">Another Deals</h2>
					</div>

					<div class="col-xs-6 col-sm-3 deal">
						<div class="deal-box">
							<div class="deal-thumb">
								<a href="#"><img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-1.jpg" alt="deal title" /></a>
							</div>

							<h3 class="deal-title">Denim & Reality Shirt</h3>

							<div class="deal-prices">
								<strong>Rp 156.000</strong>
								<del>Rp 112.000</del>
							</div>
						</div>
					<!-- .deal --></div>

					<div class="col-xs-6 col-sm-3 deal">
						<div class="deal-box">
							<div class="deal-thumb">
								<a href="#"><img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-2.jpg" alt="deal title" /></a>
							</div>

							<h3 class="deal-title">Denim & Reality Shirt</h3>

							<div class="deal-prices">
								<strong>Rp 156.000</strong>
								<del>Rp 112.000</del>
							</div>
						</div>
					<!-- .deal --></div>

					<div class="col-xs-6 col-sm-3 deal">
						<div class="deal-box">
							<div class="deal-thumb">
								<a href="#"><img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-1.jpg" alt="deal title" /></a>
							</div>

							<h3 class="deal-title">Denim & Reality Shirt</h3>

							<div class="deal-prices">
								<strong>Rp 156.000</strong>
								<del>Rp 112.000</del>
							</div>
						</div>
					<!-- .deal --></div>

					<div class="col-xs-6 col-sm-3 deal">
						<div class="deal-box">
							<div class="deal-thumb">
								<a href="#"><img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/deal-2.jpg" alt="deal title" /></a>
							</div>

							<h3 class="deal-title">Denim & Reality Shirt</h3>

							<div class="deal-prices">
								<strong>Rp 156.000</strong>
								<del>Rp 112.000</del>
							</div>
						</div>
					<!-- .deal --></div>
				<!-- .deals --></div>

			</div>
		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>