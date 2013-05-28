
	<div class="post">
		
<h2 class="title">Statystyki</h2>

<?php
require 'class.inc.php';
$db = new db();
@$osoby = $db->listOsoby(array('userId' => $_SESSION['id']));	
$c  = count($osoby);
?>
 
<?php
$out = $db->statistics();
?>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/dx.chartjs.js"></script>
	   
      <!-- ... -->
    <script type="text/javascript">
		    var m2 = <?= $c?>;
		 </script>
		   
		    <!-- ... -->
    <script type="text/javascript">	
		$(function () {
			$("#gaugeContainer").dxCircularGauge({
				preset: 'preset2',
				scale: {
					startValue: 0,
					endValue: 100,
					majorTick: {
						color: 'black',
						tickInterval : 10
					},
					minorTick: {
						visible: true,
						color: 'black',
						tickInterval : 1
					}
				},
				needles: [{ value: m2,
				color : 'red'}],
				spindle: {color : 'red'},
				markers: [{ value: m2,
				color: 'green'}],
				rangeContainer: {
					ranges: [
						{
							startValue: 0,
							endValue: 40,
							color: '#A6C567'
						},
						{
							startValue: 40,
							endValue: 60,
							color: '#FCBB69'
						},
						{
							startValue: 60,
							endValue: 100,
							color: '#E19094'
						}
					],
					offset: 5,
				}
			});
		});
	</script>
	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);
		function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Imie', 'Ilosc wystapien'],
			<?php foreach($out as $key) {?>
			['<?=$key['_id']?>', <?=$key['suma']?>], 
			<?php } ?>
		]);

		var options = {
		  title: ''
		};

		var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		chart.draw(data, options);
		}
	</script>
	
	<p style="text-align: center;font-weight:bold;margin-bottom:60px;font-size:17px;">Łączna liczba kontaktów: <?php echo $c; ?></p>
	<div id="gaugeContainer" style="height:400px"></div>
	
	
	<p style="text-align:center;font-weight:bold;margin-top:150px;font-size:17px;" > 5 najbardziej popularnych imion </p>
	<div id="chart_div" style="width: 900px; height: 500px;"></div>

	
		
	</div>
	







