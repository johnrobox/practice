

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
 
 
<div id="topBar">
    <a href ="#" id="load_home"> HOME </a>
</div>
<div id ="content">        
</div>

<script>
$(document).ready( function() {
    $("#load_home").on("click", function() {
        $("#content").load("content.html");
    });
});
</script>

<div id="load_home">
</div>

<div id="clickme">
  Click here
</div>
<img id="book" src="image.jpg" alt="" width="100" height="123">