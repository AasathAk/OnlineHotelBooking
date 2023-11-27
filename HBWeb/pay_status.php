<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea breaze Hotel - pay status</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

</head>

<body class="bg-light">

    <?php
    require 'inc/header.php';
    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">BOOKING STATUS</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class=" text-secondary text-decoration-none ">HOME</a>
                    <span class="text-secondary">></span>
                    <a href="room.php" class=" text-secondary text-decoration-none ">ROOM</a>
                    <span class="text-secondary">></span>
                    <a href="room.php" class=" text-secondary text-decoration-none ">CONFIRM</a>
                </div>
            </div>


            <?php


            if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
            { 
                redirect('index.php');
            }

            $frm_data = filteration ($_GET);

            $booking_q = "SELECT bo.*, bd.* FROM booking_order bo INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id WHERE bo.user_id = ? AND bo.booking_status = ?";
            $booking_res = select($booking_q, [$_SESSION['uId'], 'booked'],'is');
            
            if(mysqli_num_rows($booking_res)==0){
                redirect('index.php');
            }
            $booking_fetch = mysqli_fetch_assoc($booking_res);
            if ($booking_fetch['trans_status'] == "success") {
                echo <<<data
                <div class="col-12 px-4">
                    <p class="fw-bold alert alert-success"> 
                    <i class="bi bi-exclamation-triangle-fill"></i> Payment done! Booking successful.
                    <br><br>
                    <a href='bookings.php'>Go to Bookings</a>
                    </p>
                </div>
                data;
            }

            else{
                echo <<<data
                <div class="col-12 px-4">
                    <p class="fw-bold alert alert-success"> <i class="bi bi-check-circle-fill"></i> 
                   Payment failed
                    <br><br>
                    <a href='bookings.php'>Go to Bookings</a>
                    </p>
                </div>
                data;
            }

            ?>


<?php
    require('inc/footer.php');
    ?>



</body>

</html>