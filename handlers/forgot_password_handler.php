<?PHP

if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        include('./views/forgot_password_view.php');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        require_once('./src/connection.php');
        require_once('./src/validation/validate_user.php');
        require_once('./src/validation/Check_UserInput.php');

        if(!check_email($_POST['email'])){
            header('Content-Type: application/json');

            $resArray = array(
                'text' => 3
            );
            echo json_encode($resArray);
            return;
        }
        if(check_user()){
            $_SESSION['type'] = 'changePassword';
            Validate_user($_POST['email']);
        }else{
            header('Content-Type: application/json');

            $resArray = array(
                'text' => false
            );
            echo json_encode($resArray);
            return;
        }

    }
    function check_user(){
        $con = connect_to_db();

        $sql = "SELECT * FROM users WHERE Email = '{$_POST['email']}' LIMIT 1";

        $res = mysqli_query($con, $sql);


        if($res && mysqli_num_rows($res) > 0){
            $_SESSION['User_Email'] =  mysqli_fetch_assoc($res)['Email'];
            return true;
        }else{
            return false;
        }

    }

?>