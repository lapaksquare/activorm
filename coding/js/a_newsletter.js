$('.newsletter_date').datepicker({
	'format' : 'yyyy-mm-dd'
}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
});

$('#newsletter_target').bind('change', function(){
	var el = $(this);
	var v = el.val();
	$('#testing_email').hide();
	if (v == "testing"){
		$('#testing_email').show();
	}
	return false;
});
