$('#projects_selected').bind('change', function(){
	var el = $(this);
	var v = el.val();
	window.location = base_url + 'dashboard/project/' + v;
});

$(".scrollable-area").mCustomScrollbar();

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
	var data = google.visualization.arrayToDataTable($dataGAGender);

	var options = {
		bar: {groupWidth:'60%'},
		colors: ['#19b99a', '#d35828'],
		legend: {position:'top', alignment:'end'},
		chartArea: {left:20, top:20, width:"100%", height:"80%"},
		vAxis: {textPosition:'none',gridlines:{color:'#fff'}},
	};

	var chart = new google.visualization.ColumnChart(document.getElementById('chart-genderage'));
	chart.draw(data, options);
}