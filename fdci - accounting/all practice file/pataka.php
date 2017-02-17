<?php

# Use the Curl extension to query Google and get back a page of results
$url = "http://rentpad.com.ph/long-term-rentals/cebu/one-bedroom-fully-furnished-at-avida-cebu-near-it-park/267a755b20";
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);

# Create a DOM parser object
$dom = new DOMDocument();

# Parse the HTML from Google.
# The @ before the method call suppresses any warnings that
# loadHTML might throw because of invalid HTML in the page.
libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();
$xpath = new DOMXpath($dom);
/*echo '<pre>';
var_dump($xpath);*/


 /* $articles = $xpath->query('//ul[@class="myGalle"]');
  var_dump($articles);
  exit();*/
  //var_dump($articles);
# Iterate over all the <a> tags
//$arr = $dom->getElementsByTagName('div');

foreach($articles as $link) {
	$cnode = $link->childNodes;
	foreach($cnode  as $index=>$sh){
		echo '<pre>';
		//var_dump($cnode->item($index));
		$img = $dom->getElementsByTagName('img');
		// foreach($img as $arraw){
		// 	$src =  $arraw->getAttribute("src");
		// 	echo '<br>';
		// 	echo $src;
		// }
		//var_dump($xpath->$cnode->item($index)->query('//div[@class="galleria-image"]'));
	}
}
?>