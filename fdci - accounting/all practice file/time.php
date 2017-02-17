
<?php


$keywords = preg_split("/[\s,]+/", "hypertext language, programming");



$jason = json_encode($keywords);


$data = (json_decode($jason, true));
echo $data['0'];


?>
