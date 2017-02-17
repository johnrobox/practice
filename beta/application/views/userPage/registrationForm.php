<div class="main-bg">
	<?php foreach ($query_seminar_selected as $row) {?> 
		<h2 class="text-center"><span class="glyphicon glyphicon-exclamation-sign" style="color: red;"></span> Your Basic Information<br>
		(<span style="font-size: 17px;" class="required">We will not disclose the information submitted to our website</span>)
		</h2><br><br> 
	<div class="container">
		<div class="row">
			<div class="col-md-8" style="background: #fff;"> 
				<form action="<?php echo base_url().'registration/confirmation'?>" class="form-horizontal" method="POST" id="registrationForm" name="registrationForm"> 
				  <div class="form-group">
		            <span class="required text-center"><?php echo form_error('firstname');?></span>
				    <label class="col-sm-4 control-label" for="firstname">First Name: </label>
				    <div class="col-sm-8">
	            		<span id='registrationForm_firstname_errorloc' class="required text-center"></span>
				   		<input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo set_value('firstname'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
		            <span class="required text-center"><?php echo form_error('middlename');?></span>
				    <label class="col-sm-4 control-label" for="middlename">Middle Name: </label>
				    <div class="col-sm-8">
	            		<span id='registrationForm_middlename_errorloc' class="required text-center"></span>
				    	<input type="text" class="form-control" name="middlename" placeholder="Middle Name" value="<?php echo set_value('middlename'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
		            <span class="required text-center"><?php echo form_error('lastname');?></span>
				    <label class="col-sm-4 control-label" for="lastname">Last Name: </label>
				    <div class="col-sm-8">
	            		<span id='registrationForm_lastname_errorloc' class="required text-center"></span>
				    	<input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo set_value('lastname'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label" for="age">Age</label>
				    <div class="col-sm-3">
				      <span class="required"><?php echo form_error('age');?></span>	
	            		<span id='registrationForm_age_errorloc' class="required text-center"></span>
				      <input type="text" class="form-control" name="age" placeholder="Age" value="<?php echo set_value('age');?>"> 
				    </div>
				  </div> 
				  <div class="form-group">
		            <span class="required text-center"><?php echo form_error('address');?></span>
				    <label class="col-sm-4 control-label" for="address">Address: </label>
				    <div class="col-sm-8">
	            		<span id='registrationForm_address_errorloc' class="required text-center"></span>
				    	<input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo set_value('address'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
		            <span class="required text-center"><?php echo form_error('contactnumber');?></span>
				    <label class="col-sm-4 control-label" for="contactnumber">Contact Number: </label>
				    <div class="col-sm-8">
	            		<span id='registrationForm_contactnumber_errorloc' class="required text-center"></span>
				    	<input type="text" class="form-control" name="contactnumber" placeholder="Contact Number" value="<?php echo set_value('contactnumber'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
		            <span class="required text-center"><?php echo form_error('emailaddress');?></span>
				    <label class="col-sm-4 control-label" for="emailaddress">Email Address: </label>
				    <div class="col-sm-8">
	            		<span id='registrationForm_emailaddress_errorloc' class="required text-center"></span>
				    	<input type="email" class="form-control" name="emailaddress" placeholder="Email Address" value="<?php echo set_value('emailaddress'); ?>">
				    </div>
				  </div>
				  <div class="form-group">
		            <span class="required text-center"><?php echo form_error('found');?></span>
				    <label class="col-sm-4 control-label" for="found">How did you found out the Seminar? </label>
				    <div class="col-sm-8">
	            		<span id='registrationForm_found_errorloc' class="required text-center"></span>
						<div class="radio">
						  <label>
						    <input type="radio" name="found" value="Text"> Text
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="found" value="Flyers"> Flyers
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="found" value="Tarpaulin/Poster"> Tarpaulin/Poster
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="found" value="Facebook"> Facebook
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="found" value="Referred by a friend"> Referred by a friend
						  </label>
						</div> 
				    </div>
				  </div> 
					<input type="hidden" name="cs_id" value="<?php echo $row->seminar_id; ?>">
					<div class="row">
						<div class="col-md-6">
							<button type="button" onclick="goBack()" class="btn btn-primary pull-right">Back</button>
						</div>
						<div class="col-md-6">
						<?php  if(date('F d, Y') == date('F d, Y',strtotime($row->seminar_ends))){
				        		echo '<button type="button" class="btn btn-danger btn-block btn-md" disabled>Registration Closed</button>';
				        	}else{
				        		echo '<button type="submit" class="btn btn-primary">Submit my Information</button>';
				        	}
				        ?>			  				
						</div>
					</div><br>
				</form>
			</div>
			<div class="col-md-4"> 
			    <div class="thumbnail">
			      <div class="caption">
			      	<img src="<?php  
	                if($row->seminar_pic == ''){
	                  echo base_url().'/images/default-image.jpg';}
	                  else{
	                  echo base_url().$row->seminar_pic;}
	                ?>" 
	                class="img-responsive" width="500px" height="300px">
			      	<h3 class="text-center"><?php echo $row->seminar_name; ?><br><small>Choosen Seminar</small></h3><hr>
			        <h4> <small>Location:</small> <?php echo $row->seminar_location; ?></h4>
			        <h4> <small>Date:</small> <?php echo date('F d, Y', strtotime($row->seminar_date)); ?></h4> 
			        <h4> <small>Time:</small> <?php echo $row->seminar_time; ?></h4> 
			      </div>
			    </div> 
			</div>
		</div>
	</div>
	<br>
</div>

<script language="JavaScript" type="text/javascript" xml:space="preserve"> 

  var frmvalidator  = new Validator("registrationForm");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("firstname","req","Please enter your Firstname");
    frmvalidator.addValidation("firstname","minlen=2", "Minimum characters for this field is 2.");

    frmvalidator.addValidation("middlename","req","Please enter your Middlename");
    frmvalidator.addValidation("middlename","minlen=2", "Minimum characters for this field is 2.");
    
    frmvalidator.addValidation("lastname","req","Please enter your Lastname");
    frmvalidator.addValidation("lastname","minlen=2", "Minimum characters for this field is 2.");
    
    frmvalidator.addValidation("age","req","Please enter your Age");
    frmvalidator.addValidation("age","num");
    frmvalidator.addValidation("age","maxlen=2", "Maximum characters for this field is 2.");
    
    frmvalidator.addValidation("contactnumber","req","Please enter your Contact Number");
    frmvalidator.addValidation("contactnumber","num");
    frmvalidator.addValidation("contactnumber","minlen=8", "Minimum characters for this field is 8.");

    frmvalidator.addValidation("address","req","Please enter your Adress"); 

    frmvalidator.addValidation("emailaddress","maxlen=50");
    frmvalidator.addValidation("emailaddress","req", "Please enter your Email Address");
    frmvalidator.addValidation("emailaddress","email"); 

    frmvalidator.addValidation("found","selone","Please select an options below");

</script>

<script>
function goBack() {
    window.history.back();
}
</script>
<?php }?>