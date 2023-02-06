<?php 
    include 'Register_user.php';

    session_start();
    
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['reg'])){
            // All User Inputs
            $FirstName = $_POST['FirstName'];
            $LastName = $_POST['LastName'];
            $UserName = $_POST['UserName'];
            $Mobile = $_POST['Mobile'];
            $Password = $_POST['Password'];
            $Email = $_POST['Email'];
            $Address = $_POST['Address'];
            $Dob = $_POST['Dob'];

            echo $Dob . "<br>";
            if(isset($_POST)){
                $res = AddUser($UserName , $FirstName , $LastName , $Mobile , $Email ,  $Password , $Address , $Dob);
                if($res === 1){
                    echo "Account Created";
                }elseif($res === 2){
                    echo "Account Not Created error in input";
                }elseif($res === 0){
                    echo "server error";
                }
            }
        }else{
            echo $_SESSION['error'] = "Tray Again!";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <form action="reg.php" method="post">
        <label for="FirstName">FistName : </label><input type="text" name="FirstName" id=""><br>
        <label for="LastName">Lastname : </label><input type="text" name="LastName" id=""><br>
        <label for="UserName">userName : </label><input type="text" name="UserName" id=""><br>
        <label for="UserName">Mobile : </label><input type="text" name="Mobile" id=""><br>
        <label for="Password">Password : </label><input type="Password" name="Password" id=""><br>
        <label for="Emaild">Email : </label><input type="text" name="Email" id=""><br>
        <label for="Address">Address : </label><textarea name="Address" id="" cols="30" rows="10"></textarea>
        <label for="Dob">Dob : </label><input type="date" name="Dob" id="">

        <input type="submit" value="Reg" name="reg">
    </form>
</body>
</html>