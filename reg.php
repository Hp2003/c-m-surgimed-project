<?php 
    include 'Register_user.php';

    session_start();
    // session_unset();
    foreach($_SESSION as $key => $val){
        if (isset($val)) {
            echo $val;
            unset($_SESSION[$key]);
        }
    }
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['reg'])) {

        // All User Inputs
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $UserName = $_POST['UserName'];
        $Mobile = $_POST['Mobile'];
        $Password = $_POST['Password'];
        $Email = $_POST['Email'];
        $Address = $_POST['Address'];
        $Dob = $_POST['Dob'];
        $fields = array($FirstName, $LastName, $UserName, $Mobile, $Password, $Email, $Address, $Dob);
        $filled_fields = array_filter($fields, 'strlen');

        if (count($fields) != count($filled_fields)) {
            echo $_SESSION['InputInvalid'] = "Please Fill All Feilds";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
        $res = AddUser($UserName, $FirstName, $LastName, $Mobile, $Email, $Password, $Address, $Dob);
        if ($res === 1) {
            echo $_SESSION['Success'] = "Account Created!";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            // unset($_SESSION['Success']);
            exit;
        } elseif ($res === 2) {
            echo $_SESSION['InputError'] = "There is some error in Input!";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            // unset($_SESSION['InputError']);
            exit;
        } elseif ($res === 0) {
            echo $_SESSION['ServerError'] = "There is error with Server Try again!";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            // unset($_SESSION['ServerError']);
            exit;
        } 
        elseif ($res === 3) {
            echo $_SESSION['Exists'] = "Email Or Phone number is already Linked with account";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } elseif ($res === 4) {
            echo $_SESSION['Bigval'] = "Value is Too big";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
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