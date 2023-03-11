<?php 
function complete_profile_handler(){
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        
        if(isset($_SESSION['Is_account_created']) && $_SESSION['Is_account_created'] === TRUE ){
            require './views/complete_profile.php';
        }else{
            echo "Sorry not allowed!";
        }
    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(complete_profile() === 1){
            unset($_SESSION['Gender'], $_SESSION['userdata']);
            header('Location: /login');
        }else{
            echo "something went wrong";
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
    $username;
    if(isset($_POST['UserName'])){
        $username = $_POST['UserName'];
    }else{
        $username = $_POST['full_name'];
    }
    if(!($_FILES["UserImg"] && $_FILES["UserImg"]["error"] == 0)) {
        $query = "UPDATE Users SET  UserName = '$username' WHERE UserId = '{$_SESSION['id']}'" ;

        $response = $con->query($query);
        $con->close();
        return 1;
    }
    if(isset($_POST['create_profile'])){

        $img_moved ;
        if(isset($_FILES['UserImg']) && $_FILES['UserImg']['size'] > 0){
            // Checking image is on proper fomat and size and is it image
            if(validate_image() === 1){
                // moving to temp  direactory
                if(move_image("PROFILE_IMAGE")){
                    
                    $img_moved = TRUE;
                    
                }else{
                        $img_moved =  FALSE;
                    }
                }else{
                        $img_moved =  FALSE;
                    }
        }

        if($img_moved === TRUE){
            $con = connect_to_db();
            // adding id to profile picture name to make it almost impossible to have duplicate
            $new_name = $_SESSION['id'] . '_' . $_SESSION['New_Profile_picturename'];

            // Moving image from temp to User_images
            rename("./img/temp/{$_SESSION['New_Profile_picturename']}" , "./img/User_images/$new_name");

            $query = "UPDATE Users set ProfilePicture = 'img/User_images/$new_name' , UserName = '$username' WHERE UserId = '{$_SESSION['id']}'" ;

            $response = $con->query($query);
            $con->close();
            return 1;
        }
    }
    return 0;
}
    
?>