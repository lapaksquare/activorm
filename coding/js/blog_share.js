$('.share-twitter').sharrre({
	share: {
		twitter: true
	},
	enableHover: false,
	enableTracking: true,
	buttons: { twitter: {via: 'activorm'}},
	click: function(api, options){
		api.simulateClick();
		api.openPopup('twitter');
	}
});
$('.share-facebook').sharrre({
	share: {
		facebook: true
	},
	enableHover: false,
	enableTracking: true,
	click: function(api, options){
		api.simulateClick();
		api.openPopup('facebook');
	}
});
$('.share-googleplus').sharrre({
	share: {
		googlePlus: true
	},
	enableHover: false,
	enableTracking: true,
	click: function(api, options){
		api.simulateClick();
		api.openPopup('googleplus');
	},
	urlCurl: 'sharrre.php'
});