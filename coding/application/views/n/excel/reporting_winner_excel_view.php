<style>
	*{
		margin:0;
		padding:0;
	}
    body {
        font-family: Arial;
    }
    table {
        border-collapse: collapse;
        width:100%;
    }
    th {
        background-color: #cccccc;
    }
    th, td {
        border: 1px solid #000;
    }
</style>

<table class="table table-striped table-bordered" style="border:1px solid #000;">
	<thead>
		<tr>
			<td width="800" height="40" colspan="5" style="text-align:center;vertical-align:middle;"><h2>Reporting Winner : <?php echo ucwords( $project->project_name ); ?></td>
		</tr>
		<tr>
			<th width="100" height="30" style="vertical-align:top;font-size:14px;vertical-align:middle;"><b>Tiket Barcode</b></th>
			<th width="100" height="30" style="vertical-align:top;font-size:14px;vertical-align:middle;"><b>Account Name</b></th>
			<th width="200" height="30" style="vertical-align:top;font-size:14px;vertical-align:middle;"><b>Account Email</b></th>
			<th width="400" height="30" style="vertical-align:top;font-size:14px;vertical-align:middle;"><b>Account Address</b></th>
			<th width="400" height="30" style="vertical-align:top;font-size:14px;vertical-align:middle;"><b>ID Card</b></th>
		</tr>
	</thead>
	<tbody>
		
		<?php 
        	foreach($member_winner as $k=>$v){
        		
				$address = (empty($v->address)) ? '-' : $v->address;
				$pronvince = (empty($v->province_name)) ? '-' : $v->province_name;
				$kecamatan = (empty($v->kecamatan_name)) ? '-' : $v->kecamatan_name;
				$phone_number = (empty($v->phone_number)) ? '-' : $v->phone_number;
				$address_string = '<b>Address:</b> ' . $address . '<br />';
				$address_string .= '<b>Province:</b> ' . $pronvince . '<br />';
				$address_string .= '<b>Kecamatan:</b> ' . $kecamatan . '<br />';
				$address_string .= '<b>Phone:</b> ' . $phone_number . '<br />';

			?>
			
			<tr>
				<td style="vertical-align:top;font-size:14px;"><b><?php echo strtoupper($v->tiket_barcode); ?></b></td>
				<td style="vertical-align:top;font-size:13px;"><?php echo ucwords($v->account_name); ?></td>
				<td style="vertical-align:top;font-size:13px;"><?php echo $v->account_email; ?></td>
				<td style="vertical-align:top;font-size:13px;"><?php echo $address_string; ?></td>
				<td style="vertical-align:top;font-size:13px;"><?php echo (empty($v->card_number)) ? "-" : '"'.$v->card_number.'"'; ?></td>
			</tr>
			
			<?php	
        	}
        	?>
        	
	</tbody>
</table>