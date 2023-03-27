<?php 
    require_once('./src/common_function.php');

    function search(){
        $data = search_product();
        

        $imgs = array();
        
        // getting product  images
        foreach($data as $val){
            array_push( $imgs, $val['ProductImg'] . '/' .scandir($val['ProductImg'])[2]);
        }
        
        $data['imgs'] = $imgs;
        header('Content-Type: application/json');
        echo json_encode($data);
        return;
    }
    
    
    
?>