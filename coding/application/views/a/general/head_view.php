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
		<meta property="og:site_name" content=""/>	
		<meta property="og:type" content="website"/>
		<meta property="fb:admins" content=""/>
		<meta property="fb:app_id" content=""/>
		
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
	    </script>
	
	</head>