$(function(){
	
	$(window).load(function(){
	
		$('#project-budget').slider({tooltip:'hide'});
		
		var budget = $("#project-budget").attr("data-slider-value");
		
		log(budget);
		log(parseInt(budget/1000));
		
		$(".counter-box").find(".green").html(parseInt(budget/1000)+" Points");
		
		$("#project-budget").on("slide", function(e){
			var balance = parseInt($(".balance-box").attr("data-balance")),
				point = parseInt(e.value/1000);
			
			$(".counter-box").find(".green").html(point+" Points");
			
			if(point > balance){
				$(".balance-note").fadeIn();
			}
			else{
				$(".balance-note").fadeOut();
			}
		});
		$('#modal-project').modal('show');
		
	});
});