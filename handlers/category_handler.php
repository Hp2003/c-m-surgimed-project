<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('./src/deleteProduct.php');
// require_once('./src/add_product.php');

    require_once('./src/display_add_product.php');
    require_once('./src/connection.php');

    function get_category_table(){
        $html = file_get_contents('./views/admin_views/main_category_view.php');
        if(isset($_POST['process'])){
            if($_POST['process'] == 'getView'){

                // unset($_POST['process'] );
                // $offset = 0;
                // $_SESSION['numofcategory'] = get_num_of_records('category');
                $mainCats = display_categorys_with_limit();
                $subcatCount = array();
                foreach($mainCats as $val){
                   array_push($subcatCount, get_sub_cat_data($val['MainCategoryId'])) ;
                }
                array_push($mainCats, $subcatCount);
                header('Content-Type: application/json');
                $res= array(
                    'html' => $html,
                    'data' => $mainCats
                );
                echo json_encode($res);
                return;
            }

            if($_POST['process'] == 'openCategory'){
                $id = $_POST['id'];

                $data = get_category_data($id);

                $count_product = array();

                // getting product count
                foreach($data as $val){
                    array_push($count_product, get_product_count($val['CategoryId']));
                }
                header('Content-Type: application/json');
                array_push($data, $count_product);
                $res = array(
                    'data' => $data
                );
                echo json_encode($res);
                return;
            }
            if($_POST['process'] === 're-open_category'){
                $id = $_POST['CategoryId'];

                header('Content-Type: application/json');
                $res = array(
                    'data' => re_open_category($id)
                );
                echo json_encode($res);
                return;
            }
            if($_POST['process'] === 're-nameCategory'){
                $id = $_POST['CategoryId'];
                $newName = $_POST['newName'];
                $type = $_POST['type'];

                header('Content-Type: application/json');
                $res = array(
                    'data' => re_nameCategory($type , $newName, $id)
                );
                echo json_encode($res);
                return;
            }
            if($_POST['process'] === 'move_category'){
                $id = $_POST['CategoryId'];
                $newNameCat = $_POST['newCatName'];

                header('Content-Type: application/json');
                $res = array(
                    'data' => move_cateagory($id, $newNameCat)
                );
                echo json_encode($res);
                return;
            }
            if($_POST['process'] === 'delete_main_category'){
                $id = $_POST['CategoryId'];

                header('Content-Type: application/json');
                $res = array(
                    'data' => delete_main_category($id)
                );
                echo json_encode($res);
                return;
            }
            if($_POST['process'] === 'open_main_caegory'){
                $id = $_POST['mainCategoryId'];

                header('Content-Type: application/json');
                $res = array(
                    'data' => re_open_main_category($id)
                );
                echo json_encode($res);
                return;
            }

            if($_POST['process'] == 'delete_cat'){

                if(delte_category($_POST['CategoryId'])){
                    header('Content-Type: application/json');
                    $res = array(
                        'text' => 'cateGoryDeleted'
                    );
                    echo json_encode($res);
                    return;
                }
            }
            if($_POST['process'] == 'change_main_cat_name'){

                $name = $_POST['newName'];
                $id = $_POST['catid'];
                header('Content-Type: application/json');
                $res = array(
                    'text' => re_nameCategory('main_category', $name, $id)
                );
                
                echo json_encode($res);
                return;
            }
            if($_POST['process'] == 'add_cat'){
                if(isset($_POST['catName'])){

                    $name = $_POST['catName'];
                    $type = $_POST['type'];
                    if(strlen($name) <= 100){

                        $response = create_category($type,$name);

                        if($response == 2){
                            header('Content-Type: application/json');
                            $res= array(
                                'text' => 'alreadyAvilabel'
                            );
                            echo json_encode($res);
                            return;
                        }elseif($response == 1){
                            header('Content-Type: application/json');
                            $res= array(
                                'text' => 'categoryCreated',
                                 'name' => $name
                            );
                            echo json_encode($res);
                            return;
                        }else{
                            header('Content-Type: application/json');
                            $res= array(
                                'text' => 'failedCreatingCategory'
                            );
                            echo json_encode($res);
                            return;
                        }

                    }

                }

            }

        }
        
    }
    function display_categorys_with_limit(){
        $con = connect_to_db();
        // $con = mysqli_connect('localhost', 'root', 'panchal4555', 'login');

        $response = array();
        $query = "SELECT * FROM maincategory  ";
        
        $res = mysqli_query($con, $query);
        
        while($row = mysqli_fetch_assoc($res)){

            array_push($response, $row);
        }

        $con -> close();
        return $response;

    }
    function re_open_category($id){
        $con = connect_to_db();
        $date_time = date("Y-m-d H:i:s");

        $query = $con->prepare("UPDATE category c
        SET c.IsDeleted = 0, UpdateAt = ?
        WHERE c.CategoryId = ?
        AND EXISTS (
            SELECT 4
            FROM MainCategory mc
            WHERE mc.MainCategoryId = c.MainCategoryId
            AND mc.IsDeleted = 0
        )
    ");
    
    $query->bind_param('ss', $date_time, $id);
    // $ans = $query->get_result();
    if ($query->execute() && $query->affected_rows > 0) {
        $query->close();
        $con->close();
        return true;
    } else {
        $query->close();
        $con->close();
        return false;
    }
    
    }

    function get_sub_cat_data($mainCats){
        $con = connect_to_db();

        $sql = "SELECT * FROM category WHERE MainCateGoryId = $mainCats ";

        $res = mysqli_query($con, $sql);

        $count = mysqli_affected_rows($con);

        $con->close();

        return $count;
    }
    function get_category_data($id){
        $con  = connect_to_db();
        $sql;
            $sql = $con-> prepare("SELECT * FROM category WHERE MainCategoryId = ? ");
        // if(preg_match('/^#!:\d+$/', $id)){
        //     $id = str_replace( '#!:', '',$user_id );


        // }else{
        //     $input = '%'.$id.'%';

            // $sql = $con-> prepare("SELECT * FROM category WHERE MainCategoryName LIKE  ? ");
        // }
        $sql->bind_param('s', $id);

        $sql->execute();

        $res = $sql->get_result();

        $response = array();

        while($row = mysqli_fetch_assoc($res)){
            array_push($response, $row);
        }
        return $response;

    }
    function create_category($type, $name){
        $con = connect_to_db();
        $inserted_date = date("Y-m-d H:i:s");;

        $updated_at = date("Y-m-d H:i:s");;

        $sql = '';
        $name = trim($name);
        if($type == 'main_category'){   
            $sql = $con->prepare('INSERT INTO maincategory (MainCategoryName, CreatedTime, UpdatedOn) VALUES(?,?,?)');

            $sql->bind_param('sss', $name, $inserted_date, $updated_at);
        }if($type == 'sub_category'){
            $sql = $con->prepare('INSERT INTO category (CategoryName, CreateAt, UpdateAt, MainCategoryId ) VALUES(?,?,?,?)');

            $sql->bind_param('ssss', $name, $inserted_date, $updated_at, $_POST['main_cat_id']);
        }
        try{
            $res = $sql->execute();
            $sql->close();
            $con->close();
            return 1;
        }catch(mysqli_sql_exception $e){
            if ($e->getCode() == 1062) {
                $sql->close();
                $con->close();
                //  duplicate entry error 
                return 2;
            } else {
                $sql->close();
                $con->close();
                echo "Error: " . $e->getMessage();
                return 0;
            }
        }

    }
    function get_product_count($cat){
        $con = connect_to_db();

        $sql = "SELECT * FROM product WHERE CategoryId = $cat ";

        $res = mysqli_query($con, $sql);

        $count = mysqli_affected_rows($con);

        $con->close();

        return $count;
    }
    function delte_category($id){
        $con = connect_to_db();

        $response = array();

        $query = $con->prepare("SELECT product.* FROM product JOIN category ON product.CategoryId = category.CategoryId WHERE category.CategoryId = ? AND product.ProductStatus = 'Available'");
        $analyze_query = $con->prepare('ANALYZE TABLE category;');
        $analyze_query->execute();
        $analyze_query->store_result();
        $analyze_query->close();

        $analyze_query_product = $con->prepare('ANALYZE TABLE product;');
        $analyze_query_product->execute();
        $analyze_query_product->store_result();
        $analyze_query_product->close();


        $query->bind_param('s', $id);
        
        $query->execute();


        $res = $query->get_result();

        while($row = mysqli_fetch_assoc($res)){
            if(delte_files($row['ProductImg'])){
                $date_time = date("Y-m-d H:i:s");

                $sql = "UPDATE  product  SET ProductStatus = 'Deleted' AND UpdateAt = '$date_time' WHERE ProductId = '{$row['ProductId']}'";
                if(!mysqli_query($con, $sql)){
                    header('Content-Type: application/json');
                    $responseData = array(
                        'text' => 'failedDeleting'
                    );
                    echo json_encode($responseData);
                    return;
                }
            }else{
                header('Content-Type: application/json');
                $responseData = array(
                    'text' => 'failedDeleting'
                );
                echo json_encode($responseData);
                return;
            }
        }
        $delCat = $con->prepare("UPDATE category SET IsDeleted  = 1 WHERE CategoryId = ? ;");

        $analyze_query = $con->prepare('ANALYZE TABLE category');
        $analyze_query->execute();
        $analyze_query->store_result();
        $analyze_query->close();

        $delCat->bind_param('s', $id);

        $delCat->execute();
        $con->close();
        $query->close();
        $delCat->close();

        if($delCat){
            
            return 1;
        }else{
            return 0;
        }
    }
    function delte_files($path){

        foreach(scandir($path . '/' ) as $item){
            if($item == '.' || $item == '..'){
                continue;
            }
            if(!unlink($path . DIRECTORY_SEPARATOR . $item)){
                return false;
            }
        }
        return rmdir($path);
    }
    function re_nameCategory($type , $newName, $id){
        $date  = date("Y-m-d H:i:s");
        $con = connect_to_db();
        $sql = '';
        if($type == 'subCategory'){
            $sql = $con->prepare("UPDATE category SET CategoryName = ? , UpdateAt = '$date' WHERE CategoryId = ? ");

            $sql->bind_param('ss', $newName, $id);
            
        }else if($type == 'main_category'){
            $sql = $con->prepare("UPDATE maincategory SET MainCategoryName = ? , UpdatedOn = '$date' WHERE MainCategoryId = ? ");

            $sql->bind_param('ss', $newName, $id);
        }
        try{
            $res = $sql->execute();
            $sql->close();
            $con->close();
            return 1;
        }catch(mysqli_sql_exception $e){
            if ($e->getCode() == 1062) {
                $sql->close();
                $con->close();
                //  duplicate entry error 
                return 2;
            } else {
                $sql->close();
                $con->close();
                echo "Error: " . $e->getMessage();
                return 0;
            }
        }
    }
    function move_cateagory($categoryId , $newCategoryName){
        $con = connect_to_db();
        $date = date("Y-m-d H:i:s");
        $newCategoryId = get_main_category_id($newCategoryName);

        if (!$newCategoryId) {
            return 3; // Category does not exist
        }

        $id = $newCategoryId['MainCategoryId'];

        $sql = $con->prepare("UPDATE Category c
            SET c.MainCategoryId = ?, c.UpdateAt = ?
            WHERE c.CategoryId = ? AND EXISTS (
                SELECT 1
                FROM MainCategory mc
                WHERE mc.MainCategoryId = ? AND mc.IsDeleted = 0
            );
        ");

        $sql->bind_param('ssss', $id, $date, $categoryId, $id);
                
        if ($sql->execute() && $sql->affected_rows > 0) {
            $sql->close();
            $con->close();
            return true;
        } else {
            $error = $con->error;
            $sql->close();
            $con->close();
            error_log("Failed to update category: " . $error);
            return false;
        }


    }
    function get_main_category_id($name){
        $con = connect_to_db();


        $sql = $con->prepare('SELECT * From maincategory WHERE MainCategoryName = ? ');

        $sql->bind_param('s', $name);

        $sql->execute();

        $result = $sql->get_result();
        
        $sql->close();
        $con->close();
        if($result -> num_rows == 0){
            return false;
        }
        return  mysqli_fetch_assoc($result);
    }   
    // /////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_main_category($id){
        $date  = date("Y-m-d H:i:s");

        $con = connect_to_db();

        $allCategorys = $con->prepare("SELECT * FROM category WHERE MainCategoryId = ? ");

        $allCategorys->bind_param('s', $id);

        $allCategorys->execute();

        $res = $allCategorys->get_result();

        $allCategorys -> close();

        if($res -> num_rows > 0){
            while($row = mysqli_fetch_assoc($res)){
                delte_category($row['CategoryId']);
            }
        }
        $closequery = $con->prepare("UPDATE maincategory SET IsDeleted = 1 , UpdatedOn = '$date' WHERE MainCategoryId = ? ");

        $closequery->bind_param('s', $id);

        $result = $closequery->execute();

        $closequery->close();
        $con->close();
        return $result;

    }
    function re_open_main_category($id){
        $con = connect_to_db();

        $reOpenQuery = $con->prepare("UPDATE maincategory SET IsDeleted = 0 WHERE MainCategoryId = ? ");

        $reOpenQuery->bind_param('s', $id);

        $ans = $reOpenQuery->execute();

        $reOpenQuery->close();
        $con->close();
        
        return $ans;
    }
?>
