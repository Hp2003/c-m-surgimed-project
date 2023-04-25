<?php 
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 

function Otp_handler(){
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        
        if(!isset($_SESSION['OTP'])){
            header("Location: /error");

        }else{
            include "./views/enter_otp_ui.php";
        }
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        require_once('./src/Register_user.php');
    

        // Checking spam
        $_SESSION['total_submit_otp'] ++;
        if($_SESSION['total_submit_otp'] > 20){
            unset($_SESSION['OTP']);
            unset($_SESSION['total_submit_otp']);
            header('Content-Type: application/json');
            $resonseData = array(
              'url' => '/error'
            );
            echo json_encode($resonseData);
            return;
        }
        $otp = $_POST['otp'];
        if(strlen($otp) === 7){
          $otp  = substr_replace($otp, '', 3, 1);
          if(!(preg_match('/^(\d{6}|\d{3}-\d{3})$/', $otp))){
              header('Content-Type: application/json');
              $resonseData = array(
                'text' => 'InvalidInput'
              );
              echo json_encode($resonseData);
              return;
          }
        }

        if((int)$_SESSION['OTP'] === (int)$otp){
          if(isset($_SESSION['type'])){
            if($_SESSION['type'] == 'changePassword'){
              unset($_SESSION['type']);
              unset($_SESSION['OTP']);
              $_SESSION['changePassword'] = true;
              header('Content-Type: application/json');
              $res = array(
                'url' => '/enter_new_password'
              );
              echo json_encode($res);
              return;
            }
          }
            call_user_func_array("Insert_user", $_SESSION['userdata']);
            // unset($_SESSION['OTP']);
            // // $_SESSION['changePassword'] = true;
            // header('Content-Type: application/json');
            // $res = array(
            //   'url' => '/complete_profile'
            // );
            // echo json_encode($res);
            // return;

        }else{
          header('Content-Type: application/json');

          $responseData = array(
            'text' => 'otpDidNotMatch'
          );
          echo json_encode($responseData);
          exit();
        }
    
    }
}

?>