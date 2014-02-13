<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-12 lp-header" id="main" role="main">
	
	<div class="box-header">
		<h2 style="float:left;">Graph</h2>	
		
		<div class="pull-right">
			<select id="alldate" class="form-control" data-rel="admin/graph?">
				<?php
				$date1 = date("Y-m-d", strtotime("- 7 days"));
				$date2 = date("Y-m-d", strtotime("- 1 days")); 
				for($i=1;$i<=4;$i++){
					$h = sha1($date1 . $date2 . SALT);
					$v = "s=".$date1."&e=".$date2."&h=".$h;
					$class = ($v == $this->keyal) ? 'selected' : '';
				?>
				<option value="<?php echo $v; ?>" <?php echo $class; ?>><?php echo date("d M Y", strtotime($date1)).' s/d '.date("d M Y", strtotime($date2)); ?></option>
				<?php	
					$date2 = $date1;
					$date1 = date("Y-m-d", strtotime($date2 . " - 7 days"));
				}
				?>
			</select>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<hr />
	
	<div class="graph_signup">
		<div class="box-header">
			<h3 class="box-title title-light" style="float:left;margin:0;">Traffic SignUp</h3>

			<div class="clearfix"></div>
			
		</div>
		<script type="text/javascript">
			<?php 
			$chart_traffic_signup = array();
			$gchart_type_signup = "";
			foreach($this->graph_signup as $k=>$v){
				$y = date('Y', strtotime($v->date));
				$m = date('m', strtotime($v->date));
				$d = date('d', strtotime($v->date));
				$tgl = 'new Date('.$y.', '.($m-1).', '.$d.')';
				$chart_traffic_signup[] = '['.$tgl.', '.$v->jml_member.']';
			}
			?>
			var $gchart_type_signup = 'date';
			var $chart_traffic_signup = [<?php echo implode(", ", $chart_traffic_signup); ?>];
		</script>
		<div id="chart-traffic-signup" class="chart-traffic"></div>
	</div>
	
	
	<?php /*
	<div class="graph_signup">
		<div class="box-header">
			<h3 class="box-title title-light" style="float:left;margin:0;">Traffic SignIn</h3>

			<div class="clearfix"></div>
			
		</div>
		<script type="text/javascript">
			<?php 
			$chart_traffic_signin = array();
			$gchart_type_signin = "";
			foreach($this->graph_signin as $k=>$v){
				$y = date('Y', strtotime($v->date));
				$m = date('m', strtotime($v->date));
				$d = date('d', strtotime($v->date));
				$tgl = 'new Date('.$y.', '.($m-1).', '.$d.')';
				$chart_traffic_signin[] = '['.$tgl.', '.$v->jml_member.']';
			}
			?>
			var $gchart_type_signin = 'date';
			var $chart_traffic_signin = [<?php echo implode(", ", $chart_traffic_signin); ?>];
		</script>
		<div id="chart-traffic-signin" class="chart-traffic"></div>
	</div> */ ?>
	
	<div class="graph_signup">
		<div class="box-header">
			<h3 class="box-title title-light" style="margin:0;">AVG Jumlah Project</h3>
			<p><b>Rata-rata jumlah project yang diikuti oleh user Activorm : </b> <?php echo number_format($this->avg_jml_project, 2, ",", "."); ?></p>
			<div class="clearfix"></div>
		</div>
	</div>	
	
	<div class="graph_signup">
		<div class="box-header">
			<h3 class="box-title title-light" style="float:left;margin:0;">Top 3 User Yang Paling Aktif</h3>
			<div class="clearfix"></div>
			
			<table class="table table-hover">
		        <thead>
		          <tr>
					<th>Account Name</th>
					<th>Account Email</th>
					<th>Jumlah Project Yang Diikuti</th>
					<th>Twitter</th>
					<th>Facebook</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php 					
					foreach($this->top3_user_active as $k=>$v){
						$sc = $this->socialmedia_model->socialmedia_connect($v->account_id);
						
						$facebook_url = "";
						if (!empty($sc['facebook']->social_data)){
							$sc_fb = json_decode( $sc['facebook']->social_data );	
							$facebook_url = (!empty($sc_fb)) ? 'LINK : <a href="http://facebook.com/'.$sc_fb->id.'" target="_blank">LINK</a>' : "";
						}
						
						$twitter_url = "";
						if (!empty($sc['twitter']->social_data)){
							$sc_tw = json_decode( $sc['twitter']->social_data );	
							$twitter_url = (!empty($sc_tw)) ? 'LINK : <a href="http://twitter.com/'.$sc_tw->screen_name.'" target="_blank">LINK</a>' : "";
							$twitter_url .= (!empty($sc_tw)) ? '<br />Followers Count : '.$sc_tw->followers_count : 0;
						}
						
						//echo '<pre>';
						//print_r($sc);
						//echo '</pre>';
					?>
					
					<tr>
						<td><?php echo $v->account_name; ?></td>
						<td><?php echo $v->account_email; ?></td>
						<td><?php echo $v->jml_project; ?></td>
						<td><?php echo $twitter_url; ?></td>
						<td><?php echo $facebook_url; ?></td>
					</tr>
					
					<?php	
					}
		        	?>
		        </tbody>
			</table>	
			
		</div>
	</div>	
	
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>