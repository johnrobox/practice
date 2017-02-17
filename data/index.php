<?php
$data = array(
	'firstname' => 'Hello',
	'lastname' => 'World'
);
$num = 1;
$keys = array();
$values = array();
foreach($data as $key => $value){
	$keys[$num] = $key;
	$num++;
}
for($i=1;$i<$num;$i++){
	echo $keys[$i];
	echo '<br>';
}
?>