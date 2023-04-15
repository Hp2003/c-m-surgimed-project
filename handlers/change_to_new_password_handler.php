<?php 
require_once('./src/connection.php');
require_once('./src/validation/Check_UserInput.php');
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        include('./views/change_password.php');
    }elseif ($_SERVER['REQUEST_METHOD'] == "POST"){
        $pas = getPassword($_SESSION['UserEmail']);
        $enteredOldPass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $re_newpass = $_POST['re-newpass'];
        changePassword($enteredOldPass, $pas, $newpass, $re_newpass);
    }
    function getPassword($email){
        $con = connect_to_db();

        $sql = "SELECT AccountPassword FROM users WHERE Email = '$email' LIMIT 1";

        $res = mysqli_query($con, $sql);

        return mysqli_fetch_assoc($res)['AccountPassword'];

    }
    function changePassword($enteredOldPass, $oldpass, $newpass, $repass){
        if(!Check_password($newpass)){
            sendRes('wronginput');
            return 0;
        }
        if($newpass != $repass){
            sendRes('bothnotmatch');
            return 0;
        }
        if($enteredOldPass !== $oldpass){
            sendRes('notmatch');
            return 0;
        }if($newpass === $oldpass){
            sendRes('samepass');
            return 0;
        }
        $con = connect_to_db();

        $sql = $con->prepare("UPDATE users SET AccountPassword = ? WHERE Email = '$_SESSION[UserEmail]' ");

        $sql->bind_param('s', $newpass);
        try{
            $sql->execute();
            $sql->close();
            $con->close();

            sendRes('changed');
        }catch(Exception $e){
            $sql->close();
            $con->close();
            sendRes('failed');
        }

    }   
    function sendRes($message){
        header('Content-Type: application/json');
        $res = array(
            'text' => $message
        );
        echo json_encode($res);
        exit();
    }
?>