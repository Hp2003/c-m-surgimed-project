<?php 
function complete_profile_handler(){
    
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        // Checking if user just created account or not
        if(isset($_SESSION['Is_account_created']) && $_SESSION['Is_account_created'] === TRUE ){
            // print_r($_SESSION['userdata']);
            require './views/complete_profile_ui.php';
        }else{
            header("Location: /error");
        }
    }elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
        // header("Location: /home");
        if(complete_profile() === 1){
            unset($_SESSION['Is_account_created']);
            unset($_SESSION['Gender'], $_SESSION['userdata']);
            header('Content-Type: application/json');
            $responseData = array(
                'url' => '/login'
            );
            echo json_encode($responseData);
            return;
        }
    }
}

function complete_profile(){
    require_once './src/connection.php';
    require_once './src/validation/Check_Userinput.php';
    require_once './src/insertIMG.php';

    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    $address = $_POST['Address'];
    $mobileNumber = $_POST['mobile'];
    // $default = $_POST['UseDefault'];
    $username = $_POST['userName'];

    $address = str_replace(array("\r\n", "\n"), " ", $address);
    $fields = array($username, $address, $mobileNumber);
    if(!check_mobile($mobileNumber)){
        header('Content-Type: application/json');
        $responseData = array(
            'text' => 'invalidMobile'
        );
        echo json_encode($responseData);
        return;
    }
    if(trim($username) === ""){
        header('Content-Type: application/json');
        $responseData = array(
            'text' => 'invalidUserName'
        );
        echo json_encode($responseData);
        return;
    }
    if(isset($_FILES["UserImg"]) && $_FILES["UserImg"]["error"] == 0) {

        // File was uploaded successfully via AJAX
        // Checking image is on proper fomat and size and is it image
        if(validate_image() === 1){
            // moving to temp  direactory
            $img_moved = FALSE;
            if(move_image("PROFILE_IMAGE")){

                $img_moved = TRUE;
                
            }else{
                    $img_moved =  FALSE;
                }
            }else{
                    $img_moved =  FALSE;
                }
                if($img_moved === TRUE){
                    $con = connect_to_db();
                    // adding id to profile picture name to make it almost impossible to have duplicate
                    $new_name = $_SESSION['id'] . '_' . $_SESSION['New_Profile_picturename'];
        
                    // Moving image from temp to User_images
                    rename("./img/temp/{$_SESSION['New_Profile_picturename']}" , "./img/User_images/$new_name");
                    if(!isset($default)){
                        $query = "UPDATE Users set ProfilePicture = 'img/User_images/$new_name' ,  MobileNumber = '$mobileNumber' , UserAddress = '$address'  WHERE UserId = '{$_SESSION['id']}' " ;
                    }
                    
                    $response = $con->query($query);
                    $con->close();
                    return 1;
            }
            return 0;
    } else {

        $con = connect_to_db();

        $query = "UPDATE Users SET UserName = '$username' , MobileNumber = '$mobileNumber' , UserAddress = '$address' WHERE UserId = '{$_SESSION['id']}'";
        $response = $con->query($query);
        $con->close();

        return 1;
    }

}
    
?>