<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title><?php echo $title; ?></title>
		<meta name="description" content="<?php echo (!empty($metaDescription)) ? $metaDescription : META_DESCRIPTION; ?>" />
		<meta name="keywords" content="<?php echo (!empty($metaKeywords)) ? $metaKeywords : META_KEYWORDS; ?>" />
		<meta name="robots" content="index, follow" />
		<link rel="canonical" href="<?php echo current_url(); ?>"/>

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php echo $css_tags; ?>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?php echo cdn_url(); ?>js/html5shiv.min.js"></script>
			<script src="<?php echo cdn_url(); ?>js/respond.min.js"></script>
		<![endif]-->
		
		<meta property="og:image" content="<?php echo (empty($metaImage)) ? cdn_url() . "img/logo.png" : $metaImage; ?>"/>
		<meta property="og:title" content="<?php echo $title; ?>"/>
		<meta property="og:description" content="<?php echo (!empty($metaDescription)) ? $metaDescription : META_DESCRIPTION; ?>"/>
		<meta property="og:url" content="<?php echo current_url(); ?>"/>
		<meta property="og:site_name" content="<?php echo base_url(); ?>"/>	
		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content="100001413525876"/>
		<meta property="fb:app_id" content="1425256081020066"/>
		
		<?php if (empty($tw_meta_product)){ ?>
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="">
		<meta name="twitter:title" content="<?php echo $title; ?>">
		<meta name="twitter:description" content="<?php echo (!empty($metaDescription)) ? $metaDescription : META_DESCRIPTION; ?>">
		<meta name="twitter:creator" content="lapaksquare">
		<meta name="twitter:image:src" content="<?php echo (empty($metaImage)) ? cdn_url() . "img/logo.png" : $metaImage; ?>">
		<meta name="twitter:domain" content="<?php echo base_url(); ?>">
		<meta name="twitter:app:name:iphone" content="">
		<meta name="twitter:app:name:ipad" content="">
		<meta name="twitter:app:name:googleplay" content="">
		<meta name="twitter:app:url:iphone" content="">
		<meta name="twitter:app:url:ipad" content="">
		<meta name="twitter:app:url:googleplay" content="">
		<meta name="twitter:app:id:iphone" content="">
		<meta name="twitter:app:id:ipad" content="">
		<meta name="twitter:app:id:googleplay" content="">
		<?php }else{ ?>
		<meta name="twitter:card" content="product">
		<meta name="twitter:site" content="">
		<meta name="twitter:creator" content="">
		<meta name="twitter:title" content="<?php echo $title; ?>">
		<meta name="twitter:description" content="<?php echo $metaDescription; ?>">
		<meta name="twitter:image:src" content="<?php echo (empty($metaImage)) ? cdn_url() . "img/logo.png" : $metaImage; ?>">
		<meta name="twitter:data1" content="<?php echo $tw_min_price; ?>">
		<meta name="twitter:label1" content="">
		<meta name="twitter:data2" content="">
		<meta name="twitter:label2" content="">
		<meta name="twitter:domain" content="<?php echo base_url(); ?>">
		<meta name="twitter:app:name:iphone" content="">
		<meta name="twitter:app:name:ipad" content="">
		<meta name="twitter:app:name:googleplay" content="">
		<meta name="twitter:app:url:iphone" content="">
		<meta name="twitter:app:url:ipad" content="">
		<meta name="twitter:app:url:googleplay" content="">
		<meta name="twitter:app:id:iphone" content="">
		<meta name="twitter:app:id:ipad" content="">
		<meta name="twitter:app:id:googleplay" content="">
		<?php } ?>		
	
		<script>
	    	<?php $preview = $this->input->get_post('Preview'); ?>
	    	var preview = <?php echo (empty($preview)) ? 0 : 1; ?>;
	    	var base_url = "<?php echo base_url(); ?>";
	    	var rs = <?php echo (!empty($this->access->member_account->register_step)) ? $this->access->member_account->register_step : 0; ?>;
	    	<?php $message_register_login_error = $this->session->userdata('message_register_login_error');
			$this->session->unset_userdata('message_register_login_error'); ?>
	   		var rs_login = <?php echo (!empty($message_register_login_error)) ? $message_register_login_error : 0 ?>;
	   		<?php $message_register_business_success = $this->session->userdata('message_register_business_success'); 
	   		$this->session->unset_userdata('message_register_business_success');
	   		?>
	   		var rs_business_register = <?php echo (!empty($message_register_business_success)) ? $message_register_business_success : 0 ?>;
	   		var show_popup_login = 0;
	   		<?php 
	   		$modal_create_project = $this->session->userdata('modal_create_project');
			$this->session->unset_userdata('modal_create_project');
	   		?>
	   		var modal_create_project = <?php echo (!empty($modal_create_project)) ? 1 : 0; ?>;
	   		<?php 
	   		$pointtopup_error = $this->session->userdata('pointtopup_error');
	   		?>
	   		var pointtopup_error = <?php echo (!empty($pointtopup_error)) ? $pointtopup_error : 0; ?>;
	   		<?php 
	   		$project_contact_info = 0;
	   		if (!empty($this->project->project_contact_info)){
	   			$project_contact_info = 1;
	   		}
	   		?>
	   		var project_contact_info = <?php echo $project_contact_info;  ?>;
	   		<?php 
	   		$msg_resend_businessaccount = $this->session->userdata('msg_resend_businessaccount');
	   		$msg_resend_businessaccount = (empty($msg_resend_businessaccount)) ? 0 : $msg_resend_businessaccount;
	   		?>
	   		var msg_resend_businessaccount = <?php echo $msg_resend_businessaccount; ?>;
	   		<?php 
	   		$message_register_error = $this->session->userdata('message_register_error');
			$message_register_error = (!empty($message_register_error)) ? 1 : 0;
	   		?>
	   		var message_register_error = <?php echo $message_register_error; ?>;
	   		<?php 
	   		$hack_register_show = $this->session->userdata('hack_register_show');
			$this->session->unset_userdata('hack_register_show');
			$hack_register_show = (!empty($hack_register_show)) ? 1 : 0;
	   		?>
	   		var hack_register_show = <?php echo $hack_register_show; ?>;
	   		var nopopuplogin = <?php echo (!empty($nopopuplogin)) ? $nopopuplogin : 0; ?>;
	    </script>
	
	</head>