<?php
require_once('AltoRouter/AltoRouter.php');

$router = new AltoRouter();

// Add Routes here
$router->map('GET|POST', '/reg', function () {
    
    require 'reg.php';
});

$router->map('GET|POST', '/enterotp', function () {

    require 'enterotp.php';

});

$router->map('GET|POST', '/enterotp.php', function () {
include('Register_user.php');
    session_start();
    $otp = $_POST['otp'];

    if((int)$_SESSION['OTP'] == (int)$otp){

        call_user_func_array("Insert_user", $_SESSION['userdata']);
        unset($_SESSION['OTP']);

    }else{
        echo "invalid";
    }

});

$match = $router->match();

// Functon which call route
if($match){
    call_user_func_array($match['target'], $match['params']);
}else{
    echo "some wrong route";
}

?>