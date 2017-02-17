



<?php
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

$jsonData	=	json_encode($arr);
$jsonData	=	json_decode($jsonData, true);
echo '0 = '.$jsonData['a'];
echo '<br>';
echo '1 = '.$jsonData['b'];
echo '<br>';
echo '2 = '.$jsonData['c'];
echo '<br>';
echo '3 = '.$jsonData['d'];
echo '<br>';
echo '4 = '.$jsonData['e'];
echo '<br>';
echo '5 = '.$jsonData[5];
echo '<br>';
echo '6 = '.$jsonData[6];
echo '<hr>';
echo $jsonData;
die();
?>



<?php
	function connection(){
		$connection = mysqli_connect("localhost","root","","john");
		return $connection;
	}
	function insert($data){
		$connection = connection();
		$firstname  = $data[0];
		$lastname   = $data[1];
		$email		= $data[2];
		mysqli_query($connection,"INSERT INTO student (firstname,lastname,email) VALUES ('$firstname','$lastname','$email')");
		return true;
	}
	function display(){
		$connection	=	connection();
		$allRecord	=	mysqli_query($connection,"SELECT * FROM student");
		foreach($allRecord as $row){
			$data[] = $row;
		}
		//echo $data[1]['id'];
		//echo '<br>';
		$jsonData	=	json_encode($data);
		echo $jsonData;
		//return $jsonData;
	}
?>

<?php
//echo display();
//die();
if(isset($_POST['submit'])){
	$data = array(
		ucwords(strtolower($_POST['firstname'])),
		ucwords(strtolower($_POST['lastname'])),
		$_POST['email']
	);
	if(insert($data)){
		echo "Data inserted successful.";
	}else{
		echo "Data not inserted.";
	}
}
?>  
<table border="1">
	<tr style="background-color:#ddd;">
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Email</th>
	</tr>
	<?php  
	display();
	echo '<hr>';
	foreach($data as $key => $value){
	?>
	<tr>
		<td><?php echo $data[$key]['firstname']; ?></td>
		<td><?php echo $data[$key]['lastname']; ?></td>
		<td><?php echo $data[$key]['email']; ?></td>
	</tr>
	<?php 
	}
	?>
</table>
<hr>

<form action="" method="post">
	<label>Firstname</label>
	<input type="text" name="firstname" />
	<br>
	<label>Lastname</label>
	<input type="text" name="lastname"/>
	<br>
	<label>Email</label>
	<input type="email" name="email"/>
	<br>
	<input type="submit" name="submit" value="Add"/>
</form>