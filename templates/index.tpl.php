
<!-- INDEX TEMPLATE -->

<?php
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');

//echo 'USE_CACHE =';
//print_r(USE_CACHE);
//echo '<br>';

//echo 'CACHE_DIR =';
//print_r(CACHE_DIR);
//echo '<br>';

//echo 'values =';
//print_r($values);
//echo '<br>';

?>

<!-- CURRENT CONDITIONS -->
<h2>Current Conditions</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Time</th>
			<th> </th>
			<th>Temperature</th>
			<th>Humidity</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<!-- tr>
			<td><?= $values['timeStamp'] ?></td>
			<td><?= number_format($values['currentTemp'],1) ?></td>
			<td><?= number_format($values['currentHumid'],1) ?></td>
		</tr -->
		<tr>
			<td><?= $values['currentTimes'][0] ?></td>
			<td> </td>
			<td><?= number_format($values['currentTemps'][0],1) ?></td>
			<td><?= number_format($values['currentHumids'][0],1) ?></td>
		</tr>
		<tr>
			<td><?= $values['currentTimes'][1] ?></td>
			<td> </td>
			<td><?= number_format($values['currentTemps'][1],1) ?></td>
			<td><?= number_format($values['currentHumids'][1],1) ?></td>
		</tr>
		<tr>
			<td><?= $values['currentTimes'][2] ?></td>
			<td> </td>
			<td><?= number_format($values['currentTemps'][2],1) ?></td>
			<td><?= number_format($values['currentHumids'][2],1) ?></td>
		</tr>
		<tr>
			<td><?= $values['currentTimes'][3] ?></td>
			<td> </td>
			<td><?= number_format($values['currentTemps'][3],1) ?></td>
			<td><?= number_format($values['currentHumids'][3],1) ?></td>
		</tr>
	</tbody>
</table>

<!-- YESTERDAY'S AVERAGE CONDITIONS -->
<h2>Yesterday's Average Conditions</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Date</th>
			<th></th>
			<th>Temperature</th>
			<th>Humidity</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= $values['yesterdayDate'] ?></td>
			<td></td>
			<td><?= number_format($values['yesterdayTemp'],1) ?></td>
			<td><?= number_format($values['yesterdayHumid'],1) ?></td>
		</tr>
	</tbody>
</table>


<!-- TEMPERATURE CHART 
<h2>Yesterday's Temperature Chart</h2>


<!-- TEMPERATURE CHART - HOURLY -->
<h2>Yesterday's Temperature Chart</h2>

<?php
$chartFileName = 'chartTemperatureHourly.png';

// Create the graph. These two calls are always required
$graph = new Graph(1024,480,$chartFileName,100,$aInline=false);
$graph->SetScale('textlin');

//Create the linear plot
$lineplot=new LinePlot($values['chartTemperature1-hourly']);
$lineplot->SetColor('darkgreen');
$lineplot->SetStyle('solid');

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke($chartFileName);
echo '<img src="' . $chartFileName . '">';
?>


<!-- TEMPERATURE CHART X 4 -->
<h2>Yesterday's Temperature Chart X 4</h2>

<?php
$chartFileName = 'chartTemperature4.png';

// Create the graph. These two calls are always required
$graph = new Graph(1024,480,$chartFileName,100,$aInline=false);
$graph->SetScale('textlin');

$t4 = $values['chartTemperature4'];

for($i=0; $i<4; $i++)
{
	//Create the linear plot
	$lineplot=new LinePlot($t4[$i]);
	$lineplot->SetColor('darkgreen');
	$lineplot->SetStyle('dashed');

	// Add the plot to the graph
	$graph->Add($lineplot);
}

// Display the graph
$graph->Stroke($chartFileName);
echo '<img src="' . $chartFileName . '">';
?>
