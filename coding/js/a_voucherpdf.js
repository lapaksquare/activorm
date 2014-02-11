$('#valid_until').datepicker({
	'format' : 'yyyy-mm-dd'
}).on('changeDate', function (ev) {
    $(this).datepicker('hide');
});

$('#business_id').bind('change', function(){
	var el = $(this);
	if (el.data('working')) return false;
	el.data('working', true);
	var business_id = el.val();
	$.post('/admin/ajax/getInfoBusinessAccount', {
		business_id : business_id
	}, function(data){
		if (data.status == 1){
			//console.log(data);
			$('#voucher_email').val(data.results.account_email);
			$('#voucher_website').val(data.results.website);
			$('#voucher_phone').val(data.results.contact_number);
			$('#project_id').html(data.projects);
		}else{
			alert('Something Error.');
		}
		el.data('working', false);
	}, 'json');
	return false;
});

$('input#btn_preview').click( function() {
    var t=$(this);
    var form=t.closest('form');
    var target = t.attr('data-target');
    form.attr('target',target);
    form.submit();
});
$('input#btn_submit').click( function() {
    var t=$(this);
    var form=t.closest('form');
    var target = t.attr('data-target');
    form.attr('target',target);
    form.submit();
});