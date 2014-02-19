<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Gender &amp; Age </h2>
						</div>
						
						<?php
						$data_gender = array(
							'11-17' => array(
								'male' => 0,
								'female' => 0
							),
							'18-23' => array(
								'male' => 0,
								'female' => 0
							),
							'24-30' => array(
								'male' => 0,
								'female' => 0
							),
							'31-40' => array(
								'male' => 0,
								'female' => 0
							),
							'41-50' => array(
								'male' => 0,
								'female' => 0
							),
							'51+' => array(
								'male' => 0,
								'female' => 0
							)
						); 
						$data_gender_string = array();
						foreach($this->gender_data as $k=>$v){
							if ($v->umur >= 11 && $v->umur <= 17){
								$key = "11-17";
							}else if ($v->umur >= 18 && $v->umur <= 23){
								$key = "18-23";
							}else if ($v->umur >= 24 && $v->umur <= 30){
								$key = "24-30";
							}else if ($v->umur >= 31 && $v->umur <= 40){
								$key = "31-40";
							}else if ($v->umur >= 41 && $v->umur <= 50){
								$key = "41-50";
							}else if ($v->umur >= 51){
								$key = "51+";
							}
							$data_gender[$key][$v->gender] += $v->jml_umur;
						}
						
						foreach($data_gender as $k=>$v){
							$data_gender_string[] = "['".$k."', ".$v['male'].", ".$v['female']."]";
						}
						?>

						<script type="text/javascript">
							$dataGAGender = [
								['Age', 'Male', 'Female'],
								<?php echo implode(", ", $data_gender_string); ?>
							];
						</script>
						<div id="chart-genderage"></div>
					<!-- .box --></div>

					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Geography </h2>
						</div>

						<?php 
						$regions = json_decode($this->region_data);
						?>
						
						<div class="row">
							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm table-align-alt">
										<thead>
											<tr>
												<th width="60%">Provinsi</th>
												<th width="40%">Views</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if (!empty($regions)){
												foreach($regions as $k=>$v){
											?>
											<tr>
												<td><?php echo $v->region; ?></td>
												<td><?php echo $v->visits; ?></td>
											</tr>
											<?php } 
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
							
							<?php 
							$citys = json_decode($this->city_data);
							?>

							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm table-align-alt">
										<thead>
											<tr>
												<th width="60%">City</th>
												<th width="40%">Views</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if (!empty($citys)){
												foreach($citys as $k=>$v){
											?>
											<tr>
												<td><?php echo $v->city; ?></td>
												<td><?php echo $v->visits; ?></td>
											</tr>
											<?php } 
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<!-- .box --></div>

					
					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Interest <i class="icon-lock"></i></h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm table-align-alt">
								<thead>
									<tr>
										<th width="75%">Interest</th>
										<th width="25%">Views</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Sepak Bola</td>
										<td>2318</td>
									</tr>
									<tr>
										<td>Basket</td>
										<td>1882</td>
									</tr>
									<tr>
										<td>Renang</td>
										<td>95</td>
									</tr>
								</tbody>
							</table>
						</div>
					<!-- .box --></div>
					 

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>