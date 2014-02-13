google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {

	var data1 = new google.visualization.DataTable();
	data1.addColumn($gchart_type_signup, 'Date');
	data1.addColumn('number', 'Visits');
	data1.addRows($chart_traffic_signup);
	
	/*
	var data2 = new google.visualization.DataTable();
	data2.addColumn($gchart_type_signin, 'Date');
	data2.addColumn('number', 'Visits');
	data2.addRows($chart_traffic_signin);
	*/
	
	//var data2 = google.visualization.arrayToDataTable($chart_source);
	//var data3 = google.visualization.arrayToDataTable($chart_type);

	var options1 = {
		hAxis: {
			gridlines:{color:'#dbdcdd'},
			baselineColor:'#858585',
			format:'MMM d',
			},
		vAxis: {
			gridlines:{color:'#dbdcdd'},
			baselineColor:'#858585',
			},
		colors: ['#19b99a','#d35828'],
		pointSize: 8,
		lineWidth: 3,
		areaOpacity: 0.05,
		chartArea: {left:60, top:50, width:'85%', height:'80%'},
		legend: {position:'top', alignment:'end'},
	};
	
	/*
	var options2 = {
		legend: {
			alignment: 'center',
			textStyle: {fontSize: 14},
			},
		chartArea: {left:0, top:0, width:"90%", height:"80%"},
		colors: ['#19b99a', '#d35828', '#f4ed32'],
		pieSliceText: 'none',
	};
	var options3 = {
		legend: {
			alignment: 'center',
			textStyle: {fontSize: 14},
			},
		chartArea: {left:0, top:0, width:"90%", height:"80%"},
		colors: ['#19b99a', '#d35828'],
		pieSliceText: 'none',
	};*/

	var chart = new google.visualization.AreaChart(document.getElementById('chart-traffic-signup'));
	chart.draw(data1, options1);
	
	//var chart = new google.visualization.AreaChart(document.getElementById('chart-traffic-signin'));
	//chart.draw(data2, options1);
	
	//var chart = new google.visualization.PieChart(document.getElementById('chart-source'));
	//chart.draw(data2, options2);
	//var chart = new google.visualization.PieChart(document.getElementById('chart-type'));
	//chart.draw(data3, options3);
}

$('#main').delegate('#alldate', 'change', function(){
	var el = $(this);
	var v = el.val();
	var rel = el.attr('data-rel');
	window.location = base_url + rel + v;
});

