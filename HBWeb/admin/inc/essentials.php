<?php

 //frontend purpose data

define('SITE_URL', 'http://localhost/hbweb/');
define('CAROUSEL_IMG_PATH', SITE_URL . 'images/carousel/');
define('FACILITIES_IMG_PATH', SITE_URL . 'images/facilities/');
define('ROOMS_IMG_PATH', SITE_URL . 'images/rooms/');
define('USERS_IMG_PATH', SITE_URL . 'images/users/');

//Backend purpose data

define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/HBWeb/images/');
define('CAROUSEL_FOLDER', 'carousel/');
define('FACILITIES_FOLDER', 'facilities/');
define('ROOMS_FOLDER', 'rooms/');
define('USERS_FOLDER', 'users/');


function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        redirect('index.php');
    }
}


function redirect($url)
{
    echo "<script>
          window.location.href='$url';
        </script>";
}


function alert($type, $msg)
 {
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    $timestamp = time(); // Generate a unique timestamp
    echo '<div id="myAlert' . $timestamp . '" class="alert ' . $bs_class . ' alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">' . $msg . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    echo '<script>
            setTimeout(function() {
              document.getElementById("myAlert' . $timestamp . '").style.display = "none";
            }, 4000);
          </script>';
}

// function alert($type,$msg){    
//     $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
//     $timestamp = time(); // Generate a unique timestamp
//     echo <<<alert
//       <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
//         <strong class="me-3">$msg</strong>
//         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//       </div>
//     alert;
//   }



function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $valid_ext = ['jpg', 'jpeg', 'png', 'webp'];

    $img_mime = $image['type'];
    $img_ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (!in_array($img_mime, $valid_mime) || !in_array($img_ext, $valid_ext)) {
        return 'inv_img'; // Invalid image type or extension
    } elseif (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size'; // Image size exceeds 2MB
    } else {
        $rname = 'IMG_' . random_int(11111, 99999) . ".$img_ext";
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        // Attempt to move the uploaded image to the specified path
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname; // Image uploaded successfully
        } else {
            return 'upd_failed'; // Failed to upload the image
        }
    }
}

function deleteImage($image,$folder){
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
     return true;
    }
    else{
     return false;
    }
}

function uploadSVGImage($image, $folder)
 {
     $valid_mime = ['image/svg+xml'];
 
     $img_mime = $image['type'];
 
     if (!in_array($img_mime, $valid_mime)) {
         return 'inv_img'; // Invalid image type or extension
     } elseif (($image['size'] / (1024 * 1024)) > 1) {
         return 'inv_size'; // Image size exceeds 1MB
     } else {
         $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
         $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";
         $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
 
         // Attempt to move the uploaded image to the specified path
         if (move_uploaded_file($image['tmp_name'], $img_path)) {
             return $rname; // Image uploaded successfully
         } else {
             return 'upd_failed'; // Failed to upload the image
         }
     }
}


 function uploadUserImage($image){
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $valid_ext = ['jpg', 'jpeg', 'png', 'webp'];

    $img_mime = $image['type'];
    $img_ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (!in_array($img_mime, $valid_mime) || !in_array($img_ext, $valid_ext)) {
        return 'inv_img'; // Invalid image type or extension
     }

     else 
     {
        $rname = 'IMG_' . random_int(11111, 99999) . ".$img_ext";
        $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;

        // Attempt to move the uploaded image to the specified path
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname; // Image uploaded successfully
        } else {
            return 'upd_failed'; // Failed to upload the image
        }
    }
 }
 



