

<?php

$first = array(
	'john'
);
$second = array(
	'robert'
);

$data = array(
			0 => array(
				'name' => array(
					'firstname' => 'john'
					)
			),
			1 => array(
				'name' => array(
					'firstname' => 'john r'
					)
			),
			2 => array(
				'name' => array(
					'firstname' => 'john ro'
					)
			)
	);
echo '<pre>';
print_r($data);
$container =  array();
$counter = 0;
foreach($data as $row) {
	if ($counter != 0) {
		foreach($container as $arr) {
			similar_text($arr, $row['name']['firstname'], $percent); 
			if ($percent < 75) {
				$container = array_merge($container, array($row['name']['firstname']));
			} else {
				
			}
		}
	} else {
		$container = array_merge(array($row['name']['firstname']));
	}
	$counter++;
}
print_r($container);