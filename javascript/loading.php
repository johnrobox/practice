<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<style>
.cover {
  height: 100%;
  width: 100%;
  position: absolute;
  z-index: 1;
}

.content {
  width: 650px;
  margin: 0 auto;
  padding-top: 100px;
}

.pop-up {
  position: fixed;
  margin: 5% auto;
  left: 0;
  right: 0;
  z-index: 2;
}

.box {
  background-color: whitesmoke;
  text-align: center;
  margin-left: auto;
  margin-right: auto;
  margin-top: 10%;
  position: relative;
  -webkit-box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
  -moz-box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
  box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.1);
}

.close-button {
  transition: all 0.5s ease;
  position: absolute;
  background-color: #FF9980;
  padding: 1.5px 7px;
  left: 0;
  margin-left: -10px;
  margin-top: -9px;
  border-radius: 50%;
  border: 2px solid #fff;
  color: white;
  -webkit-box-shadow: -4px -2px 6px 0px rgba(0,0,0,0.1);
  -moz-box-shadow: -4px -2px 6px 0px rgba(0,0,0,0.1);
  box-shadow: -3px 1px 6px 0px rgba(0,0,0,0.1);
}

.close-button:hover {
  background-color: tomato;
  color: #fff;
}

.blur-in {
  -webkit-animation: blur 2s forwards;
  -moz-animation: blur 2s forwards;
  -o-animation: blur 2s forwards;
  animation: blur 2s forwards;
}

.blur-out {
  -webkit-animation: blur-out 2s forwards;
  -moz-animation: blur-out 2s forwards;
  -o-animation: blur-out 2s forwards;
  animation: blur-out 2s forwards;
}

@-webkit-keyframes 
blur { 0% {
 -webkit-filter: blur(0px);
 -moz-filter: blur(0px);
 -o-filter: blur(0px);
 -ms-filter: blur(0px);
 filter: blur(0px);
}
 100% {
 -webkit-filter: blur(4px);
 -moz-filter: blur(4px);
 -o-filter: blur(4px);
 -ms-filter: blur(4px);
 filter: blur(4px);
}
}

@-moz-keyframes 
blur { 0% {
 -webkit-filter: blur(0px);
 -moz-filter: blur(0px);
 -o-filter: blur(0px);
 -ms-filter: blur(0px);
 filter: blur(0px);
}
 100% {
 -webkit-filter: blur(4px);
 -moz-filter: blur(4px);
 -o-filter: blur(4px);
 -ms-filter: blur(4px);
 filter: blur(4px);
}
}

@-o-keyframes 
blur { 0% {
 -webkit-filter: blur(0px);
 -moz-filter: blur(0px);
 -o-filter: blur(0px);
 -ms-filter: blur(0px);
 filter: blur(0px);
}
 100% {
 -webkit-filter: blur(4px);
 -moz-filter: blur(4px);
 -o-filter: blur(4px);
 -ms-filter: blur(4px);
 filter: blur(4px);
}
}

@keyframes 
blur { 0% {
 -webkit-filter: blur(0px);
 -moz-filter: blur(0px);
 -o-filter: blur(0px);
 -ms-filter: blur(0px);
 filter: blur(0px);
}
 100% {
 -webkit-filter: blur(4px);
 -moz-filter: blur(4px);
 -o-filter: blur(4px);
 -ms-filter: blur(4px);
 filter: blur(4px);
}
}

@-webkit-keyframes 
blur-out { 0% {
 -webkit-filter: blur(4px);
 -moz-filter: blur(4px);
 -o-filter: blur(4px);
 -ms-filter: blur(4px);
 filter: blur(4px);
}
 100% {
 -webkit-filter: blur(0px);
 -moz-filter: blur(0px);
 -o-filter: blur(0px);
 -ms-filter: blur(0px);
 filter: blur(0px);
}
}
 
@-moz-keyframes 
blur-out { 0% {
 -webkit-filter: blur(4px);
 -moz-filter: blur(4px);
 -o-filter: blur(4px);
 -ms-filter: blur(4px);
 filter: blur(4px);
}
 100% {
 -webkit-filter: blur(0px);
 -moz-filter: blur(0px);
 -o-filter: blur(0px);
 -ms-filter: blur(0px);
 filter: blur(0px);
}
}

@-o-keyframes 
blur-out { 0% {
 -webkit-filter: blur(4px);
 -moz-filter: blur(4px);
 -o-filter: blur(4px);
 -ms-filter: blur(4px);
 filter: blur(4px);
}
 100% {
 -webkit-filter: blur(0px);
 -moz-filter: blur(0px);
 -o-filter: blur(0px);
 -ms-filter: blur(0px);
 filter: blur(0px);
}
}

@keyframes 
blur-out { 0% {
 -webkit-filter: blur(4px);
 -moz-filter: blur(4px);
 -o-filter: blur(4px);
 -ms-filter: blur(4px);
 filter: blur(4px);
}
 100% {
 -webkit-filter: blur(0px);
 -moz-filter: blur(0px);
 -o-filter: blur(0px);
 -ms-filter: blur(0px);
 filter: blur(0px);
}
}
</style>
<script>
$(function() {
  $('.pop-up').hide();
  $('.pop-up').fadeIn(1000);
  
  $('.close-button').click(function (e) { 

  $('.pop-up').fadeOut(700);
  $('#overlay').removeClass('blur-in');
  $('#overlay').addClass('blur-out');
  e.stopPropagation();
    
  });
});
</script>
<div class="container">
	<div id="overlay" class="cover blur-in">
	  <div class="content">
		Your content goes here
	  </div>
	</div>
	<div class="pop-up">
		<a href="#" class="close-button">&#10006;</a>
		Your modal content goes here.
	</div>	
    
	<a class="btn btn-lg btn-success" href="#">
		<i class="fa fa-flag fa-2x pull-left"></i> Font Awesome<br>Version 4.4.0
	</a>
</div>

</body>
</html>
