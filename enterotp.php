<?php
include('validate_user.php');
generate_OTP();
if($_SERVER['REQUEST_URI'] === 'POST'){
    if(isset($_POST['otpform'])){
        $otp = $_POST['otp'];
        validate_otp((string)$otp);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
</head>
<body>
    <form action="enterotp.php" method="post" >
    <input type="text" name="otp" id="">
    <input type="submit" value="submit" name="otpform" >
    </form>
</body>
</html>