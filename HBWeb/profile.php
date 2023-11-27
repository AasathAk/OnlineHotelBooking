<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea Breeze Hotel - Booking</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body class="bg-light">
    <?php
    require 'inc/header.php';
    if (!(isset($_SESSION['login']) && $_SESSION['login'] === true)) {
        redirect('index.php');
    }
    $u_exist = select("SELECT * FROM `user_cred` WHERE `id` = ? LIMIT 1", [$_SESSION['uId']], 's');
    if (mysqli_num_rows($u_exist) == 0) {
        redirect('index.php');
    }
    $u_fetch = mysqli_fetch_assoc($u_exist);
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 mb-5 px-4">
                <h2 class="fw-bold">PROFILE</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary">></span>
                    <a href="profile.php" class="text-secondary text-decoration-none">PROFILE</a>
                </div>
            </div>

            <div class="col-12 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id='info_form'>
                        <h5 class="mb-3 fw-bold">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control shadow-none" value="<?php echo $u_fetch['name']; ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input name="phone" type="number" class="form-control shadow-none" value="<?php echo $u_fetch['phonenum']; ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input name="dob" type="date" class="form-control shadow-none" value="<?php echo $u_fetch['dob']; ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pin code</label>
                                <input name="pin" type="number" class="form-control shadow-none" value="<?php echo $u_fetch['pincode']; ?>" required>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $u_fetch['address']; ?></textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <button type="submit" class="btn btn-md custom-bg shadow-none ">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id='profile_form'>
                        <h5 class="mb-3 fw-bold">Picture</h5>
                        <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile'];?>" alt="user_image" class=" img-fluid rounded-circle mb-4">
                        <label class="form-label fw-bold mb-2  ">New Profile Image</label>
                        <input type="file" name="profile" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none mb-4  " required>
                        <button type="submit" class="btn btn-md custom-bg shadow-none  ">Change Profile Pic</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id='pass_form'>
                        <h5 class="mb-3 fw-bold">Change Password</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_pass" class="form-control shadow-none " required>
                            </div>
                            <div class="col-md-6 mb-4">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_pass" class="form-control shadow-none " required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md custom-bg shadow-none  ">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('inc/footer.php');
    ?>

    <script>
        let info_form = document.getElementById('info_form');
        info_form.addEventListener('submit', function(e) {
            e.preventDefault();


            let data = new FormData();
           
            data.append('name', info_form.elements['name'].value);
            data.append('phonenum', info_form.elements['phone'].value);
            data.append('address', info_form.elements['address'].value);
            data.append('pincode', info_form.elements['pin'].value);
            data.append('dob', info_form.elements['dob'].value);
            data.append('info_form', 'true');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);
            // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText === 'phone_already') {
                    alert('error','Phone number is already registered!');
                } else if (this.responseText == 0) {
                    alert('error','No changes made!');
                } else {
                    alert('success','Changes saved!');
                }
            };
            xhr.send(data);
        });

        let profile_form = document.getElementById('profile_form');
        profile_form.addEventListener('submit', function(e) {
            e.preventDefault();


            let data = new FormData();
           
            data.append('profile',profile_form.elements['profile'].files[0]);
            data.append('profile_form', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);
            // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 'inv_img')
                 {
                alert('error', "Only JPG, WEB & PNG images are allowed!");
                }
                else if (this.responseText == 'upd_failed') {
                alert('error', "Image upload failed!");
                }
                else if (this.responseText == 0) {
                    alert('error','Updatation Failed!');
                }
                 else {
                    window.location.href=window.location.pathname;
                }
            };
            xhr.send(data);
        });

        let pass_form = document.getElementById('pass_form');
        pass_form.addEventListener('submit', function(e) {
        
            let new_pass = pass_form.elements['new_pass'].value;
            let confirm_pass = pass_form.elements['confirm_pass'].value;

            if(new_pass != confirm_pass){
                alert('error','Password do not Match');
                return false;
            }

            
            let data = new FormData();
           
            data.append('new_pass',new_pass);
            data.append('confirm_pass',confirm_pass);
            data.append('pass_form', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 'mismatch')
                 {
                    alert('error','Password do not Match');
                }
                else if (this.responseText == 0) {
                    alert('error','Updatation Failed!');
                }
                 else {
                    alert('success','Changes Saved');
                }
            };
            xhr.send(data);
        });


    </script>
</body>

</html>
