<?php
require('admin/inc/essentials.php');
require('admin/inc/db_config.php');
date_default_timezone_set("Asia/Colombo");
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] === true)) {
    redirect('index.php');
}


$merchant_id = '1224511'; // Replace with your Merchant ID
$merchant_secret = 'ODU3NDc5MzY2Mjk0NjA2MDA2Mzk2MDk5ODU2Nzk1MTExNDI0Ng==';
$payhere_amount = $_SESSION['room']['payment'];
$payhere_currency = 'LKR';
$order_id = $_SESSION['pay_here']['order_id'];


$hash = strtoupper(
    md5(
        $merchant_id .
        $order_id .
        number_format($payhere_amount, 2, '.', '') .
        $payhere_currency .
        strtoupper(md5($merchant_secret))
    )
);

$data = [
    "amount" => $payhere_amount,
    "merchant_id" => $merchant_id,
    "order_id" => $order_id,
    "currency" => $payhere_currency,
    "hash" => $hash,
    "item" => $_SESSION['room']['name'],
];

// Encode data as JSON
$jsonObj = json_encode($data);

echo $jsonObj;


?>
