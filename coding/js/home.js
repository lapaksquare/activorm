$(function(){
	$(window).load(function(){
		if (rs < 4){
			$('.popup-modal-user').modal('show');
			$('#navbar-login-button').bind('click', function(){
				$('.popup-modal-user-login').modal('show');
				return false;
			});
			$('#btn-signup').bind('click', function(){
				$('.popup-modal-user-login').modal('hide');
				$('.popup-modal-user').modal('show');
				return false;
			});
		}
	});
});