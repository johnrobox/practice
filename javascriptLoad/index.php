
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script>
     $(document).ready(function(){
         setInterval(function(){
            $("#loadContent").load("testPage.php");},1000);
         });
 </script>
<div id="loadContent">

</div>
<button onclick="clickMe(34)">Click Me</button>
<button>Hello</button>
<script>
	function clickMe(id) {
		alert(id);
	}
</script>
