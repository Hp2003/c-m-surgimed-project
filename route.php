<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

else if($request == '/cart'){
    
    require_once('handlers/cart_handler.php');

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
    if ($_SERVER['REQUEST_URI'] ===  '/api/search_by_category') {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            require_once('src/search_by_category.php');
            search_by_category();
        }
    }
    elseif (strpos($_SERVER['REQUEST_URI'], '/api/logout') === 0) {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            require_once('src/logout.php');
            
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/remove_product') === 0) {
        if($_SESSION['IsAdmin'] == true){
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('src/deleteProduct.php');
                delete_product();
            }
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/get_categorys') === 0) {
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('handlers/homepage_handler.php');
                header('Content-Type: application/json');
                $res = array(
                    'cats' => get_categorys_with_id()
                );
                echo json_encode($res);
                return 0;
        }
    }
    if ($_SERVER['REQUEST_URI'] === '/api/search_product') {
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('handlers/search_product_handler.php');
                // header('Content-Type: application/json');
                search();
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/get_details_page') === 0) {
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('src/give_details.php');
                show_details_page();
                
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/show_review') === 0) {
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('src/show_review.php');
                show_review();
                
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/place_order') === 0) {
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('src/place_order.php');
                place_order();
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/order_page') === 0) {
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('src/show_orders.php');
                show_orders();
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/add_to_cart') === 0) {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            require_once('src/manage_cart.php');
            add_product_to_cart();
        }
    }
    if ($_SERVER['REQUEST_URI'] === '/api/edit_product' ) {
        if($_SESSION['IsAdmin'] == true){
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('src/display_edit_pro.php');
                get_edit_pro();
            }
        }else{
            header('Content-Type: application/json');
            $resData = array(
                'text' => "notAllowed"
            );
            echo json_encode($resData);
            return;
        }

    }
    if ($_SERVER['REQUEST_URI'] === '/api/edit_product_data') {

        if($_SESSION['IsAdmin'] == true){
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('src/edit_product_data.php');
                edit_pro_data();
            }
        }else{
            header('Content-Type: application/json');
            $resData = array(
                'text' => "notAllowed"
            );
            echo json_encode($resData);
            return;
        }

    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/edit_category') === 0) {
        
        if($_SESSION['IsAdmin'] == true){
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('handlers/category_handler.php');
                get_category_table();
            }
        }else{
            header('Content-Type: application/json');
            $resData = array(
                'text' => "notAllowed"
            );
            echo json_encode($resData);
            return;
        }

    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/get_all_orders') === 0) {
        
        if($_SESSION['IsAdmin'] == true){
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('src/admin_list_all_order.php');
                display_all_orders();
            }
        }else{
            header('Content-Type: application/json');
            $resData = array(
                'text' => "notAllowed"
            );
            echo json_encode($resData);
            return;
        }

    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/Edit_products_category') === 0) {

        if($_SESSION['IsAdmin'] == true){
           
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                require_once('handlers/category_product_handler.php');
                category_product_handler();
            }
        }else{
            header('Content-Type: application/json');
            $resData = array(
                'text' => "notAllowed"
            );
            echo json_encode($resData);
            return;
        }

    }
    if ($_SERVER['REQUEST_URI'] ===  '/api/list_all_user') {
        if(isset($_SESSION['IsAdmin'])){
            if($_SESSION['IsAdmin'] == true){
           
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    require_once('src/display_all_user.php');
                    display_all_user();
                }
            }else{
                header('Content-Type: application/json');
                $resData = array(
                    'text' => "notAllowed"
                );
                echo json_encode($resData);
                return;
            }
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], '/api/add_product') === 0) {
        if($_SESSION['IsAdmin'] == true){
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                if($_POST['type'] === 'GetPage' ){
                    require_once('src/display_add_product.php');
                    get_add_pro();
                }elseif($_POST['type'] === 'AddProduct' ){
                    require_once('src/add_product.php');
                    
                    add_product();
                }
            }
        }else{
            header('Content-Type: application/json');
            $resData = array(
                'text' => "notAllowed"
            );
            echo json_encode($resData);
            return;
        }
    }
    // if (strpos($_SERVER['REQUEST_URI'], '/api/getHomePageData') === 0) {
    //     if($_SERVER['REQUEST_METHOD'] === "POST"){
    //             require_once('src/home_page_data.php');
    //             get_home_page_ui_data();
    //     }
    // }
    // if (strpos($_SERVER['REQUEST_URI'], '/api/email') === 0) {
    //     if($_SERVER['REQUEST_METHOD'] === "POST"){
    //         require_once('src/get_user_img.php');
    //         get_user_image();
    //     }
    // }
}

else{

    include("views/Error_404.php");
}
?>