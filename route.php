<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

$url = $_SERVER['REQUEST_URI'];
$request = str_replace("route.php" , '' , $url );

// echo "$request <br>";

if($request == '/' || $request == '/home'){

    include ('handlers/homepage_handler.php');

    home_handler();

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
else if($request == '/profile'){
    require_once('handlers/profile_handler.php');

    profile_handler();
}
else if($request == '/error'){

    include("views/Error_404.php");

}else if (strpos($_SERVER['REQUEST_URI'], '/api') === 0) {
    // handle API requests
    if (strpos($_SERVER['REQUEST_URI'], '/api/userdata') === 0) {
        // handle /api/userdata request
        require_once 'src/get_user_data.php';
        $user_data = get_user_data();

        // getting image
        $imgData = file_get_contents($user_data['ProfilePicture']);

        $encodedImageData = base64_encode($imgData);

        header('Content-Type: application/json');
        $responseData = array(
            'image' => $encodedImageData,
            'userData' => $user_data
        );
        echo json_encode($responseData);
        return;
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/image') === 0) {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            require_once('src/get_user_img.php');
            get_user_image();
        }
    }
    
}

else{

    include("views/Error_404.php");
}
?>