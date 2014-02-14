<?php $this->load->view('a/general/header_view', $this->data); ?>
		
<style type="text/css">
	.list-merchant .item {
		margin-bottom: 20px;
		position: relative;
		height: 100px;
	}
	.list-merchant .item img {
		display: block;
		position: absolute;
		top: 0;
		bottom: 0;
		margin: auto;
		left: 50%;
		margin-left: -80px;
	}
</style>		
		
		<?php 
		if (empty($this->access->member_account)){
		?>
		
		<div id="banner" class="block block-green">
			<div class="container">

				<h2 class="block-title">Select the prize you want and enter the project</h2>
				<a class="btn btn-big btn-yellow" href="#" id="signup_btn">Sign Up for Free</a>

			</div>
		<!-- #banner --></div>
		
		<?php 
		}
		?>

		<?php $this->load->view('a/home/searchbar_view', $this->data); ?>

		<div id="content" class="block block-white">
			<div class="container">

				<div class="row list-items">
					
					<?php  
					foreach($product_prize as $k=>$v){
						
						$prize_name = $prize_uri = $photo = "";
						if ($featured_type == 3){
							$prize_name = $v->prize_name;
							$prize_uri = base_url() . 'prize/' . $v->prize_uri;
							$photo = $this->mediamanager->getPhotoUrl($v->prize_primary_photo, "211x155");
						}else if ($featured_type == 1){
							$prize_name = $v->project_name;
							$prize_uri = base_url() . 'project/' . $v->project_uri;
							$photo = $this->mediamanager->getPhotoUrl($v->prize_primary_photo, "211x155");
						}
						
						$project_name = $v->project_name;
						
					?>
					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $prize_name; ?>" style="margin:0 auto;" />
						</div>

						<h3 class="item-title"><?php echo ucwords($project_name); ?></h3>

						<a class="btn btn-green btn-prize-c" href="<?php echo $prize_uri; ?>">Enter Now</a>
					<!-- .item --></div>
					<?php } ?>
					
					<?php /*	
					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-02.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="<?php echo base_url(); ?>project/list">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-03.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="<?php echo base_url(); ?>project/list">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-04.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="<?php echo base_url(); ?>project/list">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-05.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="<?php echo base_url(); ?>project/list">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-06.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="<?php echo base_url(); ?>project/list">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-07.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="<?php echo base_url(); ?>project/list">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-08.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="<?php echo base_url(); ?>project/list">Enter Now</a>
					<!-- .item --></div>
					 * 
					 */ ?>

					<div class="clearfix"></div>

					<div class="col-xs-12">
						<a class="item-more-link" href="<?php echo base_url() . 'prize'; ?>">view more</a>
					</div>
				<!-- .list-items --></div>

			</div>
		<!-- #content --></div>

		<div id="newsletter" class="block block-blue">
			<div class="container">

				<div class="row">
					<div class="col-sm-8">
						<h2 class="block-title">Over 70 merchants already participated!</h2>
						<p>Get started today for better engagement and performance 
of your Social Networks</p>

						<a href="<?php echo base_url(); ?>business/register" class="btn btn-big btn-green" style="padding-left:60px;padding-right:60px;">Sign up for FREE Trial</a>
					</div>

					<div class="col-sm-4 col-img">
						<img class="" src="<?php echo cdn_url(); ?>img/sign-up-business.png" alt="#" />
					</div>
				</div>

			</div>
		<!-- #newsletter --></div>

		<div id="merchant" class="block block-light">
			<div class="container">

				<h2 class="block-title">Our Merchants</h2>

				<div class="row list-merchant">
					
					<?php foreach($merchants as $k=>$v){
						//$photos = (empty($v->merchant_logo)) ? $v->account_primary_photo : $v->merchant_logo;
						//if (empty($photos)) continue; 
						//$photo = $this->mediamanager->getPhotoUrl($photos, "185x90");
						//$photo = 'images/merchant/email-logo-'.$v->business_uri.'.png';
						//if (!is_file($photo)) continue;
						$photo = $v->merchant_logo;
						$photo = $this->mediamanager->getPhotoUrl($photo, "185x90");
						?>
					<div class="col-md-3 col-sm-4 col-xs-6 item" style="background:url('<?php echo cdn_url() . $photo; ?>') no-repeat center center;">
						<?php /*<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo ucwords($v->business_name); ?>" />*/ ?>
					</div>
					<?php } ?>

					<?php /*
					<div class="col-md-3 col-sm-4 col-xs-6 item">
						<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/merchant-02.gif" alt="#" />
					</div>

					<div class="col-md-3 col-sm-4 col-xs-6 item">
						<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/merchant-03.gif" alt="#" />
					</div>

					<div class="col-md-3 col-sm-4 col-xs-6 item">
						<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/merchant-04.gif" alt="#" />
					</div>

					<div class="col-md-3 col-sm-4 col-xs-6 item">
						<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/merchant-05.gif" alt="#" />
					</div>

					<div class="col-md-3 col-sm-4 col-xs-6 item">
						<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/merchant-06.gif" alt="#" />
					</div>

					<div class="col-md-3 col-sm-4 col-xs-6 item">
						<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/merchant-07.gif" alt="#" />
					</div>

					<div class="col-md-3 col-sm-4 col-xs-6 item">
						<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/merchant-08.gif" alt="#" />
					</div>
					 */ ?> 
				</div>


				<?php /*
				<div class="row list-testi">
					<div class="col-sm-6">
						<div class="media item">
							<div class="pull-left item-image">
								<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
							</div>

							<div class="media-body">
								<blockquote><p>Wooow, not have thought I won the laptop. Thank you Activorm.</p> <cite>by <strong>Shelly</strong></cite></blockquote>
							</div>
						<!-- .media --></div>
					</div>

					<div class="col-sm-6">
						<div class="media item">
							<div class="pull-left item-image">
								<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
							</div>

							<div class="media-body">
								<blockquote><p>Wooow, not have thought I won the laptop. Thank you Activorm.</p> <cite>by <strong>Shelly</strong></cite></blockquote>
							</div>
						<!-- .media --></div>
					</div>
				<!-- .list-testi --></div> */ ?>

			</div>
		<!-- #merchant --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>
