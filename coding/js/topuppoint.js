$(function(){
	$(window).load(function(){
		
		var total_amount = 0;
		
		$('#content').delegate('#topup_amount', 'keyup', function(e){
			if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
       			this.value = this.value.replace(/[^0-9\.]/g, '');
    		}else{
    			
    		}
		});
		
		var choice_pid = '';
		//console.log($('#table_point').find('input[type="radio"]:first'));
		$('#table_point').find('input[type="radio"]').bind('click', function(){
			var el = $(this);
			if (el.data('working')) return false;
	       	el.data('working', true);
			var div = el.closest('div');
			choice_pid = div;
			if ($('#point_qty').val() != '') checkTotalPoint($('#point_qty'), div);
			el.data('working', false);
		});
		
		$('#content').delegate('#point_qty', 'keyup', function(e){
			
			if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
       			this.value = this.value.replace(/[^0-9\.]/g, '');
    		}else{
			
			//this.value = this.value.replace(/[^0-9\.]/g,'');
			
			//if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
			//else {
						
	       	//if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
	        //	event.preventDefault(); //stop character from entering input
	       	//}else{
	       		
	       		var el = $(this);
	       		if (el.data('working')) return false;
	       		el.data('working', true);
	       		
	       		var div = choice_pid;
	       		if (div == ''){
	       			$('#table_point').find('input[type="radio"]').each(function(){
	       				if ($(this).attr('checked') == 'checked') {
	       					div = $(this).closest('div');
	       				}
	       			});
	       			choice_pid = div;
	       		}	       		
	       		checkTotalPoint(el, div);
	       	
	       		el.data('working', false);
			}
	   	});
	   	
	   	$('#btn_next_topup').bind('click', function(){
	   		$('#modal-topup').modal('hide');
	   		return false;
	   	});
	   	
	   	$('#btn-modal-topup').bind('click', function(){
	   		$('#modal-topup').modal('show');
	   		return false;
	   	});
		
		var checkTotalPoint = function(el, div){
       		
       		var pid = div.find('#pid').val();
       		var pid_hash = div.find('#pid_hash').val();
       		var qty = el.val();
       		
       		$.post('/ajax/checkPointTopUp', {
       			pid : pid,
       			pid_hash : pid_hash,
       			qty : qty
       		}, function(data){
       			$('#totalamount').text(data.total_amount_string);
       			$('#servicecharge').text(data.service_charge_string);
       			$('#governmenttax').text(data.gov_charge_string);
       			$('#totalpayment').text(data.total_payment_string);
       		}, 'json');
		};
		
	});
});
