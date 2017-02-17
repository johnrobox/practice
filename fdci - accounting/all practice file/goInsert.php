<?php
	$con = mysqli_connect("localhost","root","","ajaxdelete");
	for($i=0;$i<50;$i++){
		mysqli_query($con,"INSERT INTO personalinfo (firstname,middlename,lastname,gender) VALUES ('John Robert','Pahayahay','Jerodiaz','male')");
	}
	
