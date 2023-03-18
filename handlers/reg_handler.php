<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function reg_handler(){
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    // foreach($_SESSION as $key => $val){
    //     if(isset($_SESSION[$key]) ){
    //         echo $val;
    //         unset($_SESSION[$key]);
    //     }
    // }

    // Printing error messages

    if(isset($_SESSION['invalid_input'])){
        echo $_SESSION['invalid_input'];
        unset($_SESSION['invalid_input']);
    }elseif(isset($_SESSION['userAvailable'])){
        echo $_SESSION['userAvailable'];
        unset($_SESSION['userAvailable']);
    }
    elseif(isset($_SESSION['bigVal'])){
        echo $_SESSION['bigVal'];
        unset($_SESSION['bigVal']);
    }

    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        include './views/reg_ui.php';
        
    }else if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // die("page died");
        require_once './src/validation/Validate_user.php';
        require_once './src/insertIMG.php';
        require_once './src/validation/Check_Userinput.php';
        
            // checking img is uploaded
           

            // User Inputs
            $FirstName = $_POST['FirstName'];
            $LastName = $_POST['LastName'];
            // $Mobile = $_POST['Mobile'];
            $Password = $_POST['Password'];
            $Email = $_POST['Email'];
            // $Address = $_POST['Address'];
            $Dob = $_POST['Dob'];
            @$Gender = strtoupper($_POST['gender']);

            // Checking if all feilds are filled 
            $fields = array($FirstName, $LastName, $Password, $Email, $Dob, $Gender );
            
            

            $filled_fields = array_filter($fields, 'strlen');
            if (count($fields) != count($filled_fields)) {    

                // header("Location: /reg");
                header("Content-Type: application/json");
                $responseData = array(
                    'text' => 'missingVal'
                );
                echo json_decode($responseData);
                exit();

            }else{
                $_SESSION['userdata'] = $fields;
                Find_user($Email);
            }
    }
}

?>