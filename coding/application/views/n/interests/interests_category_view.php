<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-12 lp-header" id="main" role="main">
	
	<div class="box-header">
		<h2 style="float:left;">Interests Category</h2>	
	</div>
	
	<div class="clearfix"></div>
	
	<hr />

	<div class="graph_signup">
		<div class="box-header">
			
			<table class="table table-hover">
		        <thead>
		          <tr>
					<th>Category Name</th>
					<th>Jumlah Category</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php 					
					foreach($this->interests_category as $k=>$v){
					?>
					
					<tr>
						<td><?php echo ucwords( $v->category ); ?></td>
						<td><?php echo $v->jml_category; ?></td>
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