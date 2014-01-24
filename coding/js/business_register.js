$(function(){
	$(window).load(function(){
		if (rs_business_register == 1 || msg_resend_businessaccount > 0){
			$('#modal-signup').modal('show');
		}
	});
});