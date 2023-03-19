<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once('./src/connection.php');
    require_once('./src/insertIMG.php');
    require_once('./src/validation/Check_UserInput.php');
    // require_once('./src/connection.php');

    function update_user(){
        $Dob = $_POST['Dob'];
        $Email = $_POST['Email'];
        $UserName = $_POST['UserName'];
        $LastName = $_POST['LastName'];
        $FirstName = $_POST['FirstName'];
        $UserAddress = $_POST['UserAddress'];
        $MobileNumber = $_POST['MobileNumber'];
        $flexRadioDefault = $_POST['flexRadioDefault'];

        header("Content-Type: application/json");
                

        $fields = array($Dob, $Email, $UserName, $LastName, $FirstName, $UserAddress, $MobileNumber, $flexRadioDefault  );


        $filled_fields = array_filter($fields, 'strlen');
            if (count($fields) != count($filled_fields)) {    

                // header("Location: /reg");
                header("Content-Type: application/json");
                $responseData = array(
                    'text' => 'missingVal'
                );
                echo json_encode($responseData);
                return;

        }else{
            // if user first time uploading image
            if(!isset($_FILES['UserImg'])){
                if(update_without_img($Dob, $Email, $LastName, $FirstName, $UserAddress, $MobileNumber, $flexRadioDefault, $UserName )){
                    header("Content-Type: application/json");
                    $responseData = array(
                        'text' => 'Updated'
                    );
                    echo json_encode($responseData);
                    return;
                }
            }
            if($_SESSION['IsDefault'] === true){
                if(isset($_FILES["UserImg"]) && $_FILES["UserImg"]["error"] == 0) {

                        if(set_image()){
                                $con = connect_to_db();
                                // adding id to profile picture name to make it almost impossible to have duplicate
                                $new_name = $_SESSION['Uid'] . '_' . $_SESSION['New_Profile_picturename'];
                    
                                // Moving image from temp to User_images
                                rename("./img/temp/{$_SESSION['New_Profile_picturename']}" , "./img/User_images/$new_name");

                                if(update_with_img($Dob, $Email, $LastName, $FirstName, $UserAddress, $MobileNumber, $flexRadioDefault, $UserName, "./img/User_images/$new_name" )){
                                    header("Content-Type: application/json");
                                    $responseData = array(
                                        'text' => 'Profile Updated'
                                    );
                                    echo json_encode($responseData);
                                    exit();
                                }
                                
                                $response = $con->query($query);
                                $con->close();
                                return 1;
                            
                        }elseif(set_image()){
                            header("Content-Type: application/json");
                            $responseData = array(
                                'text' => 'image not set'
                            );
                            echo json_encode($responseData);
                            exit();
                        }
 
                }
                // if user already has image
            }else if($_SESSION['IsDefault'] === false){
                $new_path = "./".$_SESSION['ImageName']; 
                if(file_exists($new_path)){
                    // deleting old file
                    if(unlink($new_path)){
                        // moving image and checking it
                        if(set_image()){
                            $new_name = $_SESSION['Uid'] . '_' . $_SESSION['New_Profile_picturename'];
                             // Moving image from temp to User_images
                             rename("./img/temp/{$_SESSION['New_Profile_picturename']}" , "./img/User_images/$new_name");
                             if(update_with_img($Dob, $Email, $LastName, $FirstName, $UserAddress, $MobileNumber, $flexRadioDefault, $UserName, "./img/User_images/$new_name" )){
                                header("Content-Type: application/json");
                                    $responseData = array(
                                        'text' => 'Profile Updated'
                                    );
                                    echo json_encode($responseData);
                                    return;
                             }
                             else{
                                header("Content-Type: application/json");
                                    $responseData = array(
                                        'text' => 'Profile not updated'
                                    );
                                    echo json_encode($responseData);
                                    return;
                             }
                        }
                    }else{
                        header("Content-Type: application/json");
                        $responseData = array(
                            'text' => 'missingVal'
                        );
                        echo json_encode($responseData);
                        exit();
                    }

                } 
            }
        }
    }
    function update_without_img($Dob, $Email, $LastName, $FirstName, $UserAddress, $MobileNumber, $flexRadioDefault, $UserName ){
        // $input_data = array($UserName, $FirstName, $LastName, $Email, $UserAddress, $Dob, $flexRadioDefault );
        $connecion = connect_to_db();
        $query = "UPDATE Users SET UserName = ?, FirstName = ?, LastName = ?, Email = ?, UserAddress = ?, Dob = ?, Gender = ? WHERE UserId = ?";

        $stmt = $connecion -> prepare($query);

        $stmt->bind_param('ssssssss',$UserName, $FirstName, $LastName, $Email, $UserAddress, $Dob, $flexRadioDefault, $_SESSION['Uid']   );

        return $stmt->execute();
        


    }
    function update_with_img($Dob, $Email, $LastName, $FirstName, $UserAddress, $MobileNumber, $flexRadioDefault, $UserName, $img ){
        // $input_data = array($UserName, $FirstName, $LastName, $Email, $UserAddress, $Dob, $flexRadioDefault );
        $connecion = connect_to_db();
        $query = "UPDATE Users SET UserName = ?, FirstName = ?, LastName = ?, Email = ?, UserAddress = ?, Dob = ?, Gender = ?, ProfilePicture = ? WHERE UserId = ?";

        $stmt = $connecion -> prepare($query);

        $stmt->bind_param('sssssssss',$UserName, $FirstName, $LastName, $Email, $UserAddress, $Dob, $flexRadioDefault, $img, $_SESSION['Uid']   );

        return $stmt->execute();
        
    }
    function set_image(){
        
        // File was uploaded successfully via AJAX
        // Checking image is on proper fomat and size and is it image
        if(validate_image() === 1){
            // moving to temp  direactory
            $img_moved = FALSE;
            if(move_image("PROFILE_IMAGE")){

                return true;
                
            }else{
                    header("Content-Type: application/json");
                    $responseData = array(
                        'message' => 'failedUploadingImg'
                    );
                    echo json_encode($responseData);
                    return;
                }
            }else{
                    header("Content-Type: application/json");
                    $responseData = array(
                        'message' => 'failedUploadingImg'
                    );
                    echo json_encode($responseData);
                    return;
                }

    }

?>