function number_format(number, decimals, dec_point, thousands_sep) {
  //  discuss at: http://phpjs.org/functions/number_format/
  // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: davook
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Theriault
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Michael White (http://getsprink.com)
  // bugfixed by: Benjamin Lupton
  // bugfixed by: Allan Jensen (http://www.winternet.no)
  // bugfixed by: Howard Yeend
  // bugfixed by: Diogo Resende
  // bugfixed by: Rival
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  //  revised by: Luke Smith (http://lucassmith.name)
  //    input by: Kheang Hok Chin (http://www.distantia.ca/)
  //    input by: Jay Klehr
  //    input by: Amir Habibi (http://www.residence-mixte.com/)
  //    input by: Amirouche
  //   example 1: number_format(1234.56);
  //   returns 1: '1,235'
  //   example 2: number_format(1234.56, 2, ',', ' ');
  //   returns 2: '1 234,56'
  //   example 3: number_format(1234.5678, 2, '.', '');
  //   returns 3: '1234.57'
  //   example 4: number_format(67, 2, ',', '.');
  //   returns 4: '67,00'
  //   example 5: number_format(1000);
  //   returns 5: '1,000'
  //   example 6: number_format(67.311, 2);
  //   returns 6: '67.31'
  //   example 7: number_format(1000.55, 1);
  //   returns 7: '1,000.6'
  //   example 8: number_format(67000, 5, ',', '.');
  //   returns 8: '67.000,00000'
  //   example 9: number_format(0.9, 0);
  //   returns 9: '1'
  //  example 10: number_format('1.20', 2);
  //  returns 10: '1.20'
  //  example 11: number_format('1.20', 4);
  //  returns 11: '1.2000'
  //  example 12: number_format('1.2000', 3);
  //  returns 12: '1.200'
  //  example 13: number_format('1 000,50', 2, '.', ' ');
  //  returns 13: '100 050.00'
  //  example 14: number_format(1e-8, 8, '.', '');
  //  returns 14: '0.00000001'

  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

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
   		
   		var $total_amount = el.val();
   		var $service_charge = 5 * $total_amount / 100;
		var $goverment_tax = 10 * $total_amount / 100;
		var $total_payment = parseInt($total_amount) + parseInt($service_charge) + parseInt($goverment_tax);
   		
   		$('#servicecharge').text('IDR ' + number_format($service_charge, 2, ',', '.'));
		$('#governmenttax').text('IDR ' + number_format($goverment_tax, 2, ',', '.'));
		$('#totalpayment').text('IDR ' + number_format($total_payment, 2, ',', '.'));
   		
   		el.data('working', false);
   	
	}
});
