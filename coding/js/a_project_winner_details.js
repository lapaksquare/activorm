$('#project_tab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');  
});

$(window).scroll(function () {
	//console.log($(this).scrollTop());
	if ($(this).scrollTop() >= 960){
		$('#panel-voucher-upload').addClass('voucher_form_fixed_top');
	}else{
		$('#panel-voucher-upload').removeClass('voucher_form_fixed_top');
	}
});

$('#scantikets').delegate('#btn-search-tiket', 'click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	
	$('#scantikets').find('#loading').fadeIn();
	var $tiket_barcode = $('#tiket-barcode').val();
	
	$.post('/admin/ajax/scanTiketOffline', {
		tiket_barcode : $tiket_barcode
	}, function(data){
		
		$('#modal-confirm-tiket').modal('show');
		
		if (data.message == 0){
			$('#modal-confirm-tiket').find('#message-success').show();
			$('#modal-confirm-tiket').find('#btn-cancel').show();
			$('#modal-confirm-tiket').find('#btn-confirm').show();
			
			$('#modal-confirm-tiket').find('#message-error1').hide();
			$('#modal-confirm-tiket').find('#message-error2').hide();
			$('#modal-confirm-tiket').find('#btn-close').hide();
			
		}else if (data.message == 1){
			$('#modal-confirm-tiket').find('#message-success').hide();
			$('#modal-confirm-tiket').find('#btn-cancel').hide();
			$('#modal-confirm-tiket').find('#btn-confirm').hide();
			
			$('#modal-confirm-tiket').find('#message-error1').show();
			$('#modal-confirm-tiket').find('#message-error2').hide();
			$('#modal-confirm-tiket').find('#btn-close').show();
		}else if (data.message == 2){
			$('#modal-confirm-tiket').find('#message-success').hide();
			$('#modal-confirm-tiket').find('#btn-cancel').hide();
			$('#modal-confirm-tiket').find('#btn-confirm').hide();
			
			$('#modal-confirm-tiket').find('#message-error1').hide();
			$('#modal-confirm-tiket').find('#message-error2').show();
			$('#modal-confirm-tiket').find('#btn-close').show();
		}
		
		$('#scantikets').find('#loading').fadeOut();
		
		el.data('working', false);	
	}, 'json');
	
	return false;
});

$('#scantikets').delegate('#btn-confirm', 'click', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);	
	
	var $tiket_barcode = $('#tiket-barcode').val();
	
	$.post('/admin/ajax/confirmTiketOffline', {
		tiket_barcode : $tiket_barcode
	}, function(data){
		
		if (data.message == 0){
			alert('OK! Success!');
			$('#modal-confirm-tiket').modal('hide');
			$('#tiket-barcode').val('');
		}else{
			alert('Somethiner Error!');
		}
		
		el.data('working', false);	
	}, 'json');
	
	return false;	
});