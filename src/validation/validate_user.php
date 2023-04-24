<?php
require_once('./src/send_email.php');
require_once('./src/connection.php');
function generate_OTP(){
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    $otp = '';
    for ($i = 0; $i < 6; $i++) {
        $otp .= mt_rand(0, 9);
    }
    if(empty($_SESSION['OTP'])){
        return $otp;
    }
}

// checking if user available or not
function Find_user($email){

    $con = connect_to_db();
    
    $query = "SELECT * FROM Users where Email = '$email' LIMIT 1;";

    mysqli_query($con , $query);

    
    if(mysqli_affected_rows($con) >= 1){
        mysqli_close($con);

        header("Content-Type: application/json");
        $responseData = array(
        'text' => 'userAlreadyAvailable'
        );
        echo json_encode($responseData);
        return;

        // header("Location: /reg");
    }else{
        mysqli_close($con);
        Validate_user($email);
    }
}
function Validate_user($email){

    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $_SESSION['OTP'] = generate_OTP();
    // Variable to check spam
    if(send_email($email , $_SESSION['OTP'])){
        header("Content-Type: application/json");
        $_SESSION['total_submit_otp'] = 0;
        $_SESSION['User_Email'] = $email;
        $responseData = array(
        'url' => '/enterotp'
        );
        echo json_encode($responseData);
        return ;
    }else{
        header('Content-Type: application/json');
        $responseData = array(
            'text' => 'emailNotSent'
        );
        echo json_encode($responseData);
        return;
    }

    exit;
}
?>