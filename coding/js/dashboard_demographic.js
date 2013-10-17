google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
	var data = google.visualization.arrayToDataTable([
		['Age', 'Male', 'Female'],
		['13-17',  320, 640],
		['18-23',  400, 600],
		['24-30',  750, 320],
		['31-40',  310, 260],
		['41-50',  220, 160],
		['51+',  110, 80],
	]);

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