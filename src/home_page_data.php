<?php 
    require ('connection.php');
    function get_home_page_ui_data(){
        $productArray = get_product();
        // getting images
        $proimages = array_column(array_filter($productArray, function($product){
            return isset($product['ProductImg']);
        }),'ProductImg');
        
        $images = get_product_images($proimages);
        $response = array(
            'Categorys' => get_categorys(),
            'Products' => get_product(),
            'Images' => $images
        );
        // header('Content-Type: image/*');
        header('Content-Type: multipart/form-data');
        echo json_encode($response);
        return;
    }
    
    function get_categorys(){
        $conn = connect_to_db();
        $query = "SELECT * FROM category ";
        $result = mysqli_query($conn, $query);
        
        $rows = array();

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $conn -> close();

        return $rows;
        
    }
    function get_product(){
        $conn = connect_to_db();
        $query = "SELECT ProductId, ProductTitle, ProductDesc, ProductPrice, QuantityOnHand, ProductImg FROM product LIMIT 10 ";
        $result = mysqli_query($conn, $query);
        
        $rows = array();

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $conn -> close();

        return $rows;
    }
    function get_product_images($paths){
        $images = array();
        $imageType = 'image/*';
        // getting images from path
        foreach($paths as $val){
            $files = array_diff(scandir($val), array('.', '..'));
            // array_push($images, new CURLFile($files[2], $imageType));
            array_push($images, $files[2]);
        }
        return $images;
    }

    
?>