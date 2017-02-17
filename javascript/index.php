<!DOCTYPE html>
<html>
<head>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<script>
	$(document).ready(function(){
		$(".btn").click(function(){
			var name = $("#name").val();
			var birthdate = $("#birthdate").val();
			$.ajax({
				url: 'insert.php',
				dataType: 'text',
				type: 'post',
				data: {
					name: name,
					birthdate: birthdate
				},
				success: function(msg){
					if(msg == 'ok'){
						$("table").append("<tr class='"+name+"'><td>"+name+"</td><td>"+birthdate+"</td><td><button onclick='edit()' class='btn btn-primary'>Edit</button> <button onclick='deleteData(1)' class='btn btn-danger'>Delete</button></td></tr>");
					} else {
						alert("Insertion Error");
					}
				},
				error: function(){
					alert("error");
				}
			});
		});
		
	});
	function editData(){
			alert("Edit button is click");
	}
	function deleteData(name) {
		if(confirm("Are you sure you want to delete ?")) {
			$(name).hide();
		}
	}
</script>
</head>
<body>

<div class="container" style="margin-top:100px;">
<p id="demo"></p>
<div id="hello">Hello Content</div>
<button class="btn btn-success">click to load </button>
<script>
var cars = ["John Robert Jerodiaz", "Volvo", "BMW"];
document.getElementById("demo").innerHTML = 'This is the test javascript array';
$(document).ready(function(){
	$('.btn').click(function(){
		alert(document.getElementById("hello"));
	});
});
</script>
<hr>
	<table class="table table-bordered table-hovered">
		<tr>
			<th>Name</th>
			<th>Birthdate</th>
			<th>Action</th>
		</tr>
	</table>
	<div class="breadcrumb">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control"/>
			</div>
			<div class="form-group">
				<label for="birthdate">Birthdate</label>
				<input type="text" name="birthdate" id="birthdate" class="form-control"/>
			</div>
			<button type="submit" class="btn btn-primary">Add</button>
	</div>
</div>

</body>
</html>
