<?php
require_once('send_email.php');
function generate_OTP(){
    session_start();
    $otp = '';
    for ($i = 0; $i < 6; $i++) {
        $otp .= mt_rand(0, 9);
    }
    if(empty($_SESSION['OTP'])){
        $_SESSION['OTP'] = $otp;
        echo $otp;
        return $otp;
    }
}


function check_user($email){
    $_SESSION["OTP"] = generate_OTP();
    echo $_SESSION["OTP"];
    send_email($email , $_SESSION['OTP']);
}

function Open_OTP_page(){
    header('Location: eterotp.php');
}
function validate_otp($input){
    if($_SESSION['OTP'] === $input){
        echo "valid";
        unset($_SESSION['OTP']);
        session_destroy();
    }
}

?>