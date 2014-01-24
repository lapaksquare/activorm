$(function(){
	
	$(window).load(function(){
	
		//$('#project-budget').slider({tooltip:'hide'});
		
		var budget = 100000; //$("#project-budget").attr("data-slider-value");
		
		//log(budget);
		//log(parseInt(budget/1000));
		
		$(".counter-box").find(".green").html(parseInt(budget/1000)+" Points");
		
		var is_pointok = 0;
		$("#project-budget").on("slide", function(e){
			var balance = parseInt($(".balance-box").attr("data-balance")),
				point = parseInt(e.value/1000);
			
			var dvd1 = 1.5;
			var dvd2 = 1;
			var dvd3 = 2.5;
			$('.current_point').text(point);
			
			$('#pricing-info').find('#current_point_hasil_1').text(Math.round(point/dvd1));
			$('#pricing-info').find('#current_point_hasil_2').text(Math.round(point/dvd2));
			$('#pricing-info').find('#current_point_hasil_3').text(Math.round(point/dvd3));
			
			$(".counter-box").find(".green").html(point+" Points");
			
			if(point > balance){
				$(".balance-note").fadeIn();
				is_pointok = 1;
			}
			else{
				$(".balance-note").fadeOut();
				is_pointok = 0;
			}
		});
		
		//$('#modal-project').modal('show');
		
		$('#form_pricing').delegate('#btn_select_point', 'click', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			
			// point anda kurang
			if (is_pointok == 1){
				alert("You don't have enough balance, please Top Up");	
			}else{
				var panel_body = el.closest('.panel-body');
				var plantype = panel_body.attr('data-plantype');
				$('#cplan').val(plantype);
				$('#modal-project').modal('show');
			}
			
			el.data('working', false);
			return false;
		});
		
	});
});