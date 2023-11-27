<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea breaze Hotel - Facilities</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        .pop:hover{
               border-top-color:var(--teal) !important; 
               transform: scale(1.03);
               transition: all 0.3s;
        }
        .box:hover{
                border-top-color:var(--teal) !important; 
               transform: scale(1.03);
               transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">

    <?php
    require 'inc/header.php';
    ?>


    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
            <p class="text-center mt-3">
            <?php echo $setting_r['site_about'] ?>

            </p>
        </div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-5  order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">User-Friendly Platform</h3>                    
                    <p>Our user-friendly website and mobile app make booking a hotel room quick and hassle-free. Search for accommodations, compare prices, and read reviews with ease, ensuring that you make an informed decision.
                    </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4  order-lg-2 order-md-2 order-1">
                <img src="images/about/1.jpg" class="w-100">
            </div>
      
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/hotel.svg" width="70px">
                    <h4 class="mt-3">100+ ROOMS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/customers.svg" width="70px">
                    <h4 class="mt-3">200+ CUSTOMERS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/rating.svg" width="70px">
                    <h4 class="mt-3">150+ REVIEWS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/staff.svg" width="70px">
                    <h4 class="mt-3">100+ STAFF

                    </h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    require('inc/footer.php');
    ?>



</body>

</html>