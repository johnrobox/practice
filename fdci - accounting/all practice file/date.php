<?php

	echo date('Y-m-d h:i:sa');
	
	echo '<hr>';
	
	date_default_timezone_set("Asia/Bangkok");
	echo date_default_timezone_get();
	echo date('Y-m-d h:i:sa');
	
	echo '<hr>';
	$tz = 'Europe/London';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
echo $dt->format('d.m.Y, H:i:s');

echo '<hr>';

date_default_timezone_set("Asia/Manila");
echo date("Y/m/d h:i:sa");

date_default_timezone_set("Asia/Manila");


	?>