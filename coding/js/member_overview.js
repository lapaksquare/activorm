$('#table-member').delegate('#btn-loginas', 'click', function(){
	var el = $(this);
	var c = confirm("WARNING! Fitur ini hanya digunakan untuk create project / top up payment pada merchant, setting contact information user (Tidak untuk Social Media Settings). So, Yakin!, kamu mau login sebagai user ini?");
	if (c == true){
		
	}else{
		return false;
	}
});
