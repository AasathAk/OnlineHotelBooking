<?php 
  

require('admin/inc/essentials.php');
require('admin/inc/db_config.php');
date_default_timezone_set("Asia/Colombo");
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] === true)) {
    redirect('index.php');
}

    if(isset($_POST['pay_now'])){
        $name       =   $_POST['name'];
        $phonenum   =   $_POST['phonenum'];
        $address    =   $_POST['address'];
        $checkin    =   $_POST['checkin'];
        $checkout   =   $_POST['checkout'];

        $order_id           =   'ORD_' . $_SESSION['uId'] . random_int(11111, 9999999);

        // echo $checkin;
        // echo $checkout;
        // echo $order_id;
    
        // // Generate a unique order_id


    
        $_SESSION['pay_here'] = [
            "name"      =>  $name,
            "phonenum"  =>  $phonenum,
            "address"   =>  $address,
            "checkin"   =>  $checkin,
            "checkout"  =>  $checkout,
            "order_id"  =>  $order_id,
        ];

        // echo '<br>';

        // echo $_SESSION['pay_here']['checkin'];
        // echo '<br>';

        // echo $_SESSION['pay_here']['checkout'];
        // echo '<br>';

        // echo $_SESSION['pay_here']['order_id'];
    
    
    }


?>
<!DOCTYPE html>
<html lang="en">

<head></head>



<body>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script>
    function paymentGateway() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4) {
                var t = xhttp.responseText;
                console.log(t);
                var obj = JSON.parse(t);
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {

                    window.location.href = "data_save.php";

                    // alert("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                };
                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    alert("Payment dismissed");
                    window.location.href = "confirm_booking.php";
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": false,
                    "merchant_id": "1224511", // Replace your Merchant ID
                    "return_url": " http://localhost/testpayment/", // Important
                    "cancel_url": "http://localhost/testpayment/", // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["order_id"],
                    "items": obj["item"],
                    "amount": obj['amount'],
                    "currency": obj["currency"],
                    "hash": obj["hash"],
                    "first_name": "Door bell wireles", // This details has encrypt
                    "last_name": "Door bell wireles", // This details has encrypt
                    "email": "Door bell wireles", // This details has encrypt
                    "phone": "Door bell wireles", // This details has encrypt
                    "address": "Door bell wireles", // This details has encrypt
                    "city": "Door bell wireles", // This details has encrypt
                    "country": "Door bell wireles", //

                }
                payhere.startPayment(payment);
            }
        }
        xhttp.open("GET", "payhereprocess.php", true);
        xhttp.send();
    }

    paymentGateway();
    </script>
</body>

</html>