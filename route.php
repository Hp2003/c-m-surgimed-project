<?php
require_once('lib/AltoRouter/AltoRouter.php');

$router = new AltoRouter();

// Add Routes here
$router->map('GET|POST', '/reg', function () {
    
    require('handlers/reg_handler.php');

    reg_handler();
});

$router->map('GET|POST', '/enterotp', function () {

    include('handlers/otp_handler.php');
    
    Otp_handler();

});

$router->map('GET|POST', '/login', function () {
    include('handlers/loginuser.php');

    Login_user_handler();

});


$match = $router->match();

// Functon which call route
if($match){
    call_user_func_array($match['target'], $match['params']);
}else{
    echo "some wrong route";
}

?>