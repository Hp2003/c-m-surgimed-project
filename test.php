<?php 
if($_SERVER['REQUEST_METHOD'] === "POST"){

    if(isset($_POST['imgform'])){

       require_once("src/validation/Check_Userinput.php");
       require_once("src/insertIMG.php");



    //    $Uploadok = validate_image('img/User_images/`');

    //     if ($Uploadok == 1) {
    //         // if everything is ok, try to upload file
    //         $target_file = "img/User_images/{{$_FILES['UserImg']['name']}";

    //         if (move_uploaded_file($_FILES["UserImg"]["tmp_name"],$target_file )) {
    //             if (rename($target_file, "img/User_images/" . '1.jpg')) {
    //                 echo "The file ".$_FILES['UserImg']['name']. " has been uploaded.";
    //             }
    //         } else {
    //             echo "Sorry, there was an error uploading your file.<br>";
    //         }
    //     } else {
    //         echo "Sorry, your file was not uploaded.";
   
        }
    }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="UserImg" id="">
        <input type="submit" value="submit" name="imgform">
    </form>
</body>
</html>