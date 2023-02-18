<?php 
function reg_handler(){
    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        include './views/reg.php';

    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Moving Image with random name
        include './src/validation/Validate_user.php';
        require_once './src/insertIMG.php';
        require_once './src/validation/Check_Userinput.php';

        // Removing previous messages

        session_start();
        // session_unset();
        foreach($_SESSION as $key => $val){
            if (isset($val)) {
                unset($_SESSION[$key]);
            }
        }
        // Checking if submit button clicked
        if (isset($_POST['reg'])) {
            // checking img is uploaded
                if(isset($_FILES['UserImg']) && $_FILES['UserImg']['size'] > 0){
                    // Checking image is on proper fomat and size and is it image
                    if(validate_image() === 1){
                        // moving to temp  direactory
                        if(move_image("PROFILE_IMAGE")){

                            $_SESSION['img_moved'] = TRUE;
    
                        }else{
                            $_SESSION['img_moved'] = FALSE;
                        }
                    }else{
                        $_SESSION['img_moved'] = FALSE;
                    }
                }

            // All User Inputs
            $FirstName = $_POST['FirstName'];
            $LastName = $_POST['LastName'];
            $UserName = $_POST['UserName'];
            $Mobile = $_POST['Mobile'];
            $Password = $_POST['Password'];
            $Email = $_POST['Email'];
            $Address = $_POST['Address'];
            $Dob = $_POST['Dob'];
            $fields = array($FirstName, $LastName, $UserName, $Mobile, $Password, $Email, $Address, $Dob);
            
            
            $filled_fields = array_filter($fields, 'strlen');
    
            if (count($fields) != count($filled_fields)) {
                    echo $_SESSION['InputInvalid'] = "Please Fill All Feilds";
                    header('Location: ' . $_SERVER['REQUEST_URI']);
                    exit;
                }
                session_start();
                $_SESSION['userdata'] = $fields;
           Find_user($Email);
            exit;
            
        }
    }
}
?>