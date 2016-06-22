<?php
	require_once "iotApp/includes/db_config.php" ;
	require_once "iotApp/includes/Helpers.php" ;

	$data = Helpers::getChartData($con,"temp1_sensor") ;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gelvano | Chart 1</title>
	<style media="screen">
		@import url(https://fonts.googleapis.com/css?family=Itim);
		body {background-color: #E7B23C;font-family:'Itim', sans-serif;}
		body .chart {background-color: #F5F4F4;border-radius: 20px;padding: 30px;margin-top: 80px;width:300%;box-shadow: 2px 1px 10px 2px #BB984B ;}
	</style>
</head>
<body>
	<div class="chart">
		<h1>Chart for PT100 1</h1>
		<?php
			if($data['state'])
			{
		?>
		<div>
			<canvas id="canvas" height="50" width="500"></canvas>
		</div>
		<?php
			}
			else
			{
		?>
		<p><b><code>no data !</code></b></p>
		<?php
			}
		?>
	</div>

<?php
	if($data['state'])
	{
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script>
	var lineChartData = {
		labels : <?php echo $data['dates'] ; ?>,
		datasets : [
	        {
	            label: "Chart for PT100 1",
	            fillColor: "rgba(151,187,205,0.2)",
	            strokeColor: "rgba(151,187,205,1)",
	            pointColor: "rgba(151,187,205,1)",
	            pointStrokeColor: "#fff",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(151,187,205,1)",
	            data: <?php echo $data['values'] ; ?>
	        }
		]

	}

window.onload = function(){
	var ctx = document.getElementById("canvas").getContext("2d");
	window.myLine = new Chart(ctx).Line(lineChartData, {
		responsive: true
	});
}


</script>
<?php
	}
?>
</body>
</html>
