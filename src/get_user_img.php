<?php 
       if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    function get_user_image(){
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['loggedIn'] == True){

                $imageData = file_get_contents("./{$_SESSION['ProfileImgPath']}");
                if($_SESSION['ProfileImgPath'] == "img/defaultIMG/Default_male.jpg" || $_SESSION['ProfileImgPath'] == "img/defaultIMG/Default_female.jpg" ){
                    $_SESSION['IsDefault'] = True;
                }else{
                    $_SESSION['IsDefault'] = False;
                    $_SESSION['ImageName'] = $_SESSION['ProfileImgPath'];
                }
                unset($_SESSION['ProfileImgPath']);
                header('Content-Type: image/*');
                echo $imageData;
                return;
            }
        }else{
            return array('error' => "soory we can't find data");
        }

    }

?>