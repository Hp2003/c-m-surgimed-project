<?php 
    require_once('./src/insertIMG.php');
    require_once('./src/validation/Check_UserInput.php');
    require_once('./src/connection.php');
    require_once('./src/deleteProduct.php');
    
    function add_product(){
        $title = $_POST['product_title'];
        $disc = $_POST['product_desc'];
        @$category = $_POST['select_category'];
        @$new_category = $_POST['new_category'];
        $price = $_POST['product_price'];
        $qoh = $_POST['qoh'];
        $keyword = $_POST['product_keyword'];
        
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
                $file_path = move_image("PRODUCT_IMAGE");
                if( $file_path != 0){
                    // handle error if any of the required fields are empty
                    if(!empty($category)){
                        $isProAdded = add_product_in_db($title, $disc, $file_path, $price, $qoh,'DEFAULT_CATEGORY',$keyword);
                        if($isProAdded == 0){
                            header('Content-Type: application/json');
                            $res = array(
                                'text' => 'failedAddingProduct'
                            );
                            return 0;
                        }

                    }elseif(!empty($new_category)){
                        $isCreated = create_category($new_category);
                        if( $isCreated== 1){
                            $added = add_product_in_db($title, $disc, $file_path, $price, $qoh, 'NEW_CATEGORY',$keyword);
                            if($added === 0){
                                delte_files($file_path);
                                header('Content-Type: application/json');
                                $res = array(
                                    'text' => 'failedAddingProduct'
                                );
                                return 0;
                            }
                        }elseif($isCreated == 2){
                            delte_files($file_path);
                            header('Content-Type: application/json');
                            $response = array(
                                'text' => 'DuplicateKey'
                            );
                            echo json_encode($response);
                            return;
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
            
        }
    function add_product_in_db($title, $disc, $filePath, $price, $qoh, $type, $keyword){
        $connection = connect_to_db();
        $query;
        if($type === "DEFAULT_CATEGORY"){
            // getting category id
            try{
                $stmt_c_id = $connection->prepare("SELECT CategoryId FROM category WHERE CategoryName = ?");
                $stmt_c_id->bind_param("s", $_POST['select_category']);
                $stmt_c_id->execute();
                $result = $stmt_c_id->get_result();
                $id = $result->fetch_assoc();



                // adding product
                $query = $connection->prepare("INSERT INTO Product (ProductTitle, ProductImg, ProductDesc, ProductPrice, CateGoryId, QuantityOnHand, ProductKeywords) VALUES(?, ?, ?, ?, ?, ?, ?) ");
                $query->bind_param("sssssss", $title, $filePath, $disc, $price, $id['CategoryId'], $qoh, $keyword);
                
                $query->execute();
                $id = $connection->insert_id;
                $query->close();
                $analyze_query_product = $connection->prepare('ANALYZE TABLE product;');
                $analyze_query_product->execute();
                $analyze_query_product->store_result();
                $analyze_query_product->close();
                
                $connection->close();
            }catch(Exception $e){
                return 0;
            }
            
            if($query){
                header('Content-Type: application/json');
                $response = array(
                    'text' => 'ProductAdded',
                    'id' => $id
                );
                echo json_encode($response);
                return;
            }else{
                return 0;
            }
        }
        if($type === "NEW_CATEGORY"){

            $query = $connection->prepare("INSERT INTO Product (ProductTitle, ProductImg, ProductDesc, ProductPrice, CateGoryId, QuantityOnHand, ProductKeywords) VALUES(?, ?, ?, ?, ?, ?, ?) ");
            $query->bind_param("sssssss", $title, $filePath, $disc, $price, $_SESSION['categoryID'], $qoh ,$keyword);
            $query->execute();
            unset($_SESSION['categoryID']);

            $analyze_query_product = $connection->prepare('ANALYZE TABLE product;');
            $analyze_query_product->execute();
            $analyze_query_product->store_result();
            $analyze_query_product->close();

            $connection->close();
            if($query){
                header('Content-Type: application/json');
                $response = array(
                    'text' => 'ProductAddedWithNewCategory'
                );
                echo json_encode($response);
                return;
            }else{
                return 0;
            }
        }
    }
    // check and creaet category
    function create_category($category){

        try{
            $connection = connect_to_db();
            $stmt_c_id = $connection->prepare("INSERT INTO  category(CategoryName) VALUES (?) ");
            $stmt_c_id->bind_param("s", $category);
            $stmt_c_id->execute();
            $insertId = $connection->insert_id;
            $_SESSION['categoryID'] = $insertId;
            $stmt_c_id->close();
            $connection->close();
            return 1;
        }catch(mysqli_sql_exception $e){
            if ($e->getCode() == 1062) {
 
                //  duplicate entry error 
                return 2;
            } else {

                echo "Error: " . $e->getMessage();
                return 0;
            }
        }
    }
?>