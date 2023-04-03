<?php 
    require_once('./src/connection.php');

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } 
    if(!isset( $_SESSION['changePassword'])){
        header('Location: /error');
        die();
    }
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        include('./views/reset_password.php');
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(change_password()){
            unset($_SESSION['User_Email']);
            unset($_SESSION['changePassword']);
            header('Content-Type: application/json');
            $res = array(
                'url' => '/login'
            );
            echo json_encode($res);
            return;
        }

    }
    function change_password(){
        // print_r($_SESSION);
        $pass1 =  $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        if($pass1 == $pass2){
            $con = connect_to_db();

            $sql = "UPDATE users SET AccountPassword = '$pass1' WHERE Email = '$_SESSION[User_Email]' LIMIT 1";

            $res = mysqli_query($con, $sql);

            if($res){
                $con->close();
                return 1;
            }else{
                $con->close();
                return 0;
            }
        }

    }
?>