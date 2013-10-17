<?php $this->load->view('a/general/header_view', $this->data); ?>

<?php $this->load->view('a/home/searchbar_view', $this->data); ?>

		<div id="content" class="block block-white">
			<div class="container">

				<div class="page-header">
					<h1 class="page-title">"Starbucks"</h1>
					<p>Sorry, the prize or publisher you are looking for is unavailable at the moment.<br /> Do you want to submit a suggestion?</p>
					<a class="btn btn-green" href="#">Cancel</a>				
					<a class="btn btn-green" href="#">Submit</a>				
				</div>

				<div class="row">
					<div class="col-md-9 col-md-push-3">

						<div class="row list-items">
							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-01.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-02.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-03.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-04.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-05.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro with a Very Long Title Could Go Here for Testing Purpose Only</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-06.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-07.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-08.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-01.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>
						<!-- .list-items --></div>

						<div class="content-nav product-nav">
							<span class="current">1</span>
							<a href="#">2</a>
							<a href="#">3</a>
							<a href="#">4</a>
							<a href="#">5</a>
						<!-- .content-nav --></div>
					</div>

					<div class="col-md-3 col-md-pull-9">
						<div class="widget widget-filter">
							<h3 class="widget-title">Category</h3>

							<form class="form-activorm" action="#" method="get">
								<div class="form-label">
									<label for="prize" class="form-label">Prize</label>
								</div>
								<div class="form-group">
									<input type="checkbox" class="custom-checkwhite" value="prize-gadget" name="search-prize" data-label="Gadget" />
									<input type="checkbox" class="custom-checkwhite" value="prize-voucher" name="search-prize" data-label="Vouchers &amp; Discounts" />
									<input type="checkbox" class="custom-checkwhite" value="prize-ticket" name="search-prize" data-label="Tickets" />
									<input type="checkbox" class="custom-checkwhite" value="prize-promo" name="search-prize" data-label="Promotional Items" />
									<input type="checkbox" class="custom-checkwhite" value="prize-cash" name="search-prize" data-label="Cash" />
									<input type="checkbox" class="custom-checkwhite" value="prize-other" name="search-prize" data-label="Others" />
								</div>

								<div class="form-label">
									<label for="prize" class="form-label">Interest/Publishers</label>
								</div>
								<div class="form-group">
									<input type="checkbox" class="custom-checkwhite" value="prize-food" name="search-interest" data-label="Food" />
									<input type="checkbox" class="custom-checkwhite" value="prize-fashion" name="search-interest" data-label="Fashion" />
									<input type="checkbox" class="custom-checkwhite" value="prize-tech" name="search-interest" data-label="Tech" />
									<input type="checkbox" class="custom-checkwhite" value="prize-social" name="search-interest" data-label="Social" />
									<input type="checkbox" class="custom-checkwhite" value="prize-automotive" name="search-interest" data-label="Automotive" />
									<input type="checkbox" class="custom-checkwhite" value="prize-travel" name="search-interest" data-label="Travel" />
									<input type="checkbox" class="custom-checkwhite" value="prize-politic" name="search-interest" data-label="Politic" />
								</div>

								<div class="form-submit">
									<button type="submit" class="btn btn-big btn-wd btn-blue">Search</button>
								</div>
							</form>
						<!-- .widget-filter --></div>
					</div>
				</div>

			</div>
		<!-- #content --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>