<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChartt);
google.charts.setOnLoadCallback(drawChart);

		function drawChartt() {
			var data = google.visualization.arrayToDataTable([
				['Element', 'Value', { role: 'style' }],
				<?php foreach ($graph_data as $row): ?>
				['<?php echo $row['label']; ?>', <?php echo $row['value']; ?>, '<?php echo $row['color']; ?>'],
				<?php endforeach; ?>
			]);

			var options = {
				title: 'Total de vehículos registrados',
				legend: { position: 'none' }
			};

			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}

		function drawChart() {
			
			var jsonData = <?php echo $graph_dat; ?>;
    		var data = google.visualization.arrayToDataTable(jsonData);
    		var formatter = new google.visualization.NumberFormat({
        		pattern: '$####'
    		});

    		formatter.format(data, 1);
			var options = {
				title: 'Recuento de ganancias en el año',
				hAxis: {title: '2024',  titleTextStyle: {color: '#333'}},
				vAxis: {
            	format: '$####',
            	minValue: 0
        		}
			};

			var chart = new google.visualization.AreaChart(document.getElementById('fech_div'));
			chart.draw(data, options);
		}
</script>