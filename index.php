
<!--- EnviroMon Index Page --->

<?php

require 'includes/db.php';	//database access
require 'includes/template.php';	//template handler

$indoorSensIndex = 1;
$outdoorSensIndex = 2;
$crawlSensIndex = 3;
$pressSensIndex = 4;

$d4 = array(4);
$t4 = array(4);
$h4 = array(4);
$sensor = array(1,5,4,6,3);
$location = array('indoor DHT22', 'indoor AM2302', 'outdoor AM2302', 'crawl space');

$timeVal  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$today = date("Y-m-d", $timeVal);
$qYear = date("Y", $timeVal);
$qMonth = date("m", $timeVal);
$qDay = date("d", $timeVal);

$ticTime = time();
function tic()
{
	global $ticTime;
	$ticTime = time();
	echo "<br>tic";
}

function toc()
{
	global $ticTime;
	$tocTime = time();
	echo "<br>toc ";
	echo $tocTime-$ticTime;
	echo "<br>";
}

function PrintR($title, $variable)
{
	echo "<br>";
	echo $title;
	echo '-- ';
	print_r($variable); 
	echo "<br>";
	echo "<br>";
}

tic(); //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

//###################################################
//CURRENT TEMPERATURE AND HUMIDITY X 4
for($i=0; $i<4; $i++)
{
	$j = $sensor[$i];
	// $sql = 
	// "SELECT * " .
	// "FROM (SELECT * FROM data WHERE sensor=$j ORDER BY id DESC) data2 " .
	// "LIMIT 1;";

	$sql = 
	"SELECT stamp, temperature, humidity " .
	"FROM data WHERE sensor=$j
		AND year ='" . $qYear . "' 
		AND month ='" . $qMonth . "' 
		AND day ='" . $qDay . "'
 		ORDER BY id DESC LIMIT 1";

	$result = $db->query($sql);

	$d = 0;
	$t = array();
	$h = array();

	//get the last value
	while ( $row = $result->fetch_array(MYSQL_ASSOC) ) 
	{
		$d = $row['stamp'];
		$t = $row['temperature'];
		$h = $row['humidity'];
	}

	$d4[$i] = $d;
	$t4[$i] = $t;
	$h4[$i] = $h;
}

$values['currentTimes'] = $d4;
$values['currentTemps'] = $t4;
$values['currentHumids'] = $h4;
$values['location'] = $location;


//###################################################
//TEMPERATURE CHART INDOOR - HOURLY AVERAGE
$t1 = array();
$j = $sensor[$indoorSensIndex];
for($i=0; $i<25; $i++)
{
	$sql =
		"SELECT AVG(temperature) AS avgTemp " .
		"FROM data WHERE sensor=$j 
			AND year ='" . $qYear . "' 
			AND month ='" . $qMonth . "' 
			AND day ='" . $qDay . "' 
			AND hour ='" . $i . "'";
		// "FROM data WHERE sensor=$j AND date(stamp) ='" . $today . "' AND hour(stamp) ='" . $i . "'";

	$result = $db->query($sql);
	$value = $result->fetch_array(MYSQL_ASSOC);
	$t1[] = $value['avgTemp'];
}

$values['chartTemperatureIn-hourly'] = $t1;


//###################################################
//TEMPERATURE CHART OUTDOOR - HOURLY AVERAGE
$t1 = array();
$j = $sensor[$outdoorSensIndex];
for($i=0; $i<25; $i++)
{
	$sql =
		"SELECT AVG(temperature) AS avgTemp " .
		"FROM data WHERE sensor=$j 
			AND year ='" . $qYear . "' 
			AND month ='" . $qMonth . "' 
			AND day ='" . $qDay . "' 
			AND hour ='" . $i . "'";
		// "FROM data WHERE sensor=$j AND date(stamp) ='" . $today . "' AND hour(stamp) ='" . $i . "'";

	$result = $db->query($sql);
	$value = $result->fetch_array(MYSQL_ASSOC);
	$t1[] = $value['avgTemp'];
}

$values['chartTemperatureOut-hourly'] = $t1;


