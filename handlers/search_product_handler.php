<?php 
    require_once('./src/common_function.php');

    function search(){
        $data = search_product();
        
        if(empty($data) ){

            header('Content-Type: application/json');
            $resData = array(
                'text' => 'couldNotFind'
            );
            echo json_encode($data);
            return;
        }
        $imgs = array();
        
        // getting product  images
        foreach($data as $val){
            array_push( $imgs, $val['ProductImg'] . '/' .scandir($val['ProductImg'])[2]);
        }
        
        $data['imgs'] = $imgs;
        unset($_SESSION['rowsAffected']);
        header('Content-Type: application/json');
        echo json_encode($data);
        return;
    }
    
    
    
?>