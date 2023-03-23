<?php 
require_once('./src/validation/validate_user.php');
require_once('./src/connection.php');
require_once('./src/validation/Check_Userinput.php');

function get_user($email , $password){

    $con = connect_to_db();

    $sql = "SELECT UserName, UserId, Email, IsAdmin FROM Users WHERE Email = ? AND AccountPassword = ? LIMIT 1";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result =  $stmt->get_result();
    $row = $result->fetch_assoc();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if($row != null){
        // saving for later use
        $_SESSION['userName'] = $row['UserName'];
        $_SESSION['userId'] = $row['UserId'];
        $_SESSION['UserEmail'] = $row['Email'];
        $_SESSION['IsAdmin'] = $row['IsAdmin'];
        
        $_SESSION['loggedIn'] = True;
        header('Conent-Type: application/json');
        $responseData = array(
            'url' => '/'
        );
        echo json_encode($responseData);
        return;
    }else{
        header('Conent-Type: application/json');
        $responseData = array(
            'text' => 'userNotFound'
        );
        echo json_encode($responseData);
        return;
    }
}

function Login_user_handler(){
    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        require('./views/login_page_ui.php');

    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){


        $email = $_POST['Email'];
        $password = $_POST['password'];

        if(check_email($email)){
            get_user($email , $password);
        }else{
            header("Content-Type: application/json");
            $responseData = array(
                'text' => "invalidEmail"
            );
            echo json_encode($responseData);
            return;
        }
    }
}
?>