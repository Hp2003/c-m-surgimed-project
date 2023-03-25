<?php 
require_once('./src/connection.php');

    function category_product_handler(){
        if(isset($_POST['process_category_page'] )  ){
            if($_POST['process_category_page'] == 'get_page'){
                if(isset($_POST['CategoryId'])){
                    $con = connect_to_db();

                    $ans = array();

                    $html = file_get_contents('./views/admin_views/admin_view_product.php');

                    $sql = $con->prepare("SELECT p.* FROM product p JOIN category c ON p.CategoryId = c.CategoryId WHERE c.CategoryId = ?;");

                    $sql->bind_param('s', $_POST['CategoryId']);

                    $sql->execute();

                    $result = $sql->get_result();
                    while($row = $result->fetch_assoc()){
                        array_push($ans, $row);
                    }
                    $sql->close();
                    $con->close();

                    // $offset = 0;
                    // $_SESSION['numofcategory'] = get_num_of_records();

                    header('Content-Type: application/json');
                    $res= array(
                        'html' => $html,
                        'data' => $ans
                    );
                    echo json_encode($res);
                    return;
                }
                
            }
        }
    }
?>