<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Press</h1>
				<div class="clearfix"></div>
			</div>

			<div id="press" class="box">
				
				<?php 
				$medias = array(
					'december_2013' => array(
						'name' => 'December 2013',
						'press' => array(
							'dailysocial' => array(
								'img' => cdn_url() . 'images/press/dailysocial.png',
								'link' => 'http://dailysocial.net/post/activorm-bantu-aktivasi-promosi-di-media-sosial-pertemukan-keinginan-konsumen-dan-merchant-dalam-bentuk-hadiah',
								'name' => 'Activorm Bantu Aktivasi Promosi di Media Sosial, Pertemukan Keinginan Konsumen dan Merchant...'
							),
							'techinasia' => array(
								'img' => cdn_url() . 'images/press/techinasia.png',
								'link' => 'http://id.techinasia.com/activorm-bantu-kumpulkan-pengikut-media-sosial-melalui-undian-berhadiah/',
								'name' => 'Activorm bantu kumpulkan pengikut media sosial melalui undian berhadiah'
							),
							'startupbisnis' => array(
								'img' => cdn_url() . 'images/press/startupbisnis.png',
								'link' => 'http://startupbisnis.com/activorm-satu-lagi-startup-baru-karya-anak-indonesia/',
								'name' => 'Activorm: Satu Lagi Startup Baru Karya Anak Indonesia'
							)
						)
					),
					'januari_2014' => array(
						'name' => 'Januari 2014',
						'press' => array(
							'dailysocial' => array(
								'img' => cdn_url() . 'images/press/dailysocial.png',
								'link' => 'http://dailysocial.net/post/activorm-buka-akses-ke-publik-umumkan-fitur-baru-dan-kesuksesan-fase-private-beta',
								'name' => 'Activorm Buka Akses ke Publik, Umumkan Fitur Baru dan Kesuksesan Fase Private Beta'
							),
							'e27' => array(
								'img' => cdn_url() . 'images/press/e27.png',
								'link' => 'http://e27.co/facebook-advtg-expensive-startup-activorm-solution/',
								'name' => 'Facebook advtg too expensive for your startup? Activorm has a solution'
							),
							'startupbisnis' => array(
								'img' => cdn_url() . 'images/press/startupbisnis.png',
								'link' => 'http://startupbisnis.com/activorm-secara-resmi-di-buka-untuk-publik/',
								'name' => 'Activorm Secara Resmi di Buka Untuk Publik'
							)
						)
					)
				);
				?>
				
				<?php 
				
				foreach($medias as $k=>$v){
					
				?>
				
				<h3 class="box-subtitle green"><?php echo $v['name']; ?></h3>
				<div class="row press-group">
					
					<?php foreach($v['press'] as $a=>$b){ ?>
					<div class="col-md-6">
						<div class="media">
							<a class="pull-left" href="<?php echo $b['link']; ?>" target="blank">
								<img class="media-object" src="<?php echo $b['img']; ?>" alt="<?php echo $b['name']; ?>" />
							</a>
							<div class="media-body">
								<a href="<?php echo $b['link']; ?>" target="blank"><p><?php echo $b['name']; ?></p></a>
							</div>
						<!-- .media --></div>
					</div>
					<?php } ?>
					
				<!-- .press-group --></div>
				
				<?php	
					
				}
				
				?>

			</div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>