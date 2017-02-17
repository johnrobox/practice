<?php

$_POST = json_decode(file_get_contents('php://input'), true);
print_r($_POST);

	// $connection = mysqli_connect('localhost', 'root', '', 'angular_validation');

	// $connection->query("INSERT INTO user (name, username, email) VALUES ('john robert', 'john', 'johnrobertjerodiaz@gmail.com')");