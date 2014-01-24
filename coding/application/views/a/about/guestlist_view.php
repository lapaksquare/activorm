<?php $this->load->view('a/general/header_view', $this->data); ?>

<div class="invitation">		


		<div id="banner" class="block block-green">		
			<div class="container">

				<h2 class="block-title">Thank You!</h2>

			</div>
		<!-- #banner --></div>

		<div class="block block-light">
			<div class="container">

				<div class="row list-team">
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="team-photo">
							<img src="<?php echo cdn_url(); ?>img/content/team-karen.jpg" alt="Karen Kamal" />
						</div>
						<strong>Karen Kamal</strong>
					</div>
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="team-photo">
							<img src="<?php echo cdn_url(); ?>img/content/team-sondang.jpg" alt="Sondang Hutauruk" />
						</div>
						<strong>Sondang Hutauruk</strong>
					</div>
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="team-photo">
							<img src="<?php echo cdn_url(); ?>img/content/team-novan.jpg" alt="Novano Ilham" />
						</div>
						<strong>Novano Ilham</strong>
					</div>
					<div class="col-xs-6 col-sm-4 col-md-3 col-sm-push-2 col-md-push-0">
						<div class="team-photo">
							<img src="<?php echo cdn_url(); ?>img/content/team-wicco.jpg" alt="Wicco Steven" />
						</div>
						<strong>Wicco Steven</strong>
					</div>
					<div class="col-xs-6 col-sm-4 col-md-3 col-sm-push-2 col-md-push-0">
						<div class="team-photo">
							<img src="<?php echo cdn_url(); ?>img/content/team-wendy.jpg" alt="Wendy Dewanto" />
						</div>
						<strong>Wendy Dewanto</strong>
					</div>
				<!-- .list-team --></div>

				<div class="box">
					<p>Our team would like to thank you for participating Activorm's Private Beta, especially for our Special Guests. They are great people with many experiences in startup business environment. We believe we may learn a lot from everyone in the guest list.</p>
					<p>It is our honor to welcome you in Activorm's Private Beta. We are so proud we can present Activorm as an online platform for merchants/brands, to integrate and engage better with their soon-to-be customers, and for users, they finally find an easier way to discover their wishes granted by their favorite brands.</p>
					<p>Say no more. Let ACTIVORM's Private Beta begin!</p>
				</div>


				<div class="list-guests">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#special-guests" data-toggle="tab">Special Guests</a></li>
						<li><a href="#guest-list" data-toggle="tab">Invitations</a></li>
					</ul>

					<div class="tab-content">
						<table id="guest-list" class="table table-striped tab-pane " border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<?php if (!empty($list['invitation'])){ 
									
									$c = 0;
									foreach($list['invitation'] as $k=>$v){
										if ($c == 0) echo '<tr>';
										if ($c == 4) { echo '</tr>'; $c = 0; }
										$c++;
									?>
									<td><?php echo ucwords($v->account_name); ?></td>
								
								<?php } } ?>
								
							</tbody>
						</table>

						<table id="special-guests" class="table table-striped tab-pane active" border="0" cellpadding="0" cellspacing="0">
							<thead>
								<tr>
									<th>Guest Name</th>
									<th>Startup/Company</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($list['specialguests'])){
									
									foreach($list['specialguests'] as $k=>$v){
									
									?> 
								<tr>
									<td><?php echo ucwords($v->account_name); ?></td>
									<td><?php echo ucwords($v->company); ?></td>
								</tr>
								
								<?php }
									
									}
									 ?>
								
							</tbody>
						</table>
					</div>

				<!-- .list-guests --></div>

			</div>
		<!-- .block --></div>

</div>
	
<?php $this->load->view('a/general/footer_view', $this->data); ?>