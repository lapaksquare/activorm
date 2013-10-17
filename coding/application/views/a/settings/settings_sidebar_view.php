<div id="sidebar" class="col-md-3 col-md-pull-9">
	<div class="widget widget-pages">
		<ul class="list-unstyled">
			
			<?php 
			$menus = array(
				'contact' => array(
					'name' => 'Contact Information',
					'link' => base_url()
				),
				'socialmedia' => array(
					'name' => 'Social Media Connect',
					'link' => base_url()
				),
				'email' => array(
					'name' => 'Email Preference',
					'link' => base_url()
				),
				'password' => array(
					'name' => 'Password',
					'link' => base_url()
				),
				'deleteaccount' => array(
					'name' => 'Delete Account',
					'link' => base_url()
				)
			);
			
			foreach($menus as $k=>$v){
				
				$class = ($k == $submenu) ? 'active' : '';
			?>
			
			<li class="<?php echo $class; ?>"><a href="<?php echo $v['link']; ?>"><?php echo $v['name']; ?></a></li>
			
			<?php } ?>

		</ul>
	<!-- .widget --></div>
<!-- #sidebar --></div>