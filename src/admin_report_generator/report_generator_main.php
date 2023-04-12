<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once('get_data_report_data.php');
    function gen_report_main(){
        if(isset($_POST['process'])){
            if($_POST['process'] === 'get_main_categorys'){
                header('Content-Type: application/json');

                $res = array( 
                    'data' => get_all_main_categorys()
                );
                echo json_encode($res);
                return;
            }
            if($_POST['process'] === 'get_sub_categorys'){
                header('Content-Type: application/json');

                $res = array( 
                    'data' => get_sub_categorys($_POST['mainId'])
                );
                echo json_encode($res);
                return;
            }
            if($_POST['process'] === 'start_page'){
                header('Content-Type: application/json');
                $main_cats = get_all_main_categorys();

                $Details = array();
                foreach($main_cats as $row){
                    array_push($Details,get_sum_of_category($row['MainCategoryId'], 'Placed', '2022-03-01 02:26:20', '2023-03-27 21:08:39'));
                }
                $res = array( 
                    'data' => $Details,
                    'data1' => get_sum_of_category(null, 'Placed', '2022-03-01 02:26:20', '2023-03-27 21:08:39')
                );
                echo json_encode($res);
                return;
            }
            if($_POST['process'] === 'get_data'){
                // null if want default value
                $mainId = $_POST['main_category'] == "" ? NULL : $_POST['main_category'];
                $subId = $_POST['sub_category']  == "" ? NULL : $_POST['sub_category'];
                $productId = $_POST['product_id']  == "" ? NULL : $_POST['product_id'];
                $userId = $_POST['user_id']  == "" ? NULL : $_POST['user_id'];
                $startTime = $_POST['start_time']  == "" ? NULL : $_POST['start_time'];
                $endTime = $_POST['end_time']  == "" ? NULL : $_POST['end_time'];
                $status = $_POST['status']  == "" ? 'Placed' : $_POST['status'];
                @$offset = $_POST['offset'] ;

                // making desicion based on input
                $res = array();
                $res1 = array();
                $desicion = desicion_maker($mainId ,  $subId, $productId, $userId);
                $_SESSION['current_desicion'] = $desicion;
                // only subcategorys under main category
                if($desicion == 'main_with_rows'){
                    $subs = get_sub_categorys($mainId);

                    foreach($subs as $row){
                        array_push($res1, get_sum_of_category($mainId , $status, $startTime, $endTime, $row['CategoryId'], $productId, $userId, $offset) );
                    }
                    array_push($res, get_sum_of_category($mainId , $status, $startTime, $endTime, null, $productId, $userId));
                }
                // ***************************************************** //
                if($desicion == 'sub_with_rows'){
                    // getting summery first time only
                    if(!empty($_POST['get_summery']) ){
                        $subs = get_all_productids($subId);

                        foreach($subs as $row){
                            array_push($res, get_sum_of_category(null , $status, $startTime, $endTime, null, $row['ProductId'], $userId));
                        }
                    }

                    array_push($res1, get_details($mainId , $status, $startTime, $endTime, $subId, $productId, $userId, $offset) );
                }
                if($desicion == 'product_with_id'){
                    // getting summery first time only
                    if(!empty($_POST['get_summery']) ){
                        // $subs = get_all_productids($subId);
                            array_push($res, get_sum_of_category(null , $status, $startTime, $endTime, null, $productId, $userId));
                    }

                    array_push($res1, get_details(null , $status, $startTime, $endTime, null, $productId, $userId, $offset) );
                }

                if($desicion == 'default_view'){
                    header('Content-Type: application/json');
                $main_cats = get_all_main_categorys();

                $Details = array();
                foreach($main_cats as $row){
                    array_push($Details,get_sum_of_category($row['MainCategoryId'], $status,$startTime, $endTime, null,null, $userId ));
                }
                $res = array( 
                    'data' => get_sum_of_category(null, $status,  $startTime, $endTime, null,null, $userId),
                    'data1' => $Details,
                    'desicion' => $desicion
                );
                echo json_encode($res);
                return;
                }
                header('Content-Type: application/json');
                $data = array(
                    'data' => $res,
                    'data1' => $res1,
                    'desicion' => $desicion
                );
                echo json_encode($data);
                return;
                
            }
        }
    }
    function desicion_maker($mainId, $subId, $productId, $userId){
        if(trim($productId) != '' && $productId != null  ){
            return 'product_with_id';
        }
        if($mainId != null && $subId == NULL ){
            return 'main_with_rows';
        }
        elseif($mainId != null && $subId != NULL ){
            return 'sub_with_rows';
        }
        elseif($mainId == null && $subId == NULL && $productId == null ){
            return 'default_view';
        }
        
    }
?>