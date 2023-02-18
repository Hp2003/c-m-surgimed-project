<?php 
function Otp_handler(){
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        session_start();
        if(!isset($_SESSION['OTP'])){
            die("Not allowed!");
        }else{
            include "./views/enterotp.php";
        }
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        require_once('./src/Register_user.php');
    
        session_start();
        $otp = $_POST['otp'];
        if((int)$_SESSION['OTP'] === (int)$otp){
    
            call_user_func_array("Insert_user", $_SESSION['userdata']);
            
            unset($_SESSION['OTP']);
        }else{
            echo "wrong";
        }
    
    }
}

?>