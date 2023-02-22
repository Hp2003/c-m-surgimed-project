<?php
$url = $_SERVER['REQUEST_URI'];
$request = str_replace("route.php" , '' , $url );

// echo "$request <br>";

if($request == '/'){
    echo "home page";
}else if($request == '/reg'){

    include 'handlers/reg_handler.php';

    reg_handler();

}else if($request == '/login'){

    include 'handlers/loginuser.php';

    Login_user_handler();


}
else if($request == '/enterotp'){
    
    require_once 'handlers/otp_handler.php';

    Otp_handler();
}

else if($request == '/test'){
    
    require_once 'test.php';

    // Otp_handler();
}
else if($request == '/complete_profile'){
    
    require_once 'handlers/Complete_profile_handler.php';

    complete_profile_handler();
}

else{
    echo "some wrong route";
}
?>