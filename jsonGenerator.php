<?php
/*  session_start();
  $donors =array  (
	array  (
    'Name' => 'John Doe',
    'Latitude' => '29.55',
	'Longitude' => '-82.33',
	'Verified'=>'yes',
	'type'=>'ABp',
	'Username'=>'doe'),
	array  (
    'Name' => 'Jane Doe',
    'Latitude' => '29.65',
	'Longitude' => '-82.33',
	'Verified'=>'yes',
	'type'=>'Ap',
	'Username'=>'doe'),
	array  (
    'Name' => 'John Smith',
    'Latitude' => '29.65',
	'Longitude' => '-82.43',
	'Verified'=>'yes',
	'type'=>'On',
	'Username'=>'doe'),
  );

$data_string = json_encode  ($donors);

echo $data_string;
$_SESSION["data"] =$data_string;
//header("Location: http://localhost/Sanguine-Web/maps1.php"); */
header("Location: http://localhost/Sanguine-Web/gpsdata.php");


?>