//###################################################
//TEMPERATURE CHART CRAWL SPACE - HOURLY AVERAGE
$t1 = array();
$j = $sensor[$crawlSensIndex];
for($i=0; $i<25; $i++)
{
	$sql =
		"SELECT AVG(temperature) AS avgTemp " .
		"FROM data WHERE sensor=$j 
			AND year ='" . $qYear . "' 
			AND month ='" . $qMonth . "' 
			AND day ='" . $qDay . "' 
			AND hour ='" . $i . "'";
		// "FROM data WHERE sensor=$j AND date(stamp) ='" . $yesterday . "' AND hour(stamp) ='" . $i . "'";

	$result = $db->query($sql);
	$value = $result->fetch_array(MYSQL_ASSOC);
	$t1[] = $value['avgTemp'];
}

$values['chartTemperatureCrawl-hourly'] = $t1;


//###################################################
//HUMIDITY CHART INDOOR - HOURLY AVERAGE
$t1 = array();
$j = $sensor[$indoorSensIndex];
for($i=0; $i<25; $i++)
{
	$sql =
		"SELECT AVG(humidity) AS avgValue " .
		"FROM data WHERE sensor=$j 
			AND year ='" . $qYear . "' 
			AND month ='" . $qMonth . "' 
			AND day ='" . $qDay . "' 
			AND hour ='" . $i . "'";
		// "FROM data WHERE sensor=$j AND date(stamp) ='" . $yesterday . "' AND hour(stamp) ='" . $i . "'";

	$result = $db->query($sql);
	$value = $result->fetch_array(MYSQL_ASSOC);
	$t1[] = $value['avgValue'];
}

$values['chartHumidityIn-hourly'] = $t1;


//###################################################
//HUMIDITY CHART OUTDOOR - HOURLY AVERAGE
$t1 = array();
$j = $sensor[$outdoorSensIndex];
for($i=0; $i<25; $i++)
{
	$sql =
		"SELECT AVG(humidity) AS avgValue " .
		"FROM data WHERE sensor=$j 
			AND year ='" . $qYear . "' 
			AND month ='" . $qMonth . "' 
			AND day ='" . $qDay . "' 
			AND hour ='" . $i . "'";
		// "FROM data WHERE sensor=$j AND date(stamp) ='" . $yesterday . "' AND hour(stamp) ='" . $i . "'";

	$result = $db->query($sql);
	$value = $result->fetch_array(MYSQL_ASSOC);
	$t1[] = $value['avgValue'];
}

$values['chartHumidityOut-hourly'] = $t1;


//###################################################
//HUMIDITY CHART CRAWL SPACE - HOURLY AVERAGE
$t1 = array();
$j = $sensor[$crawlSensIndex];
for($i=0; $i<25; $i++)
{
	$sql =
		"SELECT AVG(humidity) AS avgValue " .
		"FROM data WHERE sensor=$j 
			AND year ='" . $qYear . "' 
			AND month ='" . $qMonth . "' 
			AND day ='" . $qDay . "' 
			AND hour ='" . $i . "'";
		// "FROM data WHERE sensor=$j AND date(stamp) ='" . $yesterday . "' AND hour(stamp) ='" . $i . "'";

	$result = $db->query($sql);
	$value = $result->fetch_array(MYSQL_ASSOC);
	$t1[] = $value['avgValue'];
}

$values['chartHumidityCrawl-hourly'] = $t1;


//###################################################
//PRESSURE CHART - HOURLY AVERAGE
$t1 = array();
$j = $sensor[$pressSensIndex];
for($i=0; $i<25; $i++)
{
	$sql =
		"SELECT AVG(pressure) AS avgValue " .
		"FROM data WHERE sensor=$j 
			AND year ='" . $qYear . "' 
			AND month ='" . $qMonth . "' 
			AND day ='" . $qDay . "' 
			AND hour ='" . $i . "'";
		// "FROM data WHERE sensor=$j AND date(stamp) ='" . $yesterday . "' AND hour(stamp) ='" . $i . "'";

	$result = $db->query($sql);
	$value = $result->fetch_array(MYSQL_ASSOC);
	$t1[] = $value['avgValue'];
}

$values['chartPressure-hourly'] = $t1;


//###################################################
//PASS VALUES TO TEMPLATE FOR DISPLAY
//new instance of template handler for INDEX template
$tpl = new Template('index');

//pass these variables to our template
$tpl->vars = array(
	'values' => $values
);

//compile and print template
$tpl->render();

toc(); //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

?>
