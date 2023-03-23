<?php 
    require_once('./src/insertIMG.php');
    require_once('./src/validation/Check_UserInput.php');
    require_once('./src/connection.php');
    function add_product(){
        $title = $_POST['product_title'];
        $disc = $_POST['product_desc'];
        @$category = $_POST['select_category'];
        @$new_category = $_POST['new_category'];
        $price = $_POST['product_price'];
        $qoh = $_POST['qoh'];

        // checking if file is uploaded successfully
        foreach($_FILES["product_image"]['error'] as $key => $error){
            if($error === UPLOAD_ERR_NO_FILE){
                header('Content-Type: application/json');
                $res = array(
                    'text' => 'noImg'
                );
                echo json_encode($res);
                return 0;
            }
        }
            // moving img to diractory
            $file_path = move_image("PRODUCT_IMAGE");

            if( $file_path != 0){
 
                if(empty($category) && empty($new_category)){
                    // handle error if both categories are empty
                    header("Content-Type: application/json");
                    $responseData = array(
                        'text' => 'missingCategory'
                    );
                    echo json_encode($responseData);
                    return;
                }
                
                if(!(empty($title) && empty($disc) && empty($price))){
                    // handle error if any of the required fields are empty
                    if(!empty($category)){
                        add_product_in_db($title, $disc, $file_path, $price, $qoh,  'DEFAULT_CATEGORY');
                    }
                    elseif(!empty($new_category)){
                        add_product_in_db($title, $disc, $file_path, $price, $qoh, 'NEW_CATEGORY');
                    }
                }

            }else{
                header('Content-Type: application/json');
                $res = array(
                    'text' => 'failedUploadingImg'
                );
                echo json_encode($res);
                return;
            }
        }
    function add_product_in_db($title, $disc, $filePath, $price, $qoh, $type){
        $connection = connect_to_db();
        if($type === "DEFAULT_CATEGORY"){
            // getting category id
            $stmt_c_id = $connection->prepare("SELECT CategoryId FROM category WHERE CategoryName = ?");
            $stmt_c_id->bind_param("s", $_POST['select_category']);
            $stmt_c_id->execute();
            $result = $stmt_c_id->get_result();
            $id = $result->fetch_assoc();
            $id = $id['CategoryId'];
            // adding product
            $query = $connection->prepare("INSERT INTO Product (ProductTitle, ProductImg, ProductDesc, ProductPrice, CateGoryId, QuantityOnHand) VALUES(?, ?, ?, ?, ?, ?) ");
            $query->bind_param("ssssss", $title, $filePath, $disc, $price, $id, $qoh);
            $query->execute();
            if($query){
                header('Content-Type: application/json');
                $response = array(
                    'text' => 'ProductAdded'
                );
                echo json_encode($response);
                return;
                $connection->close();
            }
        }
        if($type === "NEW_CATEGORY"){
            $stmt_c_id = $connection->prepare("INSERT INTO  category(CategoryName) VALUES (?) ");
            $stmt_c_id->bind_param("s", $_POST['new_category']);
            $stmt_c_id->execute();
            $insertId = $connection->insert_id;

            $query = $connection->prepare("INSERT INTO Product (ProductTitle, ProductImg, ProductDesc, ProductPrice, CateGoryId, QuantityOnHand) VALUES(?, ?, ?, ?, ?, ?) ");
            $query->bind_param("ssssss", $title, $filePath, $disc, $price, $insertId, $qoh );
            $query->execute();
            if($query){
                header('Content-Type: application/json');
                $response = array(
                    'text' => 'ProductAdded'
                );
                echo json_encode($response);
                return;
                $connection->close();
            }
        }
    }
            
?>