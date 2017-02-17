<?php

$quote = file_get_contents('http://finance.google.com/finance/info?client=ig&q=VSE:APG1L');
$json = substr($quote, 4, -5);
$json_output = json_decode($json, true, JSON_UNESCAPED_UNICODE);
print_r($json_output);

?>