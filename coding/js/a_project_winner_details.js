$('#project_tab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');  
});

$(window).scroll(function () {
	//console.log($(this).scrollTop());
	if ($(this).scrollTop() >= 960){
		$('#panel-voucher-upload').addClass('voucher_form_fixed_top');
	}else{
		$('#panel-voucher-upload').removeClass('voucher_form_fixed_top');
	}
});