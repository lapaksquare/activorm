		<div id="extra">
			<div class="container">

				<?php $this->load->view('a/general/footer_menu', $this->data); ?>
				
		<!-- #extra --></div>

		<div id="footer">
			<div class="container">
				Handcrafted in Indonesia. &copy; <?php echo date('Y'); ?> Activorm. All rights reserved.
			</div>
		<!-- #footer --></div>
		
		</div>
		
<?php $this->load->view('a/home/register_modal_view', $this->data); ?>		
		
<?php $this->load->view('a/general/footer_head_view', $this->data); ?>