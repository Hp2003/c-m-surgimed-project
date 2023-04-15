<?php 
require_once('get_data_report_data.php');
require_once('get_data_for_graph.php');
require_once('./src/connection.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 function graph_gen_main(){
    $desicion = '';
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        include('./views/admin_views/report_page_views/graph_view.php');
    }else if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['process'])){
            if($_POST['process'] === 'get_main_categorys'){
                header('Content-Type: application/json');
                $res = array(
                    'data' => get_all_main_categorys()
                );
                echo json_encode($res);
                return ;
            }
            if($_POST['process'] === 'get_sub_categorys'){
                $id = $_POST['id'];
                header('Content-Type: application/json');
                $res = array(
                    'data' => get_sub_categorys($id)
                );
                echo json_encode($res);
                return ;
            }
            if($_POST['process'] === 'get_first_year'){
                header('Content-Type: application/json');
                $res = array(
                    'data' => get_first_year()
                );
                echo json_encode($res);
                return ;
            }
        }
        
        // Graph secion
        elseif(isset($_POST['graph_process'])){
            if($_POST['graph_process'] == 'get_normal_graph_data'){
                if(isset($_POST['normal_data'])){
                    $mainId = $_POST['main-main_category'] == "" ? NULL : $_POST['main-main_category'];
                    $subId = $_POST['main-sub_category']  == "" ? NULL : $_POST['main-sub_category'];
                    $productId = $_POST['main-product_id']  == "" ? NULL : $_POST['main-product_id'];
                    $userId = $_POST['main-user_id']  == "" ? NULL : $_POST['main-user_id'];
                    $year = $_POST['main-Year']  == "" ? NULL : $_POST['main-Year'];
                    $month = $_POST['main-Month']  == "" ? NULL : $_POST['main-Month'];
                    $type = $_POST['main-type']  == "" ? NULL : $_POST['main-type'];
                    $status = $_POST['main-Status']  == "" ? 'Placed' : $_POST['main-Status'];
                }else{
                    $mainId = $_POST['sub-main_category'] == "" ? NULL : $_POST['sub-main_category'];
                    $subId = $_POST['sub-sub_category']  == "" ? NULL : $_POST['sub-sub_category'];
                    $productId = $_POST['sub-product_id']  == "" ? NULL : $_POST['sub-product_id'];
                    $userId = $_POST['sub-user_id']  == "" ? NULL : $_POST['sub-user_id'];
                    $year = $_POST['sub-year']  == "" ? NULL : $_POST['sub-year'];
                    $month = $_POST['sub-month']  == "" ? NULL : $_POST['sub-month'];
                    $type = $_POST['main-type']  == "" ? NULL : $_POST['main-type'];
                    $status = $_POST['sub-status']  == "" ? 'Placed' : $_POST['sub-status'];
                }

                $desicion = desicionGenrator($mainId, $subId, $productId, $userId, $year, $month, $status);

                if($desicion == 'get_all_year_graph'){
                    $nyear =  substr($_SESSION['startYear'],0,4);
                    $years = yearsGenerator((int)$nyear);
                    $fullEndYeras = array();
                    $fullStartYear = array();
                    foreach($years as $val){
                        $endYear = $val . '-12-31 23:59:59';
                        $startYear = $val . '-01-01 00:00:00';
                        array_push($fullEndYeras, $endYear);
                        array_push($fullStartYear, $startYear);
                    }
                    // getting main data
                    $finalArray = array();
                    $count = 0;
                    if(!empty($productId)){
                        foreach($fullEndYeras as $val){
                            // final data
                            array_push($finalArray, get_yearly_data(null, $fullStartYear[$count], $val, $status, $productId, $userId, null ));
                            $count ++;
                        }
                    }else{
                        foreach($fullEndYeras as $val){
                            // final data
                            array_push($finalArray, get_yearly_data($subId, $fullStartYear[$count], $val, $status, $productId, $userId, $mainId ));
                            $count ++;
                        }
                    }

                    header('Content-Type: application/json');
                    $res = array(
                        'data' => $finalArray,
                        'years' => $years
                    );
                    echo json_encode($res);
                    return ;


                }elseif($desicion == 'get_all_month_graph'){
                    // $month = (int)substr($year, 5,2);
                    $allMonths = montGenerator($year);
                    $finalArray = [];
                    if(empty($productId)){
                        for($i = 0 ; $i<count($allMonths[0]) ; $i++ ){
                            array_push($finalArray, get_yearly_data($subId, $allMonths[0][$i], $allMonths[1][$i], $status, $productId, $userId, $mainId ));
                        }
                    }else{
                        for($i = 0 ; $i<count($allMonths[0]) ; $i++ ){
                            array_push($finalArray, get_yearly_data(null, $allMonths[0][$i], $allMonths[1][$i], $status, $productId, $userId, null ));
                        }
                    }
                    $res = array(
                        'data' => $finalArray,
                        'labels' => $allMonths
                    );
                    // getting data for each month

                    echo json_encode($res);
                    return ;
                }elseif($desicion == 'get_all_in_one_month'){
                    // $month = (int)substr($year, 5,2);
                    $newYear = substr($year, 0,4);
                    // $newMonth = (int)substr($year,5,2 );
                    $startMonth = "$newYear-$month-01 00:00:00";
                    $last_day_of_month = date('t', strtotime("$newYear-$month-01"));
                    $endMonth = "$newYear-$month-$last_day_of_month 23:59:59";
                    $finalArray = array();
                    if(empty($productId)){
                            array_push($finalArray, get_graph_data($mainId,$status, $startMonth, $endMonth, $subId, $productId, $userId ));
                    }else{
                            array_push($finalArray, get_graph_data(null,$status, $startMonth, $endMonth, null, $productId, $userId));
                    }
                    $res = array(
                        'data' => $finalArray
                    );

                    echo json_encode($res);
                    return ;
                }
            }
        }
    }
 }
function get_first_year(){
    $con = connect_to_db();
    
    $sql = "SELECT PlacedOn from corder LIMIT 1";
    
    $res = $con->query($sql);
    $con->close();
    $year = mysqli_fetch_assoc($res)['PlacedOn'];
    $_SESSION['startYear'] = $year;
    return $year;
}
function desicionGenrator($mainId, $subId, $productId, $userId, $year, $month){
    if($year != null && $month == null){
        return 'get_all_month_graph';
    }
    if($year == null ){
        return 'get_all_year_graph';
    }
    if($year != null && $month != null){
        return 'get_all_in_one_month';
    }

}

function yearsGenerator($startyear){
    $year = $startyear;
    $res = array();
    while ((int)$year <= (int)date('Y')){
        array_push($res, $year);
        $year++;
    }
    return $res;
}

function montGenerator($fullDate){
    $year = (int)substr($fullDate, 0,4);
    $month = (int)substr($fullDate, 5,2);
    $lastMonth = 12;
    // changing to current month if year is same
    if($year == (int)Date('Y')){
        $lastMonth = (int)Date('m');
    }
    $startMonth = array();
    $endMonth = array();
    // $res = array();
    while($month <= $lastMonth){
        $last_day_of_month = date('t', strtotime("$year-$month-01"));
        $startDate = "$year-$month-01 00:00:00";
        $endDate = "$year-$month-$last_day_of_month 23:59:59";

        array_push($startMonth,$startDate);
        array_push($endMonth, $endDate);
        $month ++;
    }
    return array($startMonth, $endMonth);
}
?>