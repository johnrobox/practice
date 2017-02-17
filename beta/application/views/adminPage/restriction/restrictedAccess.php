<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url();?>images/jeclogo.png" />
        <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" > 
        <link href="<?php echo base_url();?>css/style.css" rel="stylesheet" >
        <link href="<?php echo base_url();?>css/datetime.bootstrap.css" rel="stylesheet" >
</head>
<body class="restriction-background">
	<div class="container wrapper text-center restriction">
	    <h2><i class="glyphicon glyphicon-thumbs-down"></i>&nbsp; You are restricted to access this page !</h2>
	    <p>To complete the action, please do either of the following:</p>
	    <a href="<?php echo base_url().'admin'?>" class="btn btn-default">Log In</a>
	    <a href="<?php echo base_url().'register'?>" class="btn btn-default">Register</a>
	</div>
</body>
</html>