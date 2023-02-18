<?php 

// Function should move image to user_images with new name

function move_image($type ){
    if( strtoupper($type) === "PROFILE_IMAGE"){
        $imageFileType = strtolower(pathinfo($_FILES["UserImg"]["name"],PATHINFO_EXTENSION));

            session_start();
            // Generate a unique file name for the uploaded image

            $uniqueId = uniqid();

            $randomString = bin2hex(random_bytes(4));
            
            $newFileName = $uniqueId . '-' . $randomString . '.' . $imageFileType;

            // Set the destination file path
            $targetFilePath = "img/temp/" . $newFileName;

            $_SESSION['New_Profile_picturename'] = $newFileName;

            // Try to move the uploaded file to the destination file path
            if (move_uploaded_file($_FILES["UserImg"]["tmp_name"], $targetFilePath)) {
                return 1;
            } else {
                return 0;
            }
    }
}
?>