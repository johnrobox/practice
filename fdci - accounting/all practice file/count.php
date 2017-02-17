
<?php 
 function digitTracker($theNumber){
	echo 'The original number is <b>'.$theNumber.'</b><br>'; 
	$digit = strlen($theNumber);
	$trackFirstDigit = $digit;
	$numberLabel = 1;
	$textLabel = ' digit is : ';
	for($digit; $digit>0; $digit--){
	    $zeros = $digit-1;
		$numberOfZeros = '';
		if($zeros!=0){
			for($zeros;$zeros>0;$zeros--){
				$numberOfZeros = $numberOfZeros.'0';
			}
			$tracker = '1'.$numberOfZeros;
			if($digit==$trackFirstDigit){
				echo $numberLabel.$textLabel.' = '.floor($theNumber/intval($tracker));
				$theNumber = $theNumber%intval($tracker);
			}else{
				echo $numberLabel.$textLabel.' = '.floor($theNumber/intval($tracker));
				$theNumber = $theNumber%intval($tracker);
			}
			echo '<br>';
		}else{
			echo $numberLabel.$textLabel.' = '.floor($theNumber%intval($tracker));
		}
		$numberLabel++;
	}
 }
?>
<?php
if(isset($_POST['submit'])){
	echo digitTracker($_POST['number']);
}
?>
<form action="" method="post">
	<label for="number">Enter your number : </label>
	<input type="text" name="number" id="number"/>
	<input type="submit" name="submit" value="Track Digit"/>
</form>
