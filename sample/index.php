
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
	$(document).ready(function(){
		$('#submit').click(function(){
			var username = $('#username').val();
			var password = $('#password').val();
			var firstname = $('#firstname').val();
			var lastname = $('#lastname').val();
			var gender = $('#gender').val();
			$.ajax({
				type: "POST",
				url: "insert.php",
				data: {
					username: username,
					password: password,
					firstname: firstname,
					lastname: lastname,
					gender: gender
				},
				success: function(msg){
					$("#result").html(msg);
				},
				error: function() {
					alert ("error");
				}
			});
			return false;
		})
	})
</script>

<div class="container" style="margin-top: 100px;">
	<div class="row">
		<div class="col-sm-5 col-sm-offset-3">
		
			<div class="alert alert-success">
				<div id="result"></div>	
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Register
				</div>
				<form action="" method="post">
					<div class="panel-body">
					
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control"/>
						
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control"/>
						
						<label for="firstname">Firstname</label>
						<input type="text" name="firstname" id="firstname" class="form-control"/>
						
						<label for="lastname">Lastname</label>
						<input type="text" name="lastname" id="lastname" class="form-control"/>
						
						<label for="gender">Gender</label>
						<select name="gender" id="gender" class="form-control">
							<option value="">Select Gender</option>
							<option value="1">Male</option>
							<option value="2">Female</option>
						</select>
					
					</div>
				<div class="panel-footer">
					<input type="submit" class="btn btn-primary" id="submit" value="Register Now"/>
					<input type="reset" class="btn btn-default" value="Clear"/>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>