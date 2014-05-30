<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-12 lp-header" id="main" role="main">
	
	<div class="box-header">
		<h2 style="float:left;">Traffic Page</h2>
		
		<div class="pull-right">
			<select id="alldate" class="form-control" data-rel="admin/trafficpage?">
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
	
	<div class="row">
	  <div class="col-md-12">
	  	<table class="table">
	  		<thead>
	  			<tr>
	  				<th>Halaman</th>
	  				<th>PageViews</th>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			<?php 
	  			foreach($this->traffic_website['rows'] as $k=>$v){
	  			?>
	  			<tr>
	  				<td><?php echo $v[0]; ?><?php echo $v[1]; ?></td>
	  				<td><?php echo $v[2]; ?> views</td>
	  			</tr>
	  			<?php	
	  			}
	  			?>
	  		</tbody>
	  	</table>
	  </div>
	</div>
	
	<div class="box-header">
		<h2 style="float:left;">Traffic Newsletter UTM</h2>
	</div>
	<div class="clearfix"></div>
	<div class="row">
	  <div class="col-xs-4">
	  	
	  	<form class="form-inline" role="form" method="get">
		  <div class="form-group">
		    <input type="text" class="form-control" id="dateutm" name="dateutm" placeholder="" value="<?php echo $this->dateutm; ?>">
		  </div>
		  <button type="submit" class="btn btn-default">Check</button>
		</form>  
	  	
	  </div>
	</div>  
	<div class="row">
	  <div class="col-md-12">
	  	<?php if (!empty($this->traffic_website_utm['rows'])){ ?>
	  	<table class="table">
	  		<thead>
	  			<tr>
	  				<th>Campaign</th>
	  				<th>Source</th>
	  				<th>Medium</th>
	  				<th>PageViews</th>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			<?php 
	  			foreach($this->traffic_website_utm['rows'] as $k=>$v){
	  			?>
	  			<tr>
	  				<td><?php echo $v[0]; ?></td>
	  				<td><?php echo $v[1]; ?></td>
	  				<td><?php echo $v[2]; ?></td>
	  				<td><?php echo $v[4]; ?> views</td>
	  			</tr>
	  			<?php	
	  			}
	  			?>
	  		</tbody>
	  	</table>
	  	<?php }else{
	  	?>
	  	<p>Tidak ada data</p>
	  	<?php	
	  	} ?>
	  </div>
	</div>		
	
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>