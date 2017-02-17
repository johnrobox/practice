<?php
 
require "Services/Twilio.php";
echo '<pre>';
// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "AC6d545257be50f5fc93a4a6df392da94b";
$AuthToken = "e4f49c0b0810204acc458f28b9654042";
 
$client = new Services_Twilio($AccountSid, $AuthToken);
 
$message = $client->account->messages->create(array(
    "From" => "+12163507255",
    "To" => "+639239117973",
    "Body" => "This is a test message!",
));
 
// Display a confirmation message on the screen
echo "Sent message {$message->sid}";