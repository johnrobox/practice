<?php

$data = json_decode(file_get_contents('php://input'));


if (!isset($data->firstname) || empty($data->firstname)) {
    $response = array(
        'valid' => false,
        'message' => 'Firstname is required.'
    );
} else if (!isset($data->lastname) || empty($data->lastname)) {
    $response = array(
        'valid' => false,
        'message' => 'Lastname is required.'
    );
} else if (!isset($data->address) || empty($data->address)) {
    $response = array(
        'valid' => false,
        'message' => 'Address is required.'
    );
 } else {
     $host = "localhost";
     $user = "root";
     $password = "";
     $database = "cruduser";
     $connection = mysqli_connect($host, $user, $password, $database);
     
     $firstname = $data->firstname;
     $lastname = $data->lastname;
     $address = $data->address;
     
     if (!isset($data->id)) {
        $insert = $connection->query('INSERT INTO users (firstname, lastname, address) VALUES ("'.$firstname
        .'", "'.$lastname.'", "'.$address.'")');
       if ($insert) {
           $response = array(
              'valid' => true,
               'message' => 'User has been added successfully.'
           );
       } else {
           $response = array(
               'valid' => false,
               'message' => 'Error in adding.'
           );
       }
     } else {
         $id = $data->id;
         $update = $connection->query('UPDATE users SET firstname ="'.$firstname.'", lastname="'.$lastname.'", address="'.$address.'" WHERE id='.$id);
         if ($update) {
             $response = array(
                 'valid' => true,
                 'message' => 'User has udate succuess.'
             );
         } else {
             $response = array(
                 'valid' => false,
                 'message' => 'Error in update'
             );
         }
     }
 }
 
 echo json_encode($response);