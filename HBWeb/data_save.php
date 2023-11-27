<?php
require('admin/inc/essentials.php');
require('admin/inc/db_config.php');
date_default_timezone_set("Asia/Colombo");
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] === true)) {
    redirect('index.php');
}

$id = $_SESSION['uId'];
$room_id = $_SESSION['room']['id'];
$checkin = $_SESSION['pay_here']['checkin'];
$checkout = $_SESSION['pay_here']['checkout'];
$order_id1 = $_SESSION['pay_here']['order_id'];
$room_name = $_SESSION['room']['name'];
$price = $_SESSION['room']['price'];
$total_pay = $_SESSION['room']['payment'];
$user_name = $_SESSION['pay_here']['name'];
$phonenum = $_SESSION['pay_here']['phonenum'];
$address = $_SESSION['pay_here']['address'];

// echo "$id <br> $room_id <br> $checkin <br> $checkout <br> $order_id1 <br> $room_name <br> $price <br> $total_pay <br>";

$sql = "INSERT INTO `booking_order` (`user_id`, `room_id`, `check_in`, `check_out`, `booking_status`, `order_id`, `trans_amt`, `trans_status`) 
VALUES ('$id', '$room_id', '$checkin', '$checkout', 'booked', '$order_id1', '$total_pay', 'success')";

if (mysqli_query($con, $sql)) {
    $booking_id = mysqli_insert_id($con);
    echo  $booking_id;
    $sql2 = "INSERT INTO booking_details (`booking_id`, `room_name`, `price`,`total_pay`, `user_name`, `phonenum`,`address`)
    VALUES ('$booking_id', '$room_name', '$price', '$total_pay', '$user_name', '$phonenum', '$address')";

    if (mysqli_query($con, $sql2)) {
        header('Location: pay_status.php');
    } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($con);
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
?>