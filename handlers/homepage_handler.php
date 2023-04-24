<?php 
    require_once('./src/connection.php');
    require_once('./src/send_email.php');
    require_once('./src/validation/Check_UserInput.php');
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    function home_handler(){
        if($_SERVER['REQUEST_METHOD' ] === 'GET'){
            give_user_name();
            include('./views/home.php');
        }
    }

    function give_user_name(){

        if(isset($_SESSION['userName'])){
            return $_SESSION['userName'];
        }
        return 'signUp';
    }
    function send_feedback(){
        $email = $_POST['Email'];
        $message = $_POST['Message'];
        
        $reciver = 'panchalhirenm123@gmail.com';
        
        if(!check_email($email)){
            header('Content-Type: application/json');
            $responseData = array(
                'text' => 'emailIsIncorrect'
            );
            echo json_encode($responseData);
            return;
        }
        
        $new_message = "
        <h2>Email From : $email</h2><br>
        <p>$message</p>
        ";
        if(send_email($reciver, $new_message)){
            unset($_SESSION['SendFeedback']);
            header('Content-Type: application/json');
            $responseData = array(
                'text' => 'eamilSentSuccessFully'
            );
            echo json_encode($responseData);
            return ;
        }else{
            header('Content-Type: application/json');
            $responseData = array(
                'text' => 'errorOccured'
            );
            echo json_encode($responseData);
            return ;
        }
    }
    function get_categorys_with_id($filter = true){
        $connection = connect_to_db();
        $query = '';
        if($filter){
            $query = "SELECT CategoryName, CategoryId FROM category ";
        }else{
            $query = "SELECT CategoryName, CategoryId FROM category WHERE IsDeleted = 0";
        }

        $result = mysqli_query($connection, $query);

        $data = array();
        while($row = $result->fetch_assoc()){
            array_push($data, $row);
        };
        $connection->close();
        return $data;
    }
?>