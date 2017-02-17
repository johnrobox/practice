
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
<div style='overflow:hidden;height:450px;width:450px;'>
<div id='gmap_canvas' style='height:450px;width:450px;'></div>
<style>#gmap_canvas img{max-width:none!important;background:none!important}
</style></div> <a href='https://embedmap.org/'>add google map</a> 
<script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=d36d2b03ec7f4b78f8ab8fbe1937fdccc5147ee0'>
	
</script><script type='text/javascript'>
function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(10.3288403,123.90671880000002),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(10.3288403,123.90671880000002)});infowindow = new google.maps.InfoWindow({content:'<strong>Forty Degrees Celsius Inc.</strong><br>Park Centrale<br>6000 Cebu<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
  	



  	<pre>
  	<?php
  	
		$string = new SplString("Testing");

		try {
		    $string = array();
		} catch (UnexpectedValueException $uve) {
		    echo $uve->getMessage() . PHP_EOL;
		}

		var_dump($string);
		echo $string; // Outputs "Testing"
	?>
  	<?php //print_r($_GET); ?>
  	<?php //print_r($_POST); ?>
  	<?php //print_r($_COOKIE); ?>
  	<?php //print_r($_SERVER); ?>
  	<?php //print_r($_FILES); ?>
  	<?php //print_r($_ENV); ?>
  	<?php //print_r($_REQUEST); ?>
  	<?php //print_r($_SESSION); ?>
  	<?php //setcookie("myName", "John Robert Jerodiaz"); ?>
  	
  	</pre>

	<div class="container">
		<form action="display.php" method="post">
			<div class="form-group">
				<label for="fullName">Full Name</label>
				<input type="text" name="fullName" id="fullName" class="form-control"/>
			</div>
			<div class="form-group">
				<input type="submit" value="Submit" class="btn btn-primary"/>
			</div> 
		</form>
	</div>