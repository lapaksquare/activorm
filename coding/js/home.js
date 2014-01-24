$(function(){
	$(window).load(function(){
		
		if ( (rs_login > 0 || rs == 0) && rs_business_register == 0 && show_popup_login == 1 && nopopuplogin == 0){
			$('.popup-modal-user-login').modal('show');
		}
		$('#signup_btn').bind('click', function(){
			$('.popup-modal-user').modal('show');
			return false;
		});
		if (rs > 0 && rs < 4){
			$('.popup-modal-user').modal('show');
		}
		$('body').delegate('#navbar-login-button', 'click', function(){
			$('.popup-modal-user-login').modal('show');
			return false;
		});
		$('#btn-signup').bind('click', function(){
			$('.popup-modal-user-login').modal('hide');
			$('.popup-modal-user').modal('show');
			return false;
		});
		
		if (modal_create_project == 1){
			$('#modal-project').modal('show');
		}
		
		if (pointtopup_error == 2){
			$('#modal-topup-confirmation').modal('show');
		}
		
		if (message_register_error == 1 || hack_register_show == 1){
			$('.popup-modal-user-login').modal('hide');
			$('.popup-modal-user').modal('show');
		}
		
		$('#modal-user').delegate('button.close', 'click', function(){
			var el = $(this);
			if (el.data('working')) return false;
			el.data('working', true);
			$.post('/ajax/unsetPopupLogin',{},function(data){
				el.data('working', false);
			});
			return false;
		});
		
	});
});