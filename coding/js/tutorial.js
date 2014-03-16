$(function(){
	
	var id = '';
	$('.tutorial-inner-container').delegate('.btn-ttt', 'click', function(){
		var el = $(this);
		var c = el.closest('.section');
		id = el.attr('data-id');
		c.addClass('bl-scale-down');
		$(id).addClass('ttt-show');
		$(id).find('.tutorial-body-str').find('img:first-child').show();
		$(id).find('#menu-tutorial-t1 ul').find('li').siblings().removeClass('btn-active');
		$(id).find('#menu-tutorial-t1 ul').find('li:first-child').addClass('btn-active');
		idmenu = $(id).find('#menu-tutorial-t1 ul').find('li:first-child').attr('data-id');
		return false;
	});
	
	$('.tutorial-inner-container').delegate('.btn-remove', 'click', function(){
		var el = $(this);
		$('.tutorial-container').removeClass('bl-scale-down');
		$(id).removeClass('ttt-show');
		return false;
	});
	
	var idmenu = '';
	$('.tutorial-inner-container').delegate('#menu-tutorial-t1 li', 'click', function(){
		var el = $(this);
		var idmenu_tmp = el.attr('data-id');
		if (idmenu == idmenu_tmp) return false;
		idmenu = el.attr('data-id');
		var c = el.closest('.tutorial-container-t1-body');
		el.siblings().removeClass('btn-active');
		el.addClass('btn-active');
		$('.img-ot').fadeOut();
		c.find(idmenu).fadeIn();
		return false;
	});
	
});
