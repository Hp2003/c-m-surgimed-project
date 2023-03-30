<?php 
require_once('connection.php');
require_once('insertIMG.php');

    function edit_pro_data(){

        $title = $_POST['product_title'];
        $desc = $_POST['product_desc'];
        $keywords = $_POST['product_keywords'];
        // $categoryName = $_POST['product_category'];
        $pric = $_POST['product_price'];
        $pid = $_POST['product_id'];
        $qoh = $_POST['QOH'];
        $img_dir = $_POST['img_dir'];
        // Checking if all feilds are filled

        $fields = array( $title, $desc, $keywords, $pric, $qoh, $pid);

        $filled_fields = array_filter($fields, 'strlen');
        if (count($fields) != count($filled_fields)) {    

            header("Content-Type: application/json");
            $responseData = array(
                'text' => 'missingVal'
            );
            echo json_encode($responseData);
            exit();

        }


        for($i = 0 ; $i<= 5 ; $i++){
            if(isset($_FILES["file_$i"]) && filesize($_FILES["file_$i"]['tmp_name']) > 0){
                insert_file($_FILES["file_$i"], $img_dir, $i);
            }
        }

        if(!empty($_POST['remove'])){
            // header('Content-Type: application/json');
            // echo json_encode($_POST['remove']);
            // return;
            if(count($_POST['remove']) >= (count(scandir($img_dir . '/')) - 2)){
                header('Content-Type: application/json');
                $res = array(
                    'text' => 'trayingToRemoveAllFileErr'
                );
                echo json_encode($res);
                return;
            }
            if(remove_img($img_dir)){

                if(!rename_files($img_dir)){
                    header('Content-Type: application/json');
                    $res = array(
                        'text' => 'FailedUploadingFiles'
                    );
                    return;
                }
            }
        }
        if(isset($_POST['product_category'])){
            $categoryId = get_category_id();


            if(Update_product_main($categoryId, $title, $desc, $keywords, $pric, $qoh, $pid )){
                header('Content-Type: application/json');
                $res = array(
                    'text'=> 'ProductUpdatedSuccessfully'
                );
                echo json_encode($res);
                return;
            }else{
                header('Content-Type: application/json');
                $res = array(
                    'text'=> 'FailedUpdatingProduct'
                );
                echo json_encode($res);
                return;
            }
        }else if(isset($_POST['new_category'])){
            $createdCategroyId = create_category($_POST['new_category']);

            if($createdCategroyId == 0 ){
                header('Content-Type: application/json');
                $res = array(
                    'text'=> 'CategoryAlreadyAvailable'
                );
                echo json_encode($res);
                return;
            }else if($createdCategroyId == 2){
                header('Content-Type: application/json');
                $res = array(
                    'text'=> 'FailedCreatingCategory'
                );
                echo json_encode($res);
                return;
            }
            if(Update_product_main($createdCategroyId, $title, $desc, $keywords, $pric, $qoh, $pid)){
                header('Content-Type: application/json');
                $res = array(
                    'text'=> 'ProductUpdatedSuccessfully'
                );
                echo json_encode($res);
                return;
            }else{
                header('Content-Type: application/json');
                $res = array(
                    'text'=> 'FailedUpdatingProduct'
                );
                echo json_encode($res);
                return;
            }
        }
    }
    function get_category_id(){
        $con = connect_to_db();

        $sql = $con->prepare("SELECT CategoryId FROM  category WHERE CategoryName = ?");

        $sql->bind_param("s", $_POST['product_category']);

        $sql->execute();

        $res = $sql->get_result();

        $sql->close();
        $con->close();



        return mysqli_fetch_assoc($res)['CategoryId'];
    }
    function Update_product_main($categoryId, $title, $desc, $keywords, $pric, $qoh, $pid ){
        $con = connect_to_db();


        $sql = $con->prepare("UPDATE product SET ProductTitle = ? , ProductDesc = ? , ProductPrice = ? , CateGoryId = ? , QuantityOnHand = ? , ProductKeywords = ?  WHERE ProductId = ? ");

        $sql->bind_param('sssssss', $title, $desc, $pric, $categoryId, $qoh, $keywords, $pid);

        $sql->execute();

        $sql->close();
        $con->close();

        return 1;
        
    }
    function insert_file($file, $img_dir, $index){


        $fullPath = $img_dir . '/' ;
        $output = scandir($fullPath);

        // $output[count($output)-3][0];

        if(isset($output[$index + 1])  ){
            unlink($img_dir . '/' . $output[$index + 1]);
            $file_ext = pathinfo($_FILES["file_$index"]['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES["file_$index"]["tmp_name"], $fullPath . "$index". "_" . 'file.' . $file_ext);
        }else{
            move_file($_FILES["file_$index"]["tmp_name"], $fullPath , $_FILES["file_$index"]["name"], $index );
        }

    }
    function remove_img($img_dir){
        $removeIndexs =  $_POST['remove'];

        $fullPath = $img_dir . '/' ;
        $output = scandir($fullPath);
        foreach ($removeIndexs as $val){
            if(isset($output[$val[intval(strlen($val)) - 1] + 1])){
                unlink($img_dir . '/' . $output[$val[intval(strlen($val)) - 1] + 1]);
            }
        }
        return 1;
    }
    function rename_files($img_dir){
        $files = scandir($img_dir . '/');
        $count = 0;
        foreach($files as $file){
            if($file == '.' || $file == '..'){
                continue;
            }

            $oldname = $img_dir . '/' . $file;

                $count ++;

                $file_ext = pathinfo($oldname , PATHINFO_EXTENSION);

                $new_name = $img_dir . "/" . "$count" . "_file" . '.' . $file_ext;

                rename($oldname , $new_name);
        }
        return 1;
    }
    function create_category($categoryname){
        $con = connect_to_db();
        $date = date("Y-m-d");
        try{
            $sql = $con->prepare("INSERT INTO category (CreateAt, CategoryName) VALUES (? ,?)");
    
            $sql->bind_param('ss', $date, $categoryname);
    
            $sql->execute();

            $id = $con->insert_id;
    
            $sql->close();
            $con->close();
             
            return $id;
        }catch (Exception $e){
            if($e->getCode() == 1062){
                $sql->close();
                $con->close();
                
                return 0;
            }else{
                $sql->close();
                $con->close();

                return 2;
            }
        }

        return $id;

    }
?>