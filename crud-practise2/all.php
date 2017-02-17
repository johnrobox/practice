<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = "localhost";
$user = "root";
$password = "";
$database = "cruduser";
$connection = mysqli_connect($host, $user, $password, $database);

$select = $connection->query('SELECT * FROM users');

$response = array();

while($row = mysqli_fetch_assoc($select)){
    $response[] = $row;
}

echo json_encode($response);