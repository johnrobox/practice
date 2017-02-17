<?php
	//connect to database
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("john") or die(mysql_error());
	
	//cal the passed in function
	if (function_exists($_GET['method'])) {
		$_GET['method']();
	}
	
	//methods
	function getAllUsers(){
		$user_sql = mysql_query("SELECT * FROM student");
		$users = array();
		$count = 1;
		while($user = mysql_fetch_array($user_sql)) {
			$users[] = $user;
		}
		$users = json_encode($users);
		//echo $users;
		$json = json_encode(array(
			array(
			'firstname' => 'John Robert',
			'lastname' => 'Jerodiaz',
			'age' => 23
			),
			array(
			'firstname' => 'John Robert',
			'lastname' => 'Jerodiaz',
			'age' => 23
			)
		));
		echo $json;
		//echo $_GET['jsoncallback'] . '('.$json.')';
	}
?>