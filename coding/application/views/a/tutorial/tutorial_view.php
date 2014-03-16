<?php $this->load->view('a/general/header_view', $this->data); ?>
<div class="tutorial-inner-container">	
	
	<div class="section tutorial-container" style="opacity:1;">
		
		<div class="head-tutorial">
			<h3>How to Use<br />Activorm?</h3>
			<img src="<?php echo cdn_url(); ?>images/tutorial/logo.jpg" />
		</div>
		
		<div class="orang-container orang1 cl-effect-12">
			<div class="btn-ttt text" data-id="#t_user">for<br /><span>User</span></div>
			<div class="orang1-body"><img src="<?php echo cdn_url(); ?>images/tutorial/orang1.png" /></div>
		</div>
		
		<div class="orang-container orang2 cl-effect-12">
			<div class="btn-ttt text" data-id="#t_business">for<br /><span>Business</span></div>
			<div class="orang1-body"><img src="<?php echo cdn_url(); ?>images/tutorial/orang2.png" /></div>
		</div>
		
	</div>
	
	<div class="section tutorial-container-t1" id="t_user">
		
		<div class="btn-remove" id="btn-remove"></div>
		
		<div class="tutorial-container-t1-body">
			<div class="menu-tutorial" id="menu-tutorial-t1">
				<ul>
					<li class="btn-active" data-id="#img-ot1">Sign up & Activation</li>
					<li data-id="#img-ot2">Join the project</li>
					<li data-id="#img-ot3">Tickets</li>
				</ul>
			</div>
			<div class="tutorial-body-str">
				<img src="<?php echo cdn_url(); ?>images/tutorial/tuser1.jpg" class="img-ot1 img-ot" id="img-ot1" style="display:block;" />
				<img src="<?php echo cdn_url(); ?>images/tutorial/tuser2.jpg" class="img-ot2 img-ot" id="img-ot2" />
				<img src="<?php echo cdn_url(); ?>images/tutorial/tuser3.jpg" class="img-ot3 img-ot" id="img-ot3" />
			</div>
		</div>
		
	</div>	
	
	<div class="section tutorial-container-t1" id="t_business">
		
		<div class="btn-remove" id="btn-remove"></div>
		
		<div class="tutorial-container-t1-body">
			<div class="menu-tutorial" id="menu-tutorial-t1">
				<ul>
					<li class="btn-active" data-id="#img-ot1">Business Registration</li>
					<li data-id="#img-ot2">Social Media Connect</li>
					<li data-id="#img-ot3">Create Project</li>
				</ul>
			</div>
			<div class="tutorial-body-str">
				<img src="<?php echo cdn_url(); ?>images/tutorial/tbusiness1.jpg" class="img-ot1 img-ot" id="img-ot1" style="display:block;" />
				<img src="<?php echo cdn_url(); ?>images/tutorial/tbusiness2.jpg" class="img-ot2 img-ot" id="img-ot2" />
				<img src="<?php echo cdn_url(); ?>images/tutorial/tbusiness3.jpg" class="img-ot3 img-ot" id="img-ot3" />
			</div>
		</div>
		
	</div>	
	
</div>	
<?php $this->load->view('a/general/footer_view', $this->data); ?>	