$('.payment_date').datepicker({
	'format' : 'dd MM yyyy'
}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
});