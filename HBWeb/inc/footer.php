<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3><?php echo $setting_r['site_title'] ?></h3>
            <p>
                <?php echo $setting_r['site_about'] ?>
            </p>

        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none ">Home</a><br>
            <a href="room.php" class="d-inline-block mb-2 text-dark text-decoration-none ">Rooms</a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none ">Facilities</a><br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none ">Contact us</a><br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none ">About</a>

        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow us</h5>
            <a href="<?php echo $contact_r['tw']; ?>" class="d-inline-block mb-3  text-dark text-decoration-none mb-2">
                <i class="bi bi-twitter me-1"></i>Twitter</a>
            <br>
            <a href="<?php echo $contact_r['fb']; ?>" class="d-inline-block mb-3  text-dark text-decoration-none ">
                <i class="bi bi-facebook me-1"></i>Facebook</a>
            <br>

        </div>

    </div>
</div>

<h6 class="text-center bg-dark p-2 text-white">&copy Designed and Developed by Aasath Ak SLIATE </h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }
    setActive();

   function alert(type, msg) {
        const bsClass = (type === 'success') ? 'success' : 'danger';
        const timestamp = new Date().getTime();
        const element = document.createElement('div');
        element.innerHTML = `
        <div class="alert alert-${bsClass} alert-dismissible fade show custom-alert" id="custom-alert-${timestamp}" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
        document.body.appendChild(element);
        setTimeout(() => element.remove(), 4000);
    }


    // let register_form = document.getElementById('register_form');

    // register_form.addEventListener('submit', (e) => {
    //     e.preventDefault(); // Prevent the form from submitting

    //     let data = new FormData(register_form);
    //     data.append('name', register_form.elements['name'].value);
    //     data.append('email', register_form.elements['email'].value);
    //     data.append('phonenum', register_form.elements['phone'].value);
    //     data.append('address', register_form.elements['address'].value);
    //     data.append('pin', register_form.elements['pin'].value);
    //     data.append('dob', register_form.elements['dob'].value);
    //     data.append('pass', register_form.elements['pass'].value);
    //     data.append('cpass', register_form.elements['cpass'].value);
    //     data.append('profile', data.get('profile'));
    //     data.append('register', '');

    //     let xhr = new XMLHttpRequest();
    //     xhr.open("POST", "ajax/login_register.php", true);
    //     xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    //     // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    //     xhr.onload = function() {

    // var myModal = document.getElementById('register_Modal');
    // var modal = new bootstrap.Modal(myModal);
    // modal.hide();


    //         if (this.responseText == 'pass_mismatch') {
    //             alert('danger', "Password Mismatch");
    //         } else if (this.responseText == 'email_already') {
    //             alert('danger', "Email is already registered!");
    //         } else if (this.responseText == 'phone_already') {
    //             alert('danger', "Phone number is already registered!");
    //         } else if (this.responseText == 'inv_img') {
    //             alert('danger', "Only JPG, WEB & PNG images are allowed!");
    //         } else if (this.responseText == 'upd_failed') {
    //             alert('danger', "Image upload failed!");
    //         } else if (this.responseText == 'mail_failed') {
    //             alert('danger', "Cannot send confirmation email! Server Down");
    //         } else if (this.responseText == 'ins_failed') {
    //             alert('danger', "Registration Failed! Server Down");
    //         } 
    //         else {
    //             alert('success', "Registration successful. Confirmation link sent to email!");
    //             register_form.reset();
    //         }


    //         // else {
    //         //     alert('danger', "An unexpected error occurred.");
    //         // }
    //     }

    //     xhr.send(data);
// });


 document.addEventListener('DOMContentLoaded', function() {
        let register_form = document.getElementById('register_form');

        register_form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting

            let data = new FormData(register_form);

            data.append('gname', register_form.elements['name'].value);
            data.append('gemail', register_form.elements['email'].value);
            data.append('gphonenum', register_form.elements['phone'].value);
            data.append('gaddress', register_form.elements['address'].value);
            data.append('gpin', register_form.elements['pin'].value);
            data.append('gdob', register_form.elements['dob'].value);
            data.append('gpass', register_form.elements['pass'].value);
            data.append('gcpass', register_form.elements['cpass'].value);
            data.append('gprofile', data.get('profile'));
            data.append('register', '');

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/login_register.php', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            var myModal = document.getElementById('registerModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();


            xhr.onload = function() {
                if (xhr.status === 200) {

                    switch (this.responseText.trim()) {
                        case 'pass_mismatch':
                            alert('danger', 'Password Mismatch');
                            break;
                        case 'email_already':
                            alert('danger', 'Email is already registered!');
                            break;
                        case 'phone_already':
                            alert('danger', 'Phone number is already registered!');
                            break;
                        case 'inv_img':
                            alert('danger', 'Only JPG, WEB & PNG images are allowed!');
                            break;
                        case 'upd_failed':
                            alert('danger', 'Image upload failed!');
                            break;
                        case 'mail_failed':
                            alert('danger', 'Cannot send confirmation email! Server Down');
                            break;
                        case 'ins_failed':
                            alert('danger', 'Registration Failed! Server Down');
                            break;
                        default:
                            alert('success', 'Registration successful. Confirmation link sent to email!');
                            register_form.reset();

                    }
                } else {
                    alert('danger', 'An unexpected error occurred.');



                }
            };

            xhr.send(data);
        });
    });


    let login_form = document.getElementById('login-form');
    login_form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting

        let data = new FormData(login_form);

        data.append('email_mob', login_form.elements['email_mob'].value);
        data.append('pass', login_form.elements['pass'].value);
        data.append('login', '');

        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/login_register.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {

                switch (this.responseText.trim()) {
                    case 'inv_email_mob':
                        alert('danger', 'Invalid Email or Mobil Number');
                        break;
                    case 'not_verified':
                        alert('danger', 'Email is not verified!');
                        break;
                    case 'inactive':
                        alert('danger', 'Accound Suspended! Please contact Admin');
                        break;
                    case 'invalid_pass':
                        alert('danger', 'Incorrect Password!');
                        break;
                    default:
                        let fileurl = window.location.href.split('/').pop().split('?').shift()
                        if(fileurl =='room_details.php'){
                            window.location = window.location.href;
                        }
                        else{
                            window.location = window.location.pathname;

                        }
                        
                        
                    }
            } else {
                alert('danger', 'An unexpected error occurred.');



            }
        };

        xhr.send(data);
    });



    let forgot_form = document.getElementById('forgot-form');
    forgot_form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting

        let data = new FormData(forgot_form);
        data.append('email', forgot_form.elements['email'].value);
        data.append('forgot_pass', '');

        var myModal = document.getElementById('forgotModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/login_register.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {

                switch (this.responseText.trim()) {
                    case 'inv_email':
                        alert('danger', 'Invalid Email');
                        break;
                    case 'not_verified':
                        alert('danger', 'Email is not verified!');
                        break;
                    case 'inactive':
                        alert('danger', 'Accound Suspended! Please contact Admin');
                        break;
                    case 'mail_failed':
                        alert('danger', 'Cannot send email. Server Down');
                        break;
                    case 'upd_failed':
                        alert('danger', 'Account recovery failed!');
                        break;
                    default:
                        alert('success', 'Reset link sent to email!');
                        forgot_form.reset();

                }
            } else {
                alert('danger', 'An unexpected error occurred.');



            }
        };

        xhr.send(data);
    });

    function checkLoginToBook(status, room_id) {
        if (status) {
            window.location.href = 'confirm_booking.php?id=' + room_id;
        } else {
            alert('error', 'Please login to book room!');
        }
    }
</script>

