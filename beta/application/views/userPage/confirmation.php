<div class="main-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" style="background: #fff; padding: 20px">
				<h1 class="text-center">Please review the information below</h1><hr>
				<h2 class="text-center">Your information.</h2>
				<h3>
					<small>Name: </small><?php echo $firstname.' '.$middlename.' '.$lastname?><br> 
					<small>Age: </small><?php echo $age?><br> 
					<small>Address: </small><?php echo $address?><br> 
					<small>Contact Number: </small><?php echo $contactnumber?><br> 
					<small>Email Address: </small><?php echo $emailaddress?><br> 
					<small>How did you found out the Seminar?: </small><?php echo $found;?>
				</h3><hr>
				<h2 class="text-center">Seminar information</h2>
				<h3>
				<?php 
					foreach ($query_seminar_selected as $row) {
						echo '<small>Seminar Name: </small>'.$row->seminar_name.'<br>';
						echo '<small>Seminar Location: </small>'.$row->seminar_location.'<br>';
						echo '<small>Seminar Date: </small>'.date('F d, Y', strtotime($row->seminar_date)).'<br>';
						echo '<small>Seminar Date: </small>'.$row->seminar_time;
					} 
				?>
				</h3><br>
				<form action="<?php echo base_url().'registration/edit'?>" method="POST" class="text-center">
					<input type="hidden" name="firstname" value="<?php echo $firstname;?>">
					<input type="hidden" name="middlename" value="<?php echo $middlename;?>">
					<input type="hidden" name="lastname" value="<?php echo $lastname;?>">
					<input type="hidden" name="age" value="<?php echo $age;?>">
					<input type="hidden" name="address" value="<?php echo $address;?>">
					<input type="hidden" name="contactnumber" value="<?php echo $contactnumber;?>">
					<input type="hidden" name="emailaddress" value="<?php echo $emailaddress;?>">
					<input type="hidden" name="found" value="<?php echo $found;?>">
					<input type="hidden" name="cs_id" value="<?php echo $cs_id;?>">
					<button class="btn btn-primary pull-left" type="submit"><span class="glyphicon glyphicon-backward"></span> Edit</button> 
				</form>
				<form action="<?php echo base_url().'submitInfo'?>" method="POST" class="text-center">
					<input type="hidden" name="firstname" value="<?php echo $firstname;?>">
					<input type="hidden" name="middlename" value="<?php echo $middlename;?>">
					<input type="hidden" name="lastname" value="<?php echo $lastname;?>">
					<input type="hidden" name="age" value="<?php echo $age;?>">
					<input type="hidden" name="address" value="<?php echo $address;?>">
					<input type="hidden" name="contactnumber" value="<?php echo $contactnumber;?>">
					<input type="hidden" name="emailaddress" value="<?php echo $emailaddress;?>">
					<input type="hidden" name="found" value="<?php echo $found;?>">
					<input type="hidden" name="cs_id" value="<?php echo $cs_id;?>">
					<button class="btn btn-primary pull-right" type="submit">Submit <span class="glyphicon glyphicon-forward"></span></button> 
				</form>
			</div>
			<div class="col-md-2"></div>
		</div><br><br> 
	</div>
</div>