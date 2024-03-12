<?php
$number = substr($_GET["cp"], 1);



$message;

$service_plan_id = "1544ab61f0634029b48df64c402e4a77";
$bearer_token = "c5ca79797cf049dd99d72d62058160ac";
$send_from = "+447520650976";
// $recipient_phone_numbers = "+639502693807";
$number = "+63" . $number;
$newnum = str_replace(".", "", $number);
$recipient_phone_numbers = $newnum;

// Check recipient_phone_numbers for multiple numbers and make it an array.
if (stristr($recipient_phone_numbers, ',')) {
    $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
} else {
    $recipient_phone_numbers = [$recipient_phone_numbers];
}
if ($_GET["type"] == "start") {
    $message = "The repair of your vehicle has started.-Transmaster ";

} else {
    $message = "The repair of your vehicle has been finished. You can come get your vehicle and pay the bills -Transmaster";
}

$content = ['to' => array_values($recipient_phone_numbers), 'from' => $send_from, 'body' => $message];

$data = json_encode($content);


$ch = curl_init("https://us.sms.api.sinch.com/xms/v1/{$service_plan_id}/batches");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
} else {

    //echo "{\"res\" : \"success\"}";
    header("Location: List_repair_transaction.php");

}
curl_close($ch);




?>