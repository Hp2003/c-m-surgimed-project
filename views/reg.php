<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script   src="../src/js/reg_validation.js"></script>

</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="FirstName">FistName : </label><input type="text" name="FirstName" id="first_name" autofocus="1"><br>
        <label for="LastName">Lastname : </label><input type="text" name="LastName" id="last_name"><br>
        
        <label for="gender">female : </label><input type="radio" name="gender" id="" value="female" >
        <label for="gender">male : </label><input type="radio" name="gender" id="" value="male"><br>

        <label for="Address">Address : </label><textarea name="Address" id="user_address" cols="30" rows="10"></textarea><br>
        <label for="Mobile">Mobile : </label><input type="text" name="Mobile" id="Mobile_number"><br>
        <label for="Password">Password : </label><input type="Password" name="Password" id="user_password"><br>
        <label for="Emaild">Email : </label><input type="text" name="Email" id="user_email"><br>
        <label for="Dob">Dob : </label><input type="date" name="Dob" id="">
        
        <input type="submit" value="reg" name="reg">
    </form>
</body>
</html>