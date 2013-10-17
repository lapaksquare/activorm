var office_latlng = [ -6.23028,106.806911 ];
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