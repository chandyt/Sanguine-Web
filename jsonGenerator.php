<?php

  $donors =array  (
	array  (
    'Name' => 'John Doe',
    'Latitude' => '29.55',
	'Longitude' => '-82.33',
	'Verified'=>'yes',
	'BloodType'=>'ABp',
	'Username'=>'doe'),
	array  (
    'Name' => 'Jane Doe',
    'Latitude' => '29.65',
	'Longitude' => '-82.33',
	'Verified'=>'yes',
	'BloodType'=>'Ap',
	'Username'=>'doe'),
	array  (
    'Name' => 'John Smith',
    'Latitude' => '29.65',
	'Longitude' => '-82.43',
	'Verified'=>'yes',
	'BloodType'=>'On',
	'Username'=>'doe'),
  );

$data_string = json_encode  ($donors);

header("Location: http://localhost/Sanguine-Web/maps.php?data=".$data_string);



?>
