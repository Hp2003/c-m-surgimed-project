<?php 

// This module is for inserting new user in database

require_once './src/connection.php';
require_once './src/validation/Check_Userinput.php';
require_once 'insertIMG.php';
// require_once '.php';

function Insert_user($firstname, $lastname, $username, $mobilenumber, $password, $email, $address, $dob){
    session_start();

    trim($email);
    trim($password);
    trim($mobilenumber);

    // Checking User Input
    $validation = [];
    $validation[0] = check_dob($dob);
    $validation[1] = check_mobile($mobilenumber);
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
            try{
            $sql = "insert into Users(UserName , FirstName , LastName , MobileNumber ,  Email , AccountPassword , UserAddress , Dob)
            values('$username' , '$firstname' , '$lastname' , $mobilenumber , '$email' , '$password' , '$address' , '$dob');";
            $response = mysqli_query($con , $sql);


            if($response){
            $id  = $con->insert_id;

            if($_SESSION['img_moved'] === TRUE){

                $new_name = $id . '_' . $_SESSION['New_Profile_picturename'];

                rename("./img/temp/{$_SESSION['New_Profile_picturename']}" , "./img/User_images/$new_name");

                $query = "UPDATE Users set ProfilePicture = 'img/User_images/$new_name'WHERE UserId = '$id' " ;


                $_SESSION['is_proflie_image_uploaded'] = $con->query($query);

                $con->close();
                
            }else{
                // Inserting default Image for user
                $insert_user_image = "UPDATE Users  SET ProfilePicture = 'img/defaultIMG/Default_male.jpg' WHERE UserId = '$id';";
                mysqli_query($con ,$insert_user_image );
                $con->close();
                
            }
            echo "In";
            header('Location: /login');
        }else{

            echo mysqli_error($con);
            return 0; // Account Not created

        }
        }catch(mysqli_sql_exception $e){

                if(mysqli_errno($con) == 1406){

                echo "value is too big";   // Value is too big

            }else{
                echo "There is something wrong!";
            }
        }
    }else{
        return 2; //Input is wrong
    }

}

?>