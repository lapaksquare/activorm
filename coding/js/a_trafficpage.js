$('#main').delegate('#alldate', 'change', function(){
	var el = $(this);
	var v = el.val();
	var rel = el.attr('data-rel');
	window.location = base_url + rel + v;
});
$('#dateutm').datepicker({
	'format' : 'yyyy-mm-dd'
}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
});