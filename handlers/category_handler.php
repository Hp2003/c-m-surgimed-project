<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('./src/deleteProduct.php');
require_once('./src/add_product.php');

    require_once('./src/display_add_product.php');
    require_once('./src/connection.php');

    function get_category_table(){
        $html = file_get_contents('./views/admin_views/category_view.php');
        if(isset($_POST['process'])){
            if($_POST['process'] == 'getView'){

                unset($_POST['process'] );
                $offset = 0;
                $_SESSION['numofcategory'] = get_num_of_records('category');
                header('Content-Type: application/json');
                $res= array(
                    'html' => $html,
                    'data' => display_categorys_with_limit(25, $offset),
                    'records' => get_num_of_records('category'),
                    'offset' => $offset
                );
                echo json_encode($res);
                return;
            }if($_POST['process'] == 'get_more_data'){
                $html = file_get_contents('./views/admin_views/category_view.php');

                // $start = $_SESSION['offset'] ;
                $start =  $_POST['number'] * 25;
                
                header('Content-Type: application/json');
                $res= array(
                    'html' => $html,
                    'data' => display_categorys_with_limit(25, $start),
                    'records' => $_SESSION['numofcategory'],
                    'offset' => $_SESSION['offset']
                );

                echo json_encode($res);
                return;
            }if($_POST['process'] == 'delete_cat'){

                if(delte_category($_POST['CategoryId'])){
                    header('Content-Type: application/json');
                    $res = array(
                        'html' => $html,
                        'text' => 'cateGoryDeleted',
                        'offset' => $_SESSION['offset']
                    );
                    echo json_encode($res);
                    return;
                }
            }if($_POST['process'] == 'add_cat'){
                if(isset($_POST['catName'])){

                    $name = $_POST['catName'];

                    if(strlen($name) <= 100){

                        $response = create_category($name);

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
    function display_categorys_with_limit($limit, $offset){
        $con = connect_to_db();
        // $con = mysqli_connect('localhost', 'root', 'panchal4555', 'login');

        $response = array();
        $query = "SELECT * FROM category LIMIT $limit OFFSET $offset ";
        
        $res = mysqli_query($con, $query);
        
        while($row = mysqli_fetch_assoc($res)){

            array_push($response, $row);
        }

        $con -> close();
        $_SESSION['offset'] = $offset;
        return $response;

    }
    function get_num_of_records($table_name){
        $con = connect_to_db();

        // $con = mysqli_connect('localhost', 'root', 'panchal4555', 'login');

        $analyze_query = $con->prepare("ANALYZE TABLE $table_name;");
        $analyze_query->execute();
        $analyze_query->store_result();
        $analyze_query->close();

        $query = "SELECT TABLE_ROWS FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'c_m_surgimed' AND TABLE_NAME = '$table_name';";

        
        $res = mysqli_query($con, $query);
        

        
        $total_rows = mysqli_fetch_assoc($res)['TABLE_ROWS'];

        
        $con -> close();

        return $total_rows;
    }
    function delte_category($id){
        $con = connect_to_db();

        $response = array();

        $query = $con->prepare("SELECT product.* FROM product JOIN category ON product.CategoryId = category.CategoryId WHERE category.CategoryId = ?");
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
                $sql = "DELETE FROM product WHERE ProductId = '{$row['ProductId']}'";
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
        $delCat = $con->prepare("DELETE FROM category WHERE CategoryId = ? ;");

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
?>