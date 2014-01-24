$("#picker1").birthdaypicker({
  monthFormat : "long",
  dateFormat : "littleEndian",
  placeholder : true,
  defaultDate: $('#picker1').attr('data-date')
});

$(function(){

$(window).load(function(){

$('#province_id').bind('change', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var province_id = el.val();
	$.post('/ajax/getKabupatenByProvinceId', {
		province_id : province_id,
		noparent : 1
	}, function(data){
		
	 	$('#kabupaten_id').html(data);
		$('#kabupaten_id').change();	
		$('#kecamatan_id').change();			
					
		el.data('working', false);
	}, 'html');
	return false;
});

$('#kabupaten_id').bind('change', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var kabupaten_id = el.val();
	$.post('/ajax/getKecamatanByKabupatenId', {
		kabupaten_id : kabupaten_id,
		noparent : 1
	}, function(data){
		
		$('#kecamatan_id').html(data);		
		$('#kelurahan_id').change();	
						
		el.data('working', false);
	}, 'html');
	return false;
});

$('#kecamatan_id').bind('change', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var kecamatan_id = el.val();
	$.post('/ajax/getKelurahanByKecamatanId', {
		kecamatan_id : kecamatan_id,
		noparent : 1
	}, function(data){
		
		$('#kelurahan_id').html(data);
						
		el.data('working', false);
	}, 'html');
	return false;
});

});

});