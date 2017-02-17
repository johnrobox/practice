<?php

function exeCurl($source_url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $source_url);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT x.y; Win64; x64; rv:10.0.1) Gecko/20100101 Firefox/10.0.1');
  curl_setopt($ch, CURLOPT_REFERER, '');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $curlResults= curl_exec($ch);
  curl_close($ch);
  return $curlResults;
}



$searchUrl = 'http://rentpad.com.ph/ws/search.htm?a=31&cityName=Cebu&propertyTypeIDs=[]&furnishTypeIDs=[3]&placeIDs=[]&statusTypeIDs=[]&amenityIDs=[]&longMonthRateLow=0&longMonthRateHigh=999999&numBedroomsLow=0&numBedroomsHigh=999&itemsPerPage=15&lengthOfStay=&ham=ham&pageNumber=';

$c = 1;
for($b=1;$b<=16;$b++){
	$base_url = 'http://rentpad.com.ph:80/';
	$json =exeCurl($searchUrl.$b);

	$data = (json_decode($json, true));

	for($a=0;$a<15;$a++){

		 $urlTitle = $data['model']['searchResult']['listings'][$a]['urlTitle'];
		 $id = $data['model']['searchResult']['listings'][$a]['id'];
		 $address = $data['model']['searchResult']['listings'][$a]['address'];
		 $city = $data['model']['searchResult']['listings'][$a]['city'];

		 $longTerm = $data['model']['searchResult']['listings'][$a]['leaseLongTerm'];
		 $shortTerm = $data['model']['searchResult']['listings'][$a]['leaseShortTerm'];

		 $Communitydescription = $data['model']['searchResult']['listings'][$a]['community']['description'];
		 $longMonthRate 	=	$data['model']['searchResult']['listings'][$a]['longMonthRate'];
		 $primaryPhoto	=	$data['model']['searchResult']['listings'][$a]['primaryPhoto']['filename'];
		 $sqArea	=	$data['model']['searchResult']['listings'][$a]['sqArea'];
		 $title	=	$data['model']['searchResult']['listings'][$a]['title'];

		 if($longTerm==1){
		 	$termUrl = 'long-term-rentals';

					 	$siteUrl = 'http://rentpad.com.ph/'.$termUrl.'/cebu/'.$urlTitle.'/'.$id;

					 	$completeDescription = exeCurl($siteUrl);
					 	$dom = new DOMDocument();
					 	libxml_use_internal_errors(true);
						$dom->loadHTML($completeDescription);
						libxml_clear_errors();
						$xpath = new DOMXpath($dom);

						//get images
					      $images = array();
					      foreach ($xpath->query('//div[@id="content-photo"]//img[starts-with(@data-src,"http")]') as $image) {
					       $images[] = $image->getAttribute('data-src');
					      }
					      var_dump($images);
						die();

		 }if($shortTerm==1){
		 	$termUrl = 'short-term-rentals';
		 	$siteUrl = 'http://rentpad.com.ph/'.$termUrl.'/cebu/'.$urlTitle.'/'.$id;
		 	echo ' url title : http://rentpad.com.ph/'.$termUrl.'/cebu/'.$urlTitle.'/'.$id;
		 }



		 /*echo $c.' url title : http://rentpad.com.ph/'.$termUrl.'/cebu/'.$urlTitle.'/'.$id;
		 echo '<br> Id : '.$id;*/
		 echo '<br> Descr : '.$completeDescription; 
		 echo '<br> SiteUrl '.$siteUrl; 
		 echo '<br> Adrss : '.$address;
		 echo '<br> City  : '.$city;
		 echo '<br> Month : '.$longMonthRate;
		 echo '<br> Image : '.$base_url.'uploads/img/002-'.$primaryPhoto;
		 echo '<br> Sqr   : '.$sqArea;
		 echo '<br> Title : '.$title;
		 echo '<hr>';
		 $c++;
		 
	}
}
?>