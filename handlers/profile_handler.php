<?php 
    function profile_handler(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){

            include "./views/profile_ui.php";
            make_profile_page();
        }else if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }
    }
    // getting values for page
    function make_profile_page(){
        require_once "./src/connection.php";

        
    }
?>