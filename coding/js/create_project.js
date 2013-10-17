$(function(){
	$(window).load(function(){
		$('#project-period').slider({
			formater: function(value) {
				return value + ' d';
			}
		});

		$('.limiter').simplyCountable({
			counter: '.counter span',
			maxCount: 60,
			strictMax: true
		});
		
		$("#tags").find("input[type=text]").tagBox({separatorAction:false});
	});
});