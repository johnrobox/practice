<?php

class fdci_web_crawler { 
       public function exeCurl($source_url){
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $source_url);
          curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT x.y; Win64; x64; rv:10.0.1) Gecko/20100101 Firefox/10.0.1');
          curl_setopt($ch, CURLOPT_REFERER, '');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $curlResults= curl_exec($ch);
          curl_close($ch);
          return $curlResults;
        }

        function dom($inputUrl){
            $dom = new DOMDocument();
            @$dom->loadHTML($inputUrl);
            $xpath = new DOMXPath($dom);
            return $xpath;
        }
        function insertData($reference_no,$original_site,$site_link_id,$original_post_link,$title,$description,$price,$product_image,$furnishing,$location,$posted_date,$square_area,$bedrooms,$bathrooms,$floor,$name_of_posted_person,$contact_mobile,$contact_email,$contact_landline,$created,$modified,$status){

            

        }
}
?>