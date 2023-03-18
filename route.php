<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

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
else if($request == '/error'){

    include("views/Error_404.php");

}
else if($request == '/test'){

    include("test.php");

}

else{

    include("views/Error_404.php");
}
?>