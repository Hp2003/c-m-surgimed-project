<?php 

// This module is for inserting new user in database

require_once './src/connection.php';
require_once './src/validation/Check_Userinput.php';
require_once 'insertIMG.php';

function Insert_user($firstname, $lastname, $password, $email, $dob, $gender){
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    trim($email);
    trim($password);

    // Checking User Input
    $validation = [];
    $validation[0] = check_dob($dob);
    // $validation[1] = check_mobile($mobilenumber);
    $validation[2] = check_email($email);
    $validation[3] = check_password($password);

    // Checking if all values are true in array
    $result = array_reduce($validation, function ($carry, $item) {
        return $carry && $item;
    } , true);

    $response = "";

    if($result === TRUE){

            
            // Inserting user 
            $con = connect_to_db();
            $fullname  = $firstname . $lastname;
            try{
                $sql = "insert into Users(Username , FirstName , LastName ,  Email , AccountPassword, Dob , Gender)
                values('$fullname', '$firstname' , '$lastname' , '$email' , '$password' , '$dob' , '$gender');";
                $response = mysqli_query($con , $sql);


                if($response){
                    $_SESSION['id'] = $con->insert_id;

                    // Inserting default Image for user
                    if($gender === 'MALE'){
                        $insert_user_image = "UPDATE Users  SET ProfilePicture = 'img/defaultIMG/Default_male.jpg' WHERE UserId = '{$_SESSION['id']}'";
                        mysqli_query($con ,$insert_user_image );
                        $con->close();

                    }else if($gender === 'FEMALE'){
                        $insert_user_image = "UPDATE Users  SET ProfilePicture = 'img/defaultIMG/Default_female.jpg'  WHERE UserId = '{$_SESSION['id']}'";
                        mysqli_query($con ,$insert_user_image );
                        $con->close();
                    }
                $_SESSION['full_name'] = $firstname . ' ' . $lastname;
                $_SESSION['Is_account_created'] = TRUE;
                // header('Content-Type: text/plain');
                // echo "in";
                // return;
                unset($_SESSION['OTP']);
                header('Content-Type: application/json');
                $responseData = array(
                    'url' => '/complete_profile'
                );
                echo json_encode($responseData);
                return;
        }else{

            echo mysqli_error($con);
            return 0; // Account Not created

        }
        }catch(mysqli_sql_exception $e){

                if(mysqli_errno($con) == 1406){
                    header('Content-Type: application/json');
                    $responseData = array(
                        'text' => 'bigVal',
                        'url'  => '/'
                    );
                    echo json_encode($response);
                    return;

            }else{
                echo $e;
            }
        }
    }else{
        return 2; //Input is wrong
    }

}

?>