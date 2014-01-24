var office_latlng = [ -6.2327333907640545,106.81167840957642 ];
$('#office-map').initMap({
	center : office_latlng,
	type : 'roadmap',
	options : {
		zoom: 15,
		disableDefaultUI: true,
	},
	markers : {
		office : { position: office_latlng }
	}
});