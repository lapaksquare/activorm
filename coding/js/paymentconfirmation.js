$(function(){
	$(window).load(function(){
		$('.datepicker').datepicker({
        	'format' : 'dd MM yyyy'
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
	});
});
