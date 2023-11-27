<?php
require('../admin/inc/essentials.php');
require('../admin/inc/db_config.php');
require('../inc/vendor/autoload.php');

date_default_timezone_set("Asia/Colombo");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$token,$type)

{

    if($type=="email_confirmation"){
        $page ='email_confirm.php';
        $subject = "Account Verification Link";
        $content ="confirm your email";
    }
    else{
        $page ='index.php';
        $subject = "Account Reset Link";
        $content ="reset your account";
    }
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'aasathking35@gmail.com';
        $mail->Password   = 'jkaapoyjwrduixhd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('from@example.com', 'Aasath AK');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Please click the following link to $content:<br> 
                        <a href='" . SITE_URL . "$page?$type&email=$email&token=$token" . "'>
                        CLICK ME
                        </a>";

        if ($mail->send()) {
            return true;
        } else {
            return 'mail_failed';
        }
    } catch (Exception $e) {
        return 'mail_failed';
    }
}

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    if ($data['gpass'] != $data['gcpass']) {
        echo 'pass_mismatch';
        exit;
    }

    $u_exist = select(
        "SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`= ? LIMIT 1 ",
        [$data['gemail'], $data['gphonenum']],
        'ss'
    );
    

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_exist_fetch['email'] == $data['email']) {
            echo 'email_already';
        } else {
            echo 'phone_already';
        }
        exit;
    }

    // Upload user image to server
    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } elseif ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    // Send confirmation link to user's email
    $token = bin2hex(random_bytes(16));
    $sendMailResult = sendMail($data['email'], $token,"email_confirmation");
    
    if ($sendMailResult === true) {
        $enc_pass = password_hash($data['gpass'], PASSWORD_BCRYPT);
    
        $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`,
                    `dob`, `profile`, `password`,  `token`) VALUES(?,?,?,?,?,?,?,?,?)";
        $values = [
            $data['gname'], $data['gemail'], $data['gaddress'], $data['gphonenum'], $data['gpin'],
            $data['gdob'], $img, $enc_pass, $token
        ];
        
        // Check for database connection
        if (insert($query, $values, 'ssssissss')) {
            echo 1;
        } else {
            echo 'ins_failed';
        }
    }
   
    
}

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    $u_exist = select(
        "SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`= ? LIMIT 1 ",
        [$data['email_mob'], $data['email_mob']],
        'ss'
    );
    

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email_mob';
        
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0){
            echo 'not_verified';
        }
        else if($u_fetch['status']==0){
            echo 'inactive';
        }
        else{
            if(!password_verify($data['pass'],$u_fetch['password'])){
                echo 'invalid_pass';
            }
            else{
                session_start();
                $_SESSION['login']=true;
                $_SESSION['uId']=$u_fetch['id'];
                $_SESSION['uName']=$u_fetch['name'];
                $_SESSION['uPic']=$u_fetch['profile'];
                $_SESSION['uPhone']=$u_fetch['phonenum'];
                echo 1;
            }
        }
    }
    
}

if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);

    $u_exist = select(
        "SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1 ",
        [$data['email']],'s'
    );
    

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email';
        
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0){
            echo 'not_verified';
        }
        else if($u_fetch['status']==0){
            echo 'inactive';
        }
        else{
            $token = bin2hex(random_bytes(16));
            if(!sendMail($data['email'],$token,'account_recovery')){
                echo 'mail_failed';
            }
            else{
               $date = date("Y-m-d");
               $query =mysqli_query($con,"UPDATE `user_cred` SET `token`='$token',`t_expire`='$date'
               WHERE `id`='$u_fetch[id]'");

               if($query){
                echo 1;
               }
               else{
                echo 'upd_failed';
               }
            }
        }
    }
}


if (isset($_POST['recover_user'])) {
    $data = filteration($_POST);
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "UPDATE `user_cred` SET `password`=?, `token`=?, `t_expire`=?
     WHERE `email`=? AND `token`=?";

    $values = [$enc_pass, null, null, $data['email'], $data['token']];

    if (update($query, $values, 'sssss')) {
        echo 1;
    } else {
        echo 'failed';
    }
}
