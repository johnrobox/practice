<?php 
	$a = 7;
	$b = 5;
	echo '<hr>';
	echo 'A value is = '.$a;
	echo '<br>';
	echo 'B value is = '.$b;
	echo '<hr>';
	echo 'Swap value result:';
	echo '<br>';
	$a = $a + $b;
	$b = $a - $b;
	$a = $a - $b;
	echo 'A new value is : '.$a;
	echo '<br>';
	echo 'B new value is : '.$b;
?>