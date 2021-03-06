
<!-- Yesterday TEMPLATE -->

<?php
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
?>


<!-- YESTERDAY'S AVERAGE CONDITIONS -->
<h3>Yesterday's Average Conditions</h3>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Date</th>
			<th>Location</th>
			<th>Temperature</th>
			<th>Humidity</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
                $num = count($values['yesterdayTimes']);
		for($i=0; $i<$num; $i++)
		{
			echo('<tr>');
			echo('<td>' . $values['yesterdayTimes'][$i] . '</td>');
			echo('<td>' . $values['location'][$i] . '</td>');
			echo('<td>' . number_format(floatval($values['yesterdayTemps'][$i]),1) . '</td>');
			echo('<td>' . number_format(floatval($values['yesterdayHumids'][$i]),1) . '</td>');
			echo('</tr>');
		}
		?>
	</tbody>
</table>


<!-- TEMPERATURE CHART - HOURLY -->
<h3>Yesterday's Hourly Average Temperature</h3>

<?php
try{
$lineColor = array('red', 'green', 'blue', 'black', 'red', 'green', 'blue', 'black', 'red', 'green', 'blue', 'black', 'red', 'green', 'blue', 'black');
$chartFileName = 'chartTemperatureHourly.png';

// Create the graph
$graph = new Graph(1024,480,$chartFileName,100,$aInline=false);
$graph->SetScale('intlin',0,0,0,23);    //x-axis integer, y-axis linear, y-axis auto range, x-axis 0-23
$graph->SetMargin(50,10,10,0);

// LEGEND
$graph->legend->SetPos(0.02, 0.08, 'right', 'bottom');
$graph->legend->SetShadow('gray@0.2',2);
$graph->legend->SetFont(FF_ARIAL, FS_NORMAL, 10);

// AXES
$graph->yaxis->SetTitleMargin(30);
$graph->xaxis->SetTitle('Time Of Day', 'middle');
$graph->yaxis->SetTitle('Degrees Fahrenheit', 'middle');

$numSensors = count($values['locationT']);
for($i=0; $i<$numSensors; $i++)
{ 
    //Create the linear plot
    $lineplot=new LinePlot($values['chartTemperature-hourly'][$i]);

    // Add the plot to the graph
    $graph->Add($lineplot);
    $lineplot->SetLineWeight(4);
    $lineplot->SetColor($lineColor[$i]);
    $lineplot->SetStyle('solid');
    $lineplot->SetLegend($values['locationT'][$i]);
}

// Display the graph
@unlink($chartFileName);
$graph->Stroke($chartFileName);
echo '<img src="' . $chartFileName . '">';
} 
catch(Exception $e){
    echo $e->getMessage();
}
?>


<!-- HUMIDITY CHART - HOURLY -->
<h3>Yesterday's Hourly Average Humidity</h3>

<?php
try{
$chartFileName = 'chartHumidityHourly.png';

// Create the graph
$graph = new Graph(1024,480,$chartFileName,100,$aInline=false);
$graph->SetScale('intlin',0,0,0,23);
$graph->SetMargin(50,10,10,0);

// LEGEND
$graph->legend->SetPos(0.02, 0.08, 'right', 'bottom');
$graph->legend->SetShadow('gray@0.2',2);
$graph->legend->SetFont(FF_ARIAL, FS_NORMAL, 10);

// AXES
$graph->yaxis->SetTitleMargin(30);
$graph->xaxis->SetTitle('Time Of Day', 'middle');
$graph->yaxis->SetTitle('Percent', 'middle');

$numSensors = count($values['locationH']);
for($i=0; $i<$numSensors; $i++)
{ 
    //Create the linear plot
    $lineplot=new LinePlot($values['chartHumidity-hourly'][$i]);

    // Add the plot to the graph
    $graph->Add($lineplot);
    $lineplot->SetLineWeight(4);
    $lineplot->SetColor($lineColor[$i]);
    $lineplot->SetStyle('solid');
    $lineplot->SetLegend($values['locationH'][$i]);
}

// Display the graph
@unlink($chartFileName);
$graph->Stroke($chartFileName);
echo '<img src="' . $chartFileName . '">';
} 
catch(Exception $e){
    echo $e->getMessage();
}
?>


<!-- PRESSURE CHART - HOURLY -->
<h3>Yesterday's Hourly Average Barometric Pressure</h3>

<?php
try{
$chartFileName = 'chartPressureHourly.png';

// Create the graph
$graph = new Graph(1024,480,$chartFileName,100,$aInline=false);
$graph->SetScale('intlin',0,0,0,23);
$graph->SetMargin(55,10,10,50);

// LEGEND
$graph->legend->SetPos(0.02, 0.08, 'right', 'bottom');
$graph->legend->SetShadow('gray@0.2',2);
$graph->legend->SetFont(FF_ARIAL, FS_NORMAL, 10);

// AXES
$graph->xaxis->SetTitle('Time Of Day', 'middle');
$graph->yaxis->SetTitleMargin(45);
$graph->yaxis->SetTitle('Inches', 'middle');

$numSensors = count($values['locationP']);
for($i=0; $i<$numSensors; $i++)
{ 
    //Create the linear plot
    $lineplot=new LinePlot($values['chartPressure-hourly'][$i]);

    // Add the plot to the graph
    $graph->Add($lineplot);
    $lineplot->SetLineWeight(4);
    $lineplot->SetColor($lineColor[$i]);
    $lineplot->SetStyle('solid');
    $lineplot->SetLegend($values['locationP'][$i]);
}

// Display the graph
@unlink($chartFileName);
$graph->Stroke($chartFileName);
echo '<img src="' . $chartFileName . '">';
} 
catch(Exception $e){
    echo $e->getMessage();
}
?>

<!-- some blank space at the bottom -->
<br><br><br>
