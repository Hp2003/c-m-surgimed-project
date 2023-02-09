<?php 
    include 'connection.php';
    include 'Check_UserInput.php';
    include 'validate_user.php';
    include 'send_email.php';

    function AddUser($username , $firstName , $lastname , $mobilenumber , $email , $password , $useraddress , $dob){
        trim($email);
        trim($password);
        trim($mobilenumber);

        // Checking User Input
        $validation = [];
        $validation[0] = check_dob($dob);
        $validation[1] = check_mobile($mobilenumber);
        $validation[2] = check_email($email);
        $validation[3] = check_password($password);
        echo var_dump($validation);

        // Checking if all values are true in array
        $result = array_reduce($validation, function ($carry, $item) {
            return $carry && $item;
        } , true);
        
        if($result === TRUE){
            if(check_user($email)){
                
            }
            // Inserting data into db
            try{
                $sql = "insert into Users(UserName , FirstName , LastName , MobileNumber ,  Email , AccountPassword , UserAddress , Dob)
                values('$username' , '$firstName' , '$lastname' , $mobilenumber , '$email' , '$password' , '$useraddress' , '$dob');";
                $response = mysqli_query($GLOBALS['connection'] , $sql);
                echo "$response <br>";
                if($response){
                    return 1; // Account created
                }else{
                    echo mysqli_error($GLOBALS['connection']);
                    return 0; // Account Not created
                }

            }catch(mysqli_sql_exception $e){
                if(mysqli_errno($GLOBALS['connection']) == 1062){
                    return 3;       // Account already Exist
                }else if(mysqli_errno($GLOBALS['connection']) == 1406){
                    return 4;       // Value is too big
                }
            }

        }else{
            return 2; //Input is wrong
        }
 
    }

?>