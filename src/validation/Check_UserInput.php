<?php
require_once('./lib/PHPMailer/src/PHPMailer.php');
require_once('./lib/PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

###########################################################################################################################################################

// Validating email pattern
function check_email($email){
    $mail = new PHPMailer();

    if ($mail->validateAddress($email)) {
            return true;
        } else {
            return false;
        }
}
###########################################################################################################################################################

// checking password pattern
function Check_password($password){
    if(!preg_match( '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/' , $password)){
        return false;
    }else{
        return true;
    }
}
###########################################################################################################################################################
function check_mobile($mobile){
    if(preg_match('/^\d{10,15}$/', $mobile)){
        return TRUE;
    }else{
        return FALSE;
    }
}
###########################################################################################################################################################

function check_dob($dob){
    $year = intval(substr($dob , 0 , 4));
    $current_year = intval(date('Y'));
    if($year < $current_year ){
        if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $dob)){
            // Checking is user 18 or above
            $age = $current_year - $year;
            if(( $age >= 18 && $age <= 100 )){
                return TRUE;
            }
        }
    }
    return false;
}

###########################################################################################################################################################

// Checking Image from user
function validate_image(){

    // $target_file = $target_dir . basename($_FILES['UserImg']['name']);

    $imgfiletype = strtolower(pathinfo(basename($_FILES['UserImg']['name']) , PATHINFO_EXTENSION));

    // Checking if images is real or fake
    $check = getimagesize($_FILES["UserImg"]["tmp_name"]);
    // $responseData = array(
    //     'text' => $_FILES['UserImg']['tmp_name']
    // );
    // echo json_encode($responseData);
    // return;
    if($check){
        if ($_FILES["UserImg"]["size"] <=  10000000) {
            if($imgfiletype == "jpg" || $imgfiletype == "png" || $imgfiletype == "jpeg") {
                return 1;  //Image is Valid
            }
        }
    }else{
        return 0; // It's not an image
    }
}

###########################################################################################################################################################

function validate_product_images($file){
    
}

###########################################################################################################################################################
function check_gender($gender){
        
        $valid_type = ["MALE" , "FEMALE"];
        $filterd_type = array_filter($valid_type ,fn($val)=>  $val === $gender);
        return !empty($filterd_type);
}

?>

