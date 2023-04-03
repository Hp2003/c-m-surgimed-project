<?php 
    require_once('connection.php');
    require_once('display_add_product.php');
    require_once('get_categorys_brands_and_sub_categorys.php');

    function get_edit_pro(){

        $file_path = './views/admin_views/edit_product.php';

        if (file_exists($file_path)) {
        // Set the content type to HTML
        header('Content-Type: application/json');
        
        $html = file_get_contents($file_path); 
        $data = get_product_info();
        // header('Content-Type: application/json');
        // $res = array(
        //     'text' => $data['CateGoryId']
        // );
        // echo json_encode($res);
        // return;
        $cats = getCatsWithId($data['CateGoryId']);
        // header('Content-Type: text/plain');
        // print_r($data);
        // return;
        $imgs = get_images($data['ProductImg']);
        $data['imgs'] = $imgs;
        $data['cats'] = $cats;
        // header('Content-Type: application/json');
        // echo json_encode($data);
        // return;
        $maincats = get_maincat_with_id($data['cats'][0]['MainCategoryId']);
        $brands = get_brands_with_id($data['BrandId']);
        $data['mainCats'] = $maincats;
        $data['brands'] = $brands;

        $res = array(
            'html' => $html,
            'formData' => $data
        );
        echo json_encode($res);
        return;
        } else {
        // File not found error
            header('HTTP/1.0 404 Not Found');
            echo 'File not found';
        }
    }
    function get_product_info(){
        if(isset($_POST['item_Id'])){
            $id = $_POST['item_Id'];

            $con = connect_to_db();

            $query = $con->prepare('SELECT * FROM product WHERE ProductId = ? AND ProductStatus = "Available" LIMIT 1 ');

            $query->bind_param('s', $id);

            $query->execute(); 

            $result = $query->get_result();

            $data = $result->fetch_assoc();

            $query->close();
            $con->close();

            return $data;

        }

        
    }
    function get_images($path){
        $imgs = array();
        if(is_dir($path)){
            foreach(scandir($path) as $img ){
                if($img == '.' || $img == '..'){
                    continue;
                }
                array_push($imgs, $img);
            }
        }
        return $imgs;
    }

    function getCatsWithId($id){
        $res = array();
        $con = connect_to_db();
        $query = "SELECT * FROM category where IsDeleted = 0 ORDER BY CategoryId = '$id'  DESC, CategoryId ASC   ;";
        $result = mysqli_query($con, $query);
        $con->close();
        while($row = mysqli_fetch_assoc($result)){
            array_push($res, $row);
        }
        return $res;
    }
    function get_maincat_with_id($id){
        $con = connect_to_db();

        $query = "SELECT * FROM maincategory WHERE IsDeleted = 0 ORDER BY MainCategoryId = '$id' DESC, MainCategoryId ASC; ";

        $res = mysqli_query($con, $query );

        $cats = array();
        $con->close();
        if($res){
            while($row = mysqli_fetch_assoc($res)){
                array_push($cats, $row);
            }
        }
        return $cats;
    }
    function get_brands_with_id($id){
        $con = connect_to_db();

        $query = "SELECT * FROM brand WHERE IsDeleted = 0 ORDER BY BrandId = '$id' DESC, BrandId ASC; ";

        $res = mysqli_query($con, $query );

        $cats = array();
        $con->close();
        if($res){
            while($row = mysqli_fetch_assoc($res)){
                array_push($cats, $row);
            }
        }
        return $cats;
    }
?>