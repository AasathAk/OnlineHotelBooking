<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

date_default_timezone_set("Asia/Colombo");

if (isset($_POST['info_form'])) {
    $frm_data = filteration($_POST);
    session_start();

    // Check if the phone number is already registered for another user
    $u_exist = select("SELECT * FROM `user_cred` WHERE `phonenum`=? AND `id` != ? LIMIT 1", [$frm_data['phonenum'], $_SESSION['uId']], "si");
    if (mysqli_num_rows($u_exist) != 0) {
        echo 'phone_already';
        exit;
    }

    $query = "UPDATE `user_cred` SET `name`=?, `address`=?, `phonenum`=?, `pincode`=?, `dob`=? WHERE `id`=?";
    $values = [$frm_data['name'], $frm_data['address'], $frm_data['phonenum'], $frm_data['pincode'], $frm_data['dob'], $_SESSION['uId']];

    if (update($query, $values, 'sssisi')) {
        $_SESSION['uName'] = $frm_data['name']; // Correct the session variable name
        echo 1; // Successful update
    } else {
        echo 0; // No changes made
    }
}

if (isset($_POST['profile_form'])) {

    session_start();

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } elseif ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    $u_exist = select("SELECT `profile` FROM `user_cred` WHERE `id` = ? LIMIT 1", [$_SESSION['uId']], "i");
    $u_fetch = mysqli_fetch_assoc($u_exist);

    deleteImage($u_fetch['profile'], USERS_FOLDER); // Assuming this function is defined.

    $query = "UPDATE `user_cred` SET `profile` = ? WHERE `id` = ?";
    $values = [$img, $_SESSION['uId']]; // Assuming this is the correct format for your query and values.

    if (update($query, $values, 'si')) { // Assuming the 'update' function is defined.
        $_SESSION['uPic'] = $img;
        echo 1; // Successful update
    } else {
        echo 0; // No changes made
    }
}
if (isset($_POST['pass_form'])) {

    session_start();

    $frm_data=filteration($_POST);

    if ($frm_data['new_pass'] != $frm_data['confirm_pass']) {
        echo 'mismatch';
        exit;
    }

    $enc_pass =password_hash($frm_data['new_pass'],PASSWORD_BCRYPT);
    $query = "UPDATE `user_cred` SET `password`=? WHERE `id`=? LIMIT 1";
    $values =[$enc_pass,$_SESSION['uId']];
    if(update($query,$values,'si')){
        echo 1;
    }
    else{
        echo 0;
    }



}
?>

