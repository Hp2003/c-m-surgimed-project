<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="FirstName">FistName : </label><input type="text" name="FirstName" id=""><br>
        <label for="LastName">Lastname : </label><input type="text" name="LastName" id=""><br>
        <label for="UserName">userName : </label><input type="text" name="UserName" id=""><br>
        <label for="UserName">Mobile : </label><input type="text" name="Mobile" id=""><br>
        <label for="Password">Password : </label><input type="Password" name="Password" id=""><br>
        <label for="Emaild">Email : </label><input type="text" name="Email" id=""><br>
        <label for="Address">Address : </label><textarea name="Address" id="" cols="30" rows="10"></textarea><br>
        <label for="Address">ProfilePicture : </label><input type="file" name="UserImg" id=""><br>
        <label for="Dob">Dob : </label><input type="date" name="Dob" id="">

        <input type="submit" value="Reg" name="reg">
    </form>
</body>
</html>