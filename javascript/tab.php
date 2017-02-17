<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="jquery.idTabs.min.js"></script>
<div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1">Tab 1</a></li> 
    <li><a href="#tabs2" class="selected">Tab 2</a></li> 
    <li><a href="#tabs3">Tab 3</a></li> 
  </ul> 
  <div id="tabs1">This is tab 1.</div> 
  <div id="tabs2">More content in tab 2.</div> 
  <div id="tabs3">Tab 3 is always last!</div> 
</div> 
 
<script type="text/javascript"> 
  $("#usual2 ul").idTabs("tabs2"); 
</script>