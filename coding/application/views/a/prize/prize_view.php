<?php $this->load->view('a/general/header_view', $this->data); ?>

	<?php $this->load->view('a/home/searchbar_view', $this->data); ?>

		<div id="content" class="block block-white">
			<div class="container">

				<div class="page-header">
					<h1 class="page-title smaller-title" style="float:left;">All Prize</h1>
					
					<div class="pull-right">
						<select id="prize_drop" class="form-control">
							<?php 
							$prize_drop = array(
								'Online' => 'On-Going Projects',
								'Closed' => 'Closed'
							);
							foreach($prize_drop as $k=>$v){
								$class = ($k == $this->project_live) ? 'selected' : '';
							?>
							<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
							<?php } ?>
						</select>
					</div>
					
					<div class="clearfix"></div>
					
				</div>

				<div class="row list-items">
					
					<?php  
					foreach($product_prize as $k=>$v){
						$photo = $this->mediamanager->getPhotoUrl($v->prize_primary_photo, "211x155");
						
						$enter_now = ($v->project_live == "Online") ? 'Enter Now' : 'View';
						
					?>
					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $v->prize_name; ?>" style="margin:0 auto;" />
						</div>

						<h3 class="item-title"><?php echo ucwords($v->project_name); ?></h3>

						<a class="btn btn-green btn-prize-c" href="<?php echo base_url() . 'prize/' . $v->prize_uri; ?>"><?php echo $enter_now; ?></a>
					<!-- .item --></div>
					<?php } ?>
					
					<?php /*
					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-02.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-03.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-04.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-05.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-06.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-07.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-08.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-01.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-02.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-03.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-04.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-05.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-06.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-07.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div>

					<div class="col-md-3 col-sm-4 item">
						<div class="item-thumbnail">
							<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-08.jpg" alt="#" />
						</div>

						<h3 class="item-title">Win a Macbook Pro</h3>

						<a class="btn btn-green" href="#">Enter Now</a>
					<!-- .item --></div> */ ?>
					
				<!-- .list-items --></div>
					
				<div class="content-nav project-nav" style="margin-left: 12px;">
				<?php 
				if (!empty($pagination)) echo $pagination;
				?>
				</div>	
					
				<?php /*	
				<div class="content-nav product-nav">
					<span class="current">1</span>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">4</a>
					<a href="#">5</a>
				<!-- .content-nav --></div> */ ?>

			</div>
		<!-- #content --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>