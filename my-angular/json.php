
<?php 
	$data = array(
		'employees' => array(
			array(
				'firstname' => 'John',
				'lastname' => 'Robert'
			),
			array(
				'firstname' => 'John',
				'lastname' => 'Doe'
			),
			array(
				'firstname' => 'Anna',
				'lastname' => 'Smith'
			),
			array(
				'firstname' => 'Peter',
				'lastname' => 'Jones'
			)
		)
	);
	echo json_encode($data);
?>