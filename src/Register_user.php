<?php 
    require_once 'connection.php';
    require 'Check_Userinput.php';
    
    function Insert_user($firstname, $lastname, $username, $mobilenumber, $password, $email, $address, $dob){

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
            // Inserting data into db
            $con = connect_to_db();
            mysqli_autocommit($con , false);
            try{
                $sql = "insert into Users(UserName , FirstName , LastName , MobileNumber ,  Email , AccountPassword , UserAddress , Dob)
                values('$username' , '$firstname' , '$lastname' , $mobilenumber , '$email' , '$password' , '$address' , '$dob');";
                $response = mysqli_query($con , $sql);
            if($response){
                mysqli_commit($con);
                $con->close();
                echo 'Account Created!';
                
            }else{
                echo mysqli_error($con);
                return 0; // Account Not created
            }
            }catch(mysqli_sql_exception $e){
                 if(mysqli_errno($con) == 1406){
                    echo "value is too big";   // Value is too big
                }
            }
            

        }else{
            return 2; //Input is wrong
        }
 
    }

?>