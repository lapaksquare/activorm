/*
var checkTotalPoint = function(el, pid){
       		
	var qty = el.val();
	
	$.post('/ajax/checkPointTopUpManual', {
		pid : pid,
		qty : qty
	}, function(data){
		$('#totalamount').text(data.total_amount_string);
		$('#servicecharge').text(data.service_charge_string);
		$('#governmenttax').text(data.gov_charge_string);
		$('#totalpayment').text(data.total_payment_string);
	}, 'json');
	
};

var choice_pid = "";

$('#point_id').bind('change', function(){
	var el = $(this);
	if (el.data('working')) return false;
   	el.data('working', true);
   	
   	var pid = el.val();
   	choice_pid = pid;
	if ($('#point_qty').val() != '') checkTotalPoint($('#point_qty'), pid);
	
	el.data('working', false);
	return false;
});

$('#content').delegate('#point_qty', 'keyup', function(e){
			
	if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
		this.value = this.value.replace(/[^0-9\.]/g, '');
	}else{

   		var el = $(this);
   		if (el.data('working')) return false;
   		el.data('working', true);
   		
   		var div = choice_pid;
   		if (div == ''){
   			choice_pid = $('#point_id').val();
   			div = choice_pid;
   		}	       		
   		checkTotalPoint(el, div);
   	
   		el.data('working', false);
	}
});*/

$('#content').delegate('#totalamount', 'keyup', function(e){
			
	if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
		this.value = this.value.replace(/[^0-9\.]/g, '');
	}else{

   		var el = $(this);
   		if (el.data('working')) return false;
   		el.data('working', true);
   		
   		var v = el.val();
   		$.post('/admin/ajax/getTotalAmountOrderManual', {
   			v : v,
   		}, function(data){
			$('#servicecharge').text(data.service_charge_string);
			$('#governmenttax').text(data.gov_charge_string);
			$('#totalpayment').text(data.total_payment_string);
			el.data('working', false);
   		}, 'json');
   	
	}
});
