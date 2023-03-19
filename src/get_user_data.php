<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    function get_user_data(){
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['loggedIn'] == True){
                require_once "./src/connection.php";

                $connection = connect_to_db();
        
                $query = "SELECT UserId, UserName, FirstName, LastName, ProfilePicture, Gender, UserAddress, Email, MobileNumber, Dob, ProfilePicture FROM Users WHERE Email = '{$_SESSION['UserEmail']}' LIMIT 1";
        
                $result = mysqli_query($connection, $query);
        
                $data = mysqli_fetch_assoc($result);

                $_SESSION['ProfileImgPath'] = $data['ProfilePicture'];

                $_SESSION['Uid'] = $data['UserId'];
        
                // echo $data;
                return $data;
            }
        }else{
            return array('error' => "soory we can't find data");
        }

    }

?>