<?php
require_once('connection.php');

    function show_details_page(){
        header('Content-Type: application/json');
        // Read the contents of the HTML file
        $html = file_get_contents('./views/productDetailsView.php');
        $details = get_product_details();
        $data = array(
            'html' => $html,
            'details' =>  $details
        );
        echo json_encode($data);
        return;
    }
    function get_product_details(){
        if(isset($_POST['productId'])){
            $con = connect_to_db();


            $sql = $con->prepare("SELECT * FROM product WHERE ProductId = ? LIMIT 1");

            $sql->bind_param('s', $_POST['productId']);

            $sql->execute();

            $res = $sql->get_result();

            $output = $res->fetch_assoc();


            $path = $output['ProductImg'] . '/';
            $imgs = scandir($path);

            
            array_splice($imgs, 0, 2);
            
            foreach($imgs as &$str){
               $str =  $path . $str;
            }
            unset($str);
            // $imgs = array_map(function($str){
            //     return $output['ProductImg'] . '/' . $str;
            // }, $imgs);


            $output['imgs'] = $imgs;

            return $output;
        }
    }
?>

