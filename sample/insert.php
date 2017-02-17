

<?php

	$con = mysqli_connect("localhost","root","","july29");
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$gender = $_POST['gender'];
	
	
	$response = array();
	if ( empty($username) ) {
		$response['message'] = 'Username must be field out.';
	} else if ( empty($password) ) {
		$response['message'] = 'Password must be field out.';
	} else if ( empty($firstname) ) {
		$response['message'] = 'Firstname must be field out.';
	} else if ( empty($lastname) ) {
		$response['message'] = 'Lastname must be field out.';
	} else {
		
		$check = mysqli_query($con,"SELECT username FROM member WHERE username='$username'");
		if ( mysqli_num_rows($check) ) {
			$response['message'] = 'Username must be unique.';
		} else {
			$result = mysqli_query($con,"INSERT INTO member (username, password, firstname, lastname, gender) VALUES ('$username', '$password', '$firstname', '$lastname', '$gender')"); 
			if ($result) {
				$response['message'] =  'Hi '.$firstname.' your account has been successfully registered.';
			} else {
				$response['message'] = 'Inable to register account. Error';
			}
		}
	}
	
	echo $response['message'];
	

?>