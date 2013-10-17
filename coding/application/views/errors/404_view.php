<?php $this->load->view('a/general/head_view', $this->data); ?>

	<body class="error404">

		<img src="<?php echo cdn_url(); ?>img/bg-error.png" alt="error" />

		<div class="container">
			<h1>Error 404</h1>
			<p>Sorry something's wrong!</p>
			<a class="btn btn-big btn-wd btn-yellow" href="<?php echo base_url(); ?>">Back</a>
		</div>
		
<?php $this->load->view('a/general/footer_head_view', $this->data); ?>