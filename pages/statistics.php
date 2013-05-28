<h2 class="title">Statystyki</h2>

<?php
require 'class.inc.php';
		$db = new db();
		$osoby = $db->listOsoby(array('userId' => $_SESSION['id']));	
$c  = count($osoby);
echo "Łączna liczba adresów:  ";
echo $c;

?>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/dx.chartjs.js"></script>
<script type="text/javascript" src="js/jquery.metadata.js"></script>

		   
      <!-- ... -->
    <script type="text/javascript">
		    var m2 =<?echo $c;?>;
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
												  <div id="gaugeContainer" style="height:400px"></div>



