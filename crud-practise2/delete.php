<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = 'localhost';
$user = "root";
$password = "";
$database = "cruduser";

$connection = mysqli_connect($host, $user, $password, $database);

if (!isset($_GET['id']) && empty($_GET['id'])) {
    $response = array(
        'valid' => false,
        'message' => 'Must to specifiy user id to complete deletion.'
    );
} else {
    $id = $_GET['id'];
    $delete  = $connection->query('DELETE FROM users WHERE id = '.$id);
    if ($delete) {
        $response = array(
            'valid' => true,
            'message' => 'User delete success.'
        );
    } else {
        $response = array(
            'valid' => false,
            'message' => 'Error in user deletion.'
        );
    }
}

echo json_encode($response);