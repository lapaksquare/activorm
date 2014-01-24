<?php $this->load->view('a/general/header_widget_view', $this->data); ?>

<style type="text/css">
	.counter-num{
		font-size: 13px !important;
	}
	.entry-counter .counter-num strong{
		font-size: 40px !important;
	}
	.entry-counter .counter-sep{
		font-size: 30px !important;
	}
	.box{
		border-bottom: 1px solid #e5e5e5;
		border-radius:0;
		padding:0;
	}
		.col-sm-5, .col-sm-6{
			padding-right:0;
			padding-left:0;
		}
		.row{
			margin-right:0;
			margin-left:0;
		}
		.box{
			padding-bottom:10px;
			margin-bottom:0;
		}
		.entry-content{
			padding: 0 10px;
			margin-bottom: 0;
		}
		.entry-content h3{
			padding-top: 0px;
			margin-top: 15px;
			font-size: 14px;
			margin-bottom: 5px;
		}
		.entry-content p{
			margin-bottom:10px;
			font-size:13px;
		}
		.entry-counter{
			margin-left:0;
		}
		.form-group{
			margin-bottom: 10px;
		}
		.wizard-step h2{
			font-size: 15px;
		}
		.btn-fb, a.btn-fb{
			padding: 10px 20px 8px !important;
			font-size: 15px;
		}
		.input-sm{
			padding: 10px !important;
			font-size: 14px !important;
			height: 40px !important;
		}
		.btn-login{
			padding: 10px 30px 8px;
			font-size: 17px;
		}
	@media (max-width: 768px){
		.entry-counter{
			padding-top:10px;
		}
		.entry-counter h4 {
			padding-top: 0px;
		}
		.entry-image img{
			width:100%;
		}
	}
</style>

<div class="row" style="padding:0;margin:0;">
	<div id="content" class="col-md-12" style="padding-right:0;padding-left:0;">	
		
		<div class="box" style="margin-bottom:5px;">
						
			<div class="row">

				<div class="col-sm-5">
					<div class="entry-image">
						
						<div class="members-count" style="top:-10px;left:30px;"><strong><?php echo $jml_tiket; ?></strong><br /> Member<?php echo ($jml_tiket > 1) ? 's' : ''; ?></div>
						
						<?php 
						
						/*
						if (empty($project_prize)){
							$photo = 'img/bg-banner-blog.png';
						}else{
							$photo = $project_prize->prize_primary_photo;
							//$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
						}*/
						
						$photo = $this->project->project_primary_photo;
						$photo = $this->mediamanager->getPhotoUrl($photo, "300x300");
						?>
						<img class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->project->project_uri; ?>" />
					</div>
				</div>
		
				<div class="col-sm-6">
					<div class="clearfix entry-counter" style="padding-top:10px;">
						
						<?php 
							$tiket_enddate = strtotime($this->project->project_period);
							$server_end = strtotime($this->project->project_period);
							$server_start = strtotime(date('Y-m-d H:i:s'));
							
							$project_period = strtotime($this->project->project_period);
							$project_now = strtotime(date('Y-m-d H:i:s'));
							//$period = $project_period - $project_now;
							//$period = date('d', $period); 
							
							$stoped = 0;
							//if ( ($server_start >= $server_end && $server_start <= $tiket_enddate) || $this->input->get_post('tiketstart') == 1 ){
							if ($project_period < $project_now || in_array($this->project->project_live, array('Draft', 'Offline'))){	
								//redirect(base_url() . '404');
								if ($project_period < $project_now) { $stoped = 1;
						?>
						
						<h4 style="text-align: center;"><?php echo ucwords($this->project->project_name); ?></h4>
						<div class="label label-danger" style="margin-top:12px;display:inline-block;">Project Closed</div>	
						<br />										
						<?php }else{ ?>
						
						<h4 style="text-align: center;"><?php echo ucwords($this->project->project_name); ?>.</h4>
						
						<p style="text-align: center;">Project belum dimulai</p>
						
						<?php } ?>
						
						<div class="counter-num"><strong id="hari">00</strong> Days</div>
						<div class="counter-sep">:</div>
						<div class="counter-num"><strong id="jam">00</strong> Hours</div>
						<div class="counter-sep">:</div>
						<div class="counter-num"><strong id="menit">00</strong> Minutes</div>
						
						<?php		
								
							}else{
						?>
						
						<h4 style="text-align: center;margin-bottom:5px;"><?php echo ucwords($this->project->project_name); ?></h4>
						
						<script type="text/javascript">
							var server_end = <?php echo $server_end * 1000; ?>;
							var server_start = <?php echo $server_start * 1000; ?>;
							var client = new Date().getTime();
							var end = server_end - server_start + client;
							var _second = 1000;
							var _minute = _second * 60;
							var _hour = _minute * 60;
							var _day = _hour * 24;
							var timer;
							function showCountdown(){
								var now = new Date();
								var distance = end - now;
								if (distance < 0){
									clearInterval(showCountdown);
									window.location = window.location;
									//document.getElementById('countdown_container').style.display = "none";
								}
								var days = Math.floor(distance / _day);
								var hours = Math.floor( (distance % _day) / _hour );
								var total_hours = (days * 24) + hours;
								var minutes = Math.floor( (distance % _hour) / _minute );
								var seconds = Math.floor( (distance % _minute) / _second );
								
								var days_html = document.getElementById('hari');
								var hours_html = document.getElementById('jam');
								var menit_html = document.getElementById('menit');
								var detik_html = document.getElementById('detik');
								
								days_html.innerHTML = days;
								hours_html.innerHTML = hours;
								menit_html.innerHTML = minutes;
								//detik_html.innerHTML = seconds;
							}
							timer = setInterval(showCountdown, 10);
						</script>
							
						<div class="counter-num"><strong id="hari">00</strong> Days</div>
						<div class="counter-sep">:</div>
						<div class="counter-num"><strong id="jam">00</strong> Hours</div>
						<div class="counter-sep">:</div>
						<div class="counter-num"><strong id="menit">00</strong> Minutes</div>
						
						<?php 
							}
						?>
						
					<!-- .entry-counter --></div>
					
				</div>
				
			</div>
		</div>	
		
		<div class="box" style="padding-bottom:0;">
						
			<div class="row">
				
				
			   <ul id="project-tab" class="nav nav-tabs">
		        <li class="active"><a href="#tab-entertowin" data-toggle="tab">Enter to Win</a></li>
		        <li class=""><a href="#tab-description" data-toggle="tab">Description</a></li>
		      </ul>
				
				<div class="project-tab-content tab-content">
					
					<div class="tab-pane fade active in tab-entertowin" id="tab-entertowin">
					
						<div class="wizard-project" style="margin:0;">
							<div class="wizard-step step-4" style="padding:25px;">
								<h2>Please complete your contact information</h2>
								<a class="btn btn-big btn-yellow btn-login" href="<?php echo base_url(); ?>settings/contact" id="navbar-settings">Settings</a>
								<?php /*
								<a class="btn btn-big btn-yellow" href="#">Download Voucher</a> */ ?>
							</div>
						<!-- .wizard-project --></div>
						
					</div>
					
					<div class="tab-pane fade tab-description" id="tab-description">	
					
						<div class="entry-content">
							<h3 class="green">Program Description</h3>
							<p>
								<?php echo nl2br( ucfirst($this->project->project_description) ); ?>
							</p>
							<div class="clearfix"></div>		
						</div>
					
					</div>
					
				</div>	
				
			</div>
			
		</div>			
			
	</div>
</div>				

<?php $this->load->view('a/general/footer_widget_view', $this->data); ?>