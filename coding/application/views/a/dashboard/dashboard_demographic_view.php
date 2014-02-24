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
						
						<div class="row">
							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm table-align-alt table-scrollable">
										<thead>
											<tr>
												<th width="60%">Province</th>
												<th width="40%">Views</th>
											</tr>
										</thead>
										<tbody class="scrollable-area">
											<?php 
											if (!empty($this->province_data)){
												foreach($this->province_data as $k=>$v){
													
													$style = (strlen($v->province_name) > 17) ? 'min-height:65px;' : '';
											?>
											<tr>
												<td><?php echo ucwords( $v->province_name ); ?></td>
												<td style="<?php echo $style; ?>"><?php echo $v->jml_account; ?></td>
											</tr>
											<?php } 
											}
											?>
										</tbody>
									</table>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm table-align-alt table-scrollable">
										<thead>
											<tr>
												<th width="60%">City</th>
												<th width="40%">Views</th>
											</tr>
										</thead>
										<tbody class="scrollable-area">
											<?php 
											if (!empty($this->city_data)){
												foreach($this->city_data as $k=>$v){
													
													$style = (strlen($v->province_name) > 17) ? 'min-height:65px;' : '';
											?>
											<tr>
												<td><?php echo ucwords( $v->city_name ); ?></td>
												<td style="<?php echo $style; ?>"><?php echo $v->jml_account; ?></td>
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

					
					<?php if (!empty($this->interests)){ ?>
					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Interest</h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm table-align-alt">
								<thead>
									<tr>
										<th width="25%">Rangking</th>
										<th width="75%">Interest</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($this->interests as $k=>$v){ ?>
									<tr>
										<td style="text-align:center;"><?php echo ($k+1); ?></td>
										<td style="text-align:left;"><?php echo ucwords($v->mip_name); ?>
											<div><small><?php echo ucfirst($v->mip_details); ?></small></div></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					<!-- .box --></div>
					<?php } ?> 

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>