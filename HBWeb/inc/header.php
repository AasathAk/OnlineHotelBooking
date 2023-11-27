<?php
// session_start();

// date_default_timezone_set("Asia/Colombo");

// require('admin/inc/db_config.php');
// require('admin/inc/essentials.php');

// $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
// $setting_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
// $values = [1];
// $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
// $setting_r = mysqli_fetch_assoc(select($setting_q,$values,'i'));

// if($setting_r['shutdown']){
//     echo<<<alertbar
//     <div class="bg-danger text-center p-2 fw-bold">
//     <i class="bi bi-exclamation-triangle-fill"></i> Booking are temporaly closed
//     </div>
//     alertbar;
// }


?>


<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top ">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $setting_r['site_title'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="room.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="about.php">About</a>
                </li>
            </ul>
            <?php
                if(isset($_SESSION['login']) && $_SESSION['login']==true){

                    $path = USERS_IMG_PATH;
                    echo<<<data
                            <div class="btn-group">
                            <button type="button" class="btn btn-outline-dark shadow-none   dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <img src="$path$_SESSION[uPic]" style="width:30px; height:30px" class="me-1 rounded-circle">
                            $_SESSION[uName]
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="bookings.php">My Bookings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                           </ul>
                        </div>
                    data;
                }

                else{
                    echo<<<data
                            <div class="d-flex">
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Login
                            </button>
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-3" data-bs-toggle="modal" data-bs-target="#registerModal">
                                Register
                            </button>
                        </div>
                    data;


                }
               
               
            ?>
            
        </div>
    </div>
</nav>

<!--Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email address / Mobile</label>
                        <input type="text" name="email_mob" class="form-control shadow-none " required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" class="form-control shadow-none " required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none ">Login</button>
                        <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0"
                         data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">
                         Forgot Password?</button>
                        
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

<!--Register Modal -->

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="register_form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> User Registration
                    </h5>
                    <button type="reset" class="btn-close shadow-none " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID(NIC, Passport, Drivng license, etc)
                        that will be requird during check-in.
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control shadow-none " required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control shadow-none " required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="phone" class="form-control shadow-none " required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Picture</label>
                                <input type="file" name="profile" class="form-control shadow-none " required>
                            </div>
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Pin Code</label>
                                <input type="number" name="pin" class="form-control shadow-none " required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Date of birth</label>
                                <input type="date" name="dob" class="form-control shadow-none " required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="pass" class="form-control shadow-none " required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="cpass" class="form-control shadow-none " required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center my-1 mb-3">
                    <button type="submit" class="btn btn-dark shadow-none ">Register</button>
                </div>

            </form>
        </div>

    </div>
</div>


<!--forgor Modal -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgot-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password
                    </h5>
                    <button type="reset" class="btn-close shadow-none " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email </label>
                        <input type="email" name="email" class="form-control shadow-none " required>
                    </div>
                    <div class="mb-2 text-end ">
                        <button type="button" class="btn shadow-none p-0 me-2 "
                         data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark shadow-none ">Send Link</button>
                        
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>