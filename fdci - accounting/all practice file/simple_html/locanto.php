<?php

## set execution time limit
set_time_limit(0);

// CURL
function execUrl($url){
	$request = curl_init();

	curl_setopt_array($request, array
	(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HEADER         => FALSE,
			CURLOPT_SSL_VERIFYPEER => TRUE,
			CURLOPT_CAINFO         => 'cacert.pem',
			CURLOPT_FOLLOWLOCATION => TRUE,
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_USERAGENT		=> 'Mozilla/5.0 (Windows NT x.y; Win64; x64; rv:10.0.1) Gecko/20100101 Firefox/10.0.1'
	));

	$response = curl_exec($request);
	curl_close($request);

	$document = new DOMDocument();

	if($response)
	{
	    libxml_use_internal_errors(true);
	    $document->loadHTML($response);
	    libxml_clear_errors();
	}

	return array("document"=>$document,"response"=>$response);
}

#execute url
$base_url = 'file:///C:/xampp/htdocs/fdc-webcrawler/sites/locanto.html';

## Get the data from page 1 to bottom
$document = execUrl($base_url);

#perform xpath
$xpath = new DOMXpath($document["document"]);

#get text header
$properties = $xpath->query('//div[@class="resultRow"]'); 

#loop through each of the row items
foreach($properties as $container) {

  $arr = $container->getElementsByTagName("a"); // get the anchor tag
  $img = $container->getElementsByTagName("img");

  $url = "";
  $x = 0;
 	foreach ($arr as $index => $item) {
	  	$href = $item->getAttribute("href");
	  	if($x === 1) {
	  		$url = $href;	
	  	}
	  	$x++;
  	}

	## Open single html
	$singleURI = execUrl($url);
	$xpathRow = new DOMXpath($singleURI["document"]);

	## Get the title 
	$rowTitle = $xpathRow->query('//span[@class="h2"]');
	$propTitle = "";
	foreach ($rowTitle as $rowItem) {
		$text = trim(preg_replace("/[\r\n]+/", " ", $rowItem->nodeValue));
		$propTitle = $text;
	}
  
	## Get the price
	$rowPrice = $xpathRow->query('//div[@class="h1gray"]');
	$propPrice = "";
	foreach ($rowPrice as $rowItem) {
		$text = trim(preg_replace("/[\r\n₱,m²BR]+/", "", $rowItem->nodeValue));
		$propPrice = $text;
		$explodedPrice = explode(" ", $propPrice);
	}

	## Get the ID Number
	$rowID = $xpathRow->query('//div[@id="ad-info-header"]');
	$propID = "";
	foreach ($rowID as $rowItem) {
		$text = trim(preg_replace("/[\r\nAdID: ]+/", "", $rowItem->nodeValue));
		$propID = $text;
	}

	## Get the Street Address
	$rowStreet = $xpathRow->query('//span[@itemprop="streetAddress"]');
	$propStreet = "";
	foreach ($rowStreet as $rowItem) {
		$text = trim(preg_replace("/[\r\n]+/", "", $rowItem->nodeValue));
		$propStreet = $text;
	}

	## Get the Local Address
	$rowLocation = $xpathRow->query('//span[@itemprop="addressLocality"]');
	$propCity = "";
	foreach ($rowLocation as $rowItem) {
		$text = trim(preg_replace("/[\r\n]+/", "", $rowItem->nodeValue));
		$propCity = $text;
	}

	## Get the Country
	$rowCountry = $xpathRow->query('//span[@itemprop="addressCountry"]');
	$propCountry = "";
	foreach ($rowCountry as $rowItem) {
		$text = trim(preg_replace("/[\r\n]+/", "", $rowItem->nodeValue));
		$propCountry = $text;
	}

	## Get the Description
	$rowDesc = $xpathRow->query('//div[@id="js-user_content"]');
	$propDesc = "";
	foreach ($rowDesc as $rowItem) {
		$text = trim(preg_replace("/[\r\n]+/", "", $rowItem->nodeValue));
		$propDesc = $text;
	}

	## Get the front image
	$rowImg = $xpathRow->query('//a[@title="Click to view larger image!"]/@href');
	$img = "";
	foreach ($rowImg as $data) {
		$prop_front_img = $data->nodeValue;
	}

	## Get the date
	$rowDate = $xpathRow->query('//div[@class="indent24"]//span/@title');
	$date = "";
	foreach ($rowDate as $rowItem) {
		$date = $rowItem->nodeValue;
	}


	// foreach ($rowDate as $rowItem) {
	// 	$date = $rowItem->nodeValue;
	// }

	## Get all images
	$rowImg = $xpathRow->query('//a[@class="tn_img js-tn_img"]//@href');
	$prop_imgs = array();
	foreach ($rowImg as $row_item_img) {
		$prop_imgs[] = $row_item_img->nodeValue;
		// $imgs = array();
		$imgs = '';
		foreach ($prop_imgs as $rowItem) {
			$imgs = $imgs.' '.$rowItem;
			
		}
		
	}

	if ($propStreet != '') {
		$location = $propStreet.', '.$propCity.', '.$propCountry;
	} else {
		$location = $propCity.', '.$propCountry;
	}

	/* working */
	echo "<hr>";
	echo "<br>";
	$image 	= preg_split("/[\s,]+/",$imgs);
	$jsonImage = json_encode($image);
	echo "<pre>";
	echo $jsonImage;		// prints images
	echo "</pre>";
	echo "<br>";
	echo "<br>";
	echo "<b>Date: </b>" . $date . "<br>";
	echo "<b>Image: </b> " . $prop_front_img . "<br>";		// gets the front image
	echo "<b>Original Link: </b> " . $url . "<br>";
	echo "<b>Title: </b> " . $propTitle . "<br>";
	echo "<b>ID: </b> " . $propID . "<br>";
	echo "<b>Location: </b> " . $location . "<br>";
	echo "<b>Exploded Price: </b> " . $explodedPrice[0] . "<br>";
	echo "<b>Description: </b> " . $propDesc . "<br>";
	echo "<br>";
	echo "<hr>";
	
	}