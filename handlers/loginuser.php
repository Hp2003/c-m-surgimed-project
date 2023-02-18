<?php 
require_once('./src/validation/validate_user.php');
require_once('./src/connection.php');
require_once('./src/validation/Check_Userinput.php');

function get_user($email , $password){
    $con = connect_to_db();

    $sql = "SELECT UserName FROM Users WHERE Email = ? AND AccountPassword = ? LIMIT 1";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result =  $stmt->get_result();
    $row = $result->fetch_assoc();
    echo $row['UserName'];
}

function Login_user_handler(){
    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        require('./views/login_page.php');

    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = $_POST['Email'];
        $password = $_POST['password'];

        if(check_email($email)){
            get_user($email , $password);
        }else{
            echo "Invalid";
        }
    }
}
?>