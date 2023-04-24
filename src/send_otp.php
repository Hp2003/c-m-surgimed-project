<?php 
require_once('validation/validate_user.php');
require_once('send_email.php');
if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}
    function send_otp(){
        $oldOtp = $_SESSION['OTP'];
        unset($_SESSION['OTP']);
        $new_otp = generate_OTP();
        if(send_email($_SESSION['User_Email'], $new_otp)){
            $_SESSION['OTP'] = $new_otp;
            $res = array(
                'text' => 'Otp sent success fully',
                'otp' => $new_otp
            );
            echo json_encode($res);
            return;
        }else{
            $res = array(
                'text' => 'failed',
                $_SESSION['OTP'] = $oldOtp
            );
            echo json_encode($res);
            return;
        }
    }
?>