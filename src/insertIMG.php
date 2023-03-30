<?php 

if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

// Function should move image to user_images with new name

function move_image($type ){
    if( strtoupper($type) === "PROFILE_IMAGE"){
        $imageFileType = strtolower(pathinfo($_FILES["UserImg"]["name"],PATHINFO_EXTENSION));

        
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
    elseif( strtoupper($type) === "PRODUCT_IMAGE"){
        $files = $_FILES['product_image'];
            $count = count($_FILES['product_image']['name']);
            $new_folder = create_folder()  ;
            // $new_folder = str_replace("/", "\\", $new_folder);

            if($new_folder != 0){
                for($i = 0; $i < $count; $i++) {
                    $filename = $files['name'][$i];
                    $filetype = $files['type'][$i];
                    $filesize = $files['size'][$i];
                    $filetmpname = $files['tmp_name'][$i];
                    
                    
                    // Do something with the file here
                    // For example, move it to a folder on your server
                    if(!move_file($filetmpname, $new_folder, $filename , $i+1)){
                      return 0;  
                    }
                }
                return $new_folder;
                

            }else{

                if(file_exists($new_folder)){
                    rmdir($new_folder);
                    return 0;
                }
            }
    }
}


function create_folder($depth = 0){
        if($depth > 10){
            return 0;
        }
        try{
            $path = './img/Product_images/'.uniqid() ;
            if(!file_exists($path)){
                mkdir($path, 0777, true);
                return $path;
            }else{
                create_folder($depth += 1);
            }
        }catch(Exception $e){
            return 0;
        }
}
function rename_file($old_file_name, $depth = 0){
    if($depth > 10){
        return 0;
    }

    $new_file_name = time() . "_" . bin2hex(random_bytes(8));
    // Extract the file extension from the old file name

    $file_ext = pathinfo($old_file_name, PATHINFO_EXTENSION);
    // checking if file exist or not
    if(!file_exists($old_file_name)){
        // Append the file extension to the new file name
        $new_file_name = $new_file_name . "." . $file_ext;

        // Rename the file
        if(rename($old_file_name, $new_file_name)){
            return $new_file_name;
        }else{
            return 0;
        }
    }else{
        return rename_file($old_file_name, $depth += 1);
    }
    
}

function remove_dir($dir_name){
    if(is_dir($dir_name)){
        rmdir($dir_name);
        return 1;
    }
}
function move_file($filetmpname, $new_folder, $filename, $index=0){
    try{
        if(!preg_match('/\.png$|\.jpe?g$/', $filename)){
            header('Content-Type: application/json');
            $res = array(
                'text' => 'InvalidImage'
            );
            echo json_encode($res);
            return;
        }else{
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(move_uploaded_file($filetmpname, $new_folder . '/' . "$index". "_" . 'file.' . $file_ext)){
                return 1;
            }
        }
    }catch(Exception $e){
        return 0;
    }
}
?>