<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    function profile_handler(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(isset($_SESSION['loggedIn'])){
                if($_SESSION['loggedIn'] == TRUE){

                    include "./views/profile_ui.php";
                }
            }else{
                // echo "in";
                header('Location: /error');
            }
        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require_once('./src/update_user.php');

            update_user();
        }
    }
    // getting values for page

?>