<?php 
    include 'connection.php';
    include 'Check_UserInput.php';

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
            // Inserting data into db
            $sql = "insert into Users(UserName , FirstName , LastName , MobileNumber ,  Email , AccountPassword , UserAddress , Dob)
            values('$username' , '$firstName' , '$lastname' , $mobilenumber , '$email' , '$password' , '$useraddress' , '$dob');";
            $response = mysqli_query($GLOBALS['connection'] , $sql);
            echo "$response <br>";
            if($response){
                return 1; // Account created
            }
            return 0; // Account Not created
        }else{
            return 2; //Input is wrong
        }
 
    }

?>