google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {

	var data1 = new google.visualization.DataTable();
	data1.addColumn('date', 'Date');
	data1.addColumn('number', 'Visitor');
	data1.addColumn('number', 'Viewer');

	data1.addRows([
		[new Date(2013, 7, 1), 100, 70],
		[new Date(2013, 7, 2), 140, 85],
		[new Date(2013, 7, 3), 300, 65],
		[new Date(2013, 7, 4), 220, 175],
		[new Date(2013, 7, 5), 330, 195],
		[new Date(2013, 7, 6), 350, 170],
		[new Date(2013, 7, 7), 480, 350],
		[new Date(2013, 7, 8), 490, 310],
	]);

	var data2 = google.visualization.arrayToDataTable([
		['Source', 'Amount'],
		['Direct',		205],
		['Referral',	492],
		['Organic',		381]
	]);
	var data3 = google.visualization.arrayToDataTable([
		['Type', 'Amount'],
		['New Visitors',		350],
		['Returning Visitors',	891],
	]);

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
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart-traffic'));
	chart.draw(data1, options1);
	var chart = new google.visualization.PieChart(document.getElementById('chart-source'));
	chart.draw(data2, options2);
	var chart = new google.visualization.PieChart(document.getElementById('chart-type'));
	chart.draw(data3, options3);
}