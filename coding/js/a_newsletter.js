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

/*
$("#editme2").editInPlace({
	callback: function(unused, enteredText) { return enteredText; },
	// url: "./server.php",
	bg_over: "#cff",
	field_type: "text",
	textarea_rows: "15",
	textarea_cols: "35",
	use_html : true,
});*/

$('#preview').click(function(){
	$('#myModal').modal();
	$("#editme2").html($('#newsletter_body').val());
	$("#editme2").editInPlace({
		callback: function(unused, enteredText) { return enteredText; },
		// url: "./server.php",
		bg_over: "#fff",
		field_type: "textarea",
		textarea_rows: "15",
		textarea_cols: "35",
		use_html: true,
		on_blur : "null"
	});
	return false;
});
