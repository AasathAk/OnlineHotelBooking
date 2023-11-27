<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea breaze Hotel -Contact</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

</head>

<body class="bg-light">

    <?php
    require 'inc/header.php';
    ?>


    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Have questions or need assistance at any time?
            Our dedicated customer support team is available 24/7 to help with your
            booking inquiries and ensure a smooth travel experience.</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded " src="<?php echo $contact_r['iframe']; ?>" height="320" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r['gmap']; ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i>
                        <?php echo $contact_r['address']; ?>
                    </a>
                    <h5>Call us</h5>
                    <a href="0672222864" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-telephone-fill me-1"></i><?php echo $contact_r['pn1']; ?>
                    </a>
                    <h5 class="mt-2">Email</h5>
                    <a href="mailto: seahotel@gmail.com" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-envelope-fill"></i>
                        <?php echo $contact_r['email']; ?>
                    </a>

                    <h5 class="mt-2">Follow us</h5>

                    <?php
                    if ($contact_r['tw'] != '') {
                        echo <<<data
                            <a href="$contact_r[tw]" class="d-inline-block mb-3 text-dark fs-6 me-2">
                            <i class="bi bi-twitter me-1"></i>
                            </a>
                            data;
                    }
                    ?>


                    <a href="<?php echo $contact_r['fb']; ?>" class="d-inline-block mb-3 text-dark fs-6 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="POST">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input type="text" name="name" class="form-control shadow-none " required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" name="email" class="form-control shadow-none " required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input type="text" name="subject" class="form-control shadow-none " required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea name="message" class="form-control shadow-none" rows="5" style="resize:none" required></textarea>
                        </div>
                        <button type="submit" name="send" class="btn text-white custom-bg mt-3">Send</button>

                    </form>
                </div>
            </div>

        </div>
    </div>


    <?php

    if (isset($_POST['send'])) {
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

        $res = insert($q, $values, 'ssss');
        if ($res == 1) {
            alert('success', 'Mail sent!');
        } else {
            alert('error', 'Server Down! Try again later.');
        }
    }

    ?>

    <?php
    require('inc/footer.php');
    ?>

</body>

</html>