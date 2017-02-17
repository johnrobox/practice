<html>
	<head>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<script>
			$(function(){
				$.getJSON("http://practice.com/explode/api.php?method=getAllUsers&jsoncallback=?",
					function(data){
						console.log(data);
						for (aUser in data) {
							var user = data[aUser];
							document.writeln(user.firstname+' '+user.lastname);
							document.writeln("<br>");
						}
					}
				);
			});
		</script>
	</head>
	<body>
	<h1>API Testing</h1>
	</body>
</html>