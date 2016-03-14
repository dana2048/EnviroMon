
<!--- EnviroMon Yesterday Page --->

<?php

require 'includes/db.php';	//database access
require 'includes/template.php';	//template handler

$d4 = array(4);
$t4 = array(4);
$h4 = array(4);
$sensor = array(1,2,4,5);


//###################################################
//YESTERDAY AVERAGE TEMPERATURE AND HUMIDITY
$timeVal  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$yesterday = date("Y-m-d", $timeVal);
$thisMonth = date("m", $timeVal);
$thisYear = date("Y", $timeVal);

$sql = 
"SELECT AVG(temperature) AS yesterdayTemp, AVG(humidity) AS yesterdayHumid " .
"FROM data WHERE sensor=1 AND DATE(stamp)='" . $yesterday . "'";

$result = $db->query($sql);
$value = $result->fetch_array(MYSQL_ASSOC);

$values['yesterdayDate'] = $yesterday;
$values['yesterdayTemp'] = $value['yesterdayTemp'];
$values['yesterdayHumid'] = $value['yesterdayHumid'];


//###################################################
//TEMPERATURE CHART SENSOR 1 - HOURLY AVERAGE
$t1 = array();
for($i=0; $i<24; $i++)
{
	$sql =
		"SELECT AVG(temperature) AS avgTemp " .
		"FROM data WHERE sensor=1 AND date(stamp) ='" . $yesterday . "' AND hour(stamp) ='" . $i . "'";

	$result = $db->query($sql);
	$value = $result->fetch_array(MYSQL_ASSOC);
	$t1[] = $value['avgTemp'];
}

$values['chartTemperature1-hourly'] = $t1;


//###################################################
//TEMPERATURE CHART FOUR SENSORS

for($i=0; $i<4; $i++)
{
	$j = $sensor[$i];
	$sql = 
	"SELECT temperature " .
	"FROM data WHERE sensor=$j AND DATE(stamp)='" . $yesterday . "'";

	$result = $db->query($sql);

//	echo '<pre>';
	$t = array();
	while ( $row = $result->fetch_array(MYSQL_ASSOC) ) 
	{
		$t[] = $row['temperature'];
	}

	$t4[$i] = $t;
/*
	echo 'print_r($row)'; echo "<br>";
	print_r($row); echo "<br>";

	echo 'print_r($t)'; echo "<br>";
	print_r($t);

	echo 'print_r($t4[$i])'; echo "<br>";
	print_r($t4[$i]);
	echo '</pre><hr>'; */
}

$values['chartTemperature4'] = $t4;


//PASS VALUES TO TEMPLATE FOR DISPLAY
//new instance of template handler for INDEX template
$tpl = new Template('yesterday');

//pass these variables to our template
$tpl->vars = array(
	'values' => $values
);

//compile and print template
$tpl->render();

?>