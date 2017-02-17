  	
  	<?php echo $_COOKIE["myName"];?>
  	<?php //setcookie("myAddress", "Tapon Cansayahon Ronda Cebu", time() + 180); ?>
  	<?php echo $_SERVER['HTTP_COOKIE']; ?>
  	<pre>

  	<?php print_r($_GET); ?>
  	<?php print_r($_POST); ?>

  	</pre>
<?php

	echo $_POST['fullName'];

	echo "<br>";

	echo (int)$_POST['fullName'];

	echo "<hr>";

	$data = "<h1>This is my String</h1>";

	echo $data;

	echo "<br>";

	echo htmlspecialchars($data);