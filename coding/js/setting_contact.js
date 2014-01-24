$(function(){
	$(window).load(function(){
		
		/*
		$('.datepicker').datepicker({
        	'format' : 'dd MM yyyy'
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });*/
       
       $("#picker1").birthdaypicker({
          monthFormat : "long",
          dateFormat : "littleEndian",
          placeholder : true,
          defaultDate: $('#picker1').attr('data-date')
        });
        
        $('.light-select').dropkick({
			theme : 'light'
		});
        
        $('#account_province').bind('change', function(){
        	var el = $(this);
        	if (el.data('working')) return false;
        	el.data('working', true);
        	var province_id = el.val();
        	$.post('/ajax/getKabupatenByProvinceId', {
        		province_id : province_id
        	}, function(data){
				
				$select = $("#account_kabupaten");
				$select.removeData("dropkick");
				$("#dk_container_account_kabupaten").remove();
				
				$('#account_kabupaten_container').html(data);				
				$('#account_kabupaten_container').find('#account_kabupaten').dropkick({
					theme : 'light'
				});
				
			 	$('#account_kabupaten_container').find('#account_kabupaten').change();
				$('#account_kecamatan_container').find('#account_kecamatan').change();				
				$('#account_kelurahan_container').find('#account_kelurahan').change();				
							
        		el.data('working', false);
        	}, 'html');
        	return false;
        });
        
        $('#account_kabupaten_container').delegate('#account_kabupaten', 'change', function(){
        	var el = $(this);
        	if (el.data('working')) return false;
        	el.data('working', true);
        	var kabupaten_id = el.val();
        	$.post('/ajax/getKecamatanByKabupatenId', {
        		kabupaten_id : kabupaten_id
        	}, function(data){
				
				$select = $("#account_kecamatan");
				$select.removeData("dropkick");
				$("#dk_container_account_kecamatan").remove();
				
				$('#account_kecamatan_container').html(data);				
				$('#account_kecamatan_container').find('#account_kecamatan').dropkick({
					theme : 'light'
				});
				
				$('#account_kecamatan_container').find('#account_kecamatan').change();				
				$('#account_kelurahan_container').find('#account_kelurahan').change();		
								
        		el.data('working', false);
        	}, 'html');
        	return false;
        });
        
        $('#account_kecamatan_container').delegate('#account_kecamatan', 'change', function(){
        	var el = $(this);
        	if (el.data('working')) return false;
        	el.data('working', true);
        	var kecamatan_id = el.val();
        	$.post('/ajax/getKelurahanByKecamatanId', {
        		kecamatan_id : kecamatan_id
        	}, function(data){
				
				$select = $("#account_kelurahan");
				$select.removeData("dropkick");
				$("#dk_container_account_kelurahan").remove();
				
				$('#account_kelurahan_container').html(data);				
				$('#account_kelurahan_container').find('#account_kelurahan').dropkick({
					theme : 'light'
				});
				
				$('#account_kelurahan_container').find('#account_kelurahan').change();		
								
        		el.data('working', false);
        	}, 'html');
        	return false;
        });
        
	});
});
