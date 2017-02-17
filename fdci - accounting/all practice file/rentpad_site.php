<?php
// for rentpad;
include 'lib.php';
class rentpad extends fdci_web_crawler {
    
    function getData(){     
            // Create connection

        $originalUrl = "http://www.locanto.ph/geo/539918/Houses-for-Rent/307/Cebu-City/?sort=dist&dist=&post_type=1&page=";
        $page = 0;
        $allItem = 1;
        $reference_no = '';
        $original_site ='';
        $site_link_id = '';
        $original_post_link = '';
        $title = '';
        $description = '';
        $price = '';
        $product_image = '';
        $furnishing = '';
        $location = '';
        $posted_date = '';
        $square_area    = '';
        $bedrooms   =   '';
        $bathrooms  =   '';
        $floor  =   '';
        $name_of_posted_person  =   '';
        $contact_mobile =   '';
        $contact_email = '';
        $contact_landline = '';
        $created = '';
        $modified = '';
        $status = '';


$searchUrl = 'http://rentpad.com.ph/ws/search.htm?a=31&cityName=Cebu&propertyTypeIDs=[]&furnishTypeIDs=[3]&placeIDs=[]&statusTypeIDs=[]&amenityIDs=[]&longMonthRateLow=0&longMonthRateHigh=999999&numBedroomsLow=0&numBedroomsHigh=999&itemsPerPage=15&lengthOfStay=&ham=ham&pageNumber=';

$c = 1;
for($b=1;$b<=16;$b++){
    $base_url = 'http://rentpad.com.ph:80/';
    $json = parent::exeCurl($searchUrl.$b);

    $data = (json_decode($json, true));

    for($a=0;$a<15;$a++){

         $urlTitle = $data['model']['searchResult']['listings'][$a]['urlTitle'];
         $id = $data['model']['searchResult']['listings'][$a]['id'];
         $address = $data['model']['searchResult']['listings'][$a]['address'];
         $city = $data['model']['searchResult']['listings'][$a]['city'];

         $longTerm = $data['model']['searchResult']['listings'][$a]['leaseLongTerm'];
         $shortTerm = $data['model']['searchResult']['listings'][$a]['leaseShortTerm'];

         $Communitydescription = $data['model']['searchResult']['listings'][$a]['community']['description'];
         $longMonthRate     =   $data['model']['searchResult']['listings'][$a]['longMonthRate'];
         $primaryPhoto  =   $data['model']['searchResult']['listings'][$a]['primaryPhoto']['filename'];
         $sqArea    =   $data['model']['searchResult']['listings'][$a]['sqArea'];
         $title =   $data['model']['searchResult']['listings'][$a]['title'];

         if($longTerm==1){
            $termUrl = 'long-term-rentals';

                        $siteUrl = 'http://rentpad.com.ph/'.$termUrl.'/cebu/'.$urlTitle.'/'.$id;
                        $variable =  parent::exeCurl($siteUrl);
                		$xpath = parent::dom($variable);

                        //get images
                          $images = array();
                          foreach ($xpath->query('//div[@id="content-photo"]//img[starts-with(@data-src,"http")]') as $image) {
                           $images[] = $image->getAttribute('data-src');
                          }
                          $allImages = '';
                          $cImage = count($images);
                          for($i=0;$i<$cImage;$i++){
                          	   $allImages = $allImages.' '.$images[$i];
                          }

                          $image  = preg_split("/[\s,]+/",$allImages);
                                $jsonImage = json_encode($image);


                         
                        

         }if($shortTerm==1){
            $termUrl = 'short-term-rentals';
            $siteUrl = 'http://rentpad.com.ph/'.$termUrl.'/cebu/'.$urlTitle.'/'.$id;
            echo ' url title : http://rentpad.com.ph/'.$termUrl.'/cebu/'.$urlTitle.'/'.$id;
         }



         /*echo $c.' url title : http://rentpad.com.ph/'.$termUrl.'/cebu/'.$urlTitle.'/'.$id;
         echo '<br> Id : '.$id;*/
         echo '<br> Descr : '.$Communitydescription; 
         echo '<br> SiteUrl '.$siteUrl; 
         echo '<br> Adrss : '.$address;
         echo '<br> City  : '.$city;
         echo '<br> Month : '.$longMonthRate;
         echo '<br> Image : '.$base_url.'uploads/img/002-'.$primaryPhoto;
         echo '<br> Sqr   : '.$sqArea;
         echo '<br> Title : '.$title;
         echo '<br> Image : '.$jsonImage;
         echo '<hr>';
         $c++;
         die();
    }
}

                                    $numberOfItem++;
                                    $allItem++;
                
         

    }//end of url function 
}// end of class


$b = new rentpad();

echo $b->getData();
?>