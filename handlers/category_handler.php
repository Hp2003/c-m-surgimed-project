<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    require_once('./src/display_add_product.php');
    require_once('./src/connection.php');

    function get_category_table(){
        if(isset($_POST['process'])){
            if($_POST['process'] == 'getView'){
                $html = file_get_contents('./views/admin_views/category_view.php');

                $_SESSION['limit'] = 0;

                header('Content-Type: application/json');
                $res= array(
                    'html' => $html,
                    'data' => display_categorys_with_limit(25),
                    'session' => $_SESSION['limit']
                );
                echo json_encode($res);
                return;
            }

        }
        
    }
    function display_categorys_with_limit($limit){
        $con = connect_to_db();

        $response = array();
        $query = "SELECT * FROM category LIMIT $limit OFFSET {$_SESSION['limit']} ";

        
        $res = mysqli_query($con, $query);
        
        $_SESSION['limit'] += 25;
        while($row = mysqli_fetch_assoc($res)){
            array_push($response, $row);
        }

        $con -> close();
        // unset($_SESSION['limit']);
        return $response;
    }
?>