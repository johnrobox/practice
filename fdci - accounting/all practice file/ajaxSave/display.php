<?php 
	function connection(){
		$connection	=	mysqli_connect("localhost","root","","ajaxdb");
		return $connection;
	}
	$connection = connection();
	$result = mysqli_query($connection,"SELECT * FROM names");
?>

<table border="2">
			<tr style="background-color: #ddd;">
				<th>No.</th>
				<th>Name</th>
				<th>Location</th>
				<th>Action</th>
			</tr>
<?php $number = 1;
	while($row = mysqli_fetch_array($result) ) { ?>
		
			<tr>
				<td><?php echo $number; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['location']; ?></td>
				<td><a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
			</tr>
		
<?php 
$number++;
	} ?>
</table>