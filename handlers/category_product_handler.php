<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('./src/connection.php');
require_once('category_handler.php');
require_once('./src/deleteProduct.php');

    function category_product_handler(){
        if(isset($_POST['process_category_page'] )  ){
            if($_POST['process_category_page'] == 'get_page'){
                if(isset($_POST['CategoryId'])){


                    $html = file_get_contents('./views/admin_views/admin_view_product.php');

                    $_SESSION['CategoryId'] = $_POST['CategoryId'];

                    $ans = get_data($_POST['CategoryId'], 0);

                    $_SESSION['currentOffset'] = 0;


                    header('Content-Type: application/json');
                    $res= array(
                        'html' => $html,
                        'data' => $ans,
                        'totalRecords' => get_rows($_POST['CategoryId'])
                    );
                    echo json_encode($res);
                    return;
                }else{
                    header('Content-Type: application/json');
                    $res= array(
                        'text'=> 'setId'
                    );
                    echo json_encode($res);
                }
            }elseif($_POST['process_category_page'] == 'LoadMoreProducts'){
                
                $_SESSION['currentOffset'] += 20;


                $ans = get_data($_SESSION['CategoryId'], $_SESSION['currentOffset'] );

                $res = array(
                    'data' => $ans,
                    'finalRecordIndex' => ($_SESSION['currentOffset'] ),
                    'offset' => $_SESSION['currentOffset'] 
                );

                echo json_encode($res);
                return;
                
            }elseif($_POST['process_category_page'] == 'SearchRecords'){

                $_SESSION['currentOffset'] = 0;
                $ans = get_data($_POST['category_name'], $_SESSION['currentOffset'] );

                $res = array(
                    'data' => $ans,
                    'finalRecordIndex' => ($_SESSION['currentOffset'] ),
                    'totalRecords' => get_rows($_POST['category_name'])
                );
                $_SESSION['currentOffset'] = 0;
                unset($_POST['category_name']);
                echo json_encode($res);
                return;
                
            }elseif($_POST['process_category_page'] == 'update_product'){

                $con = connect_to_db();

                $query = $con->prepare("  UPDATE product SET ProductPrice = ? , QuantityOnHand = ? WHERE ProductId = ? LIMIT 1");

                $query->bind_param('sss', $_POST['Price'], $_POST['QOH'], $_POST['productId']);

                $result = $query-> execute();

                $con->close();
                $query->close();

                if($result){
                    $res = array(
                        'text' => 'productUpdated'
                    );
                    echo json_encode($res);
                    return;
                }
                
                
            }elseif($_POST['process_category_page'] == 'delete_product'){
                $con = connect_to_db();

                $query = $con->prepare("  SELECT ProductImg FROM product WHERE ProductId = ? LIMIT 1");

                $query->bind_param('s', $_POST['productId']);

                $query-> execute();

                $result = $query->get_result();

                $result = mysqli_fetch_assoc($result)['ProductImg'];

                $query->close();


                if(delte_files($result)){

                    $delQuery = $con->prepare('UPDATE  product  SET ProductStatus = "Deleted" WHERE ProductId = ?');

                    $delQuery->bind_param('s', $_POST['productId']);

                    if( $delQuery-> execute()){
                        $delQuery->close();
                        $con->close();
                        
                        $res = array(
                            'text' => 'productDeleted'
                        );
                        echo json_encode($res);
                        return;
                    }else{
                        $con->close();
                        $delQuery->close();
                        
                    }
                    

                }
                
            }
        }
    }
    function get_data($id, $offset){

        $con = connect_to_db();
        if(isset($_POST['category_name'])){
            $sql = $con->prepare("SELECT p.*, c.CategoryName FROM product p JOIN category c ON p.CategoryId = c.CategoryId WHERE c.CategoryName = ?  LIMIT 20 OFFSET $offset ");
        }else{
            $sql = $con->prepare("SELECT p.*, c.CategoryName FROM product p JOIN category c ON p.CategoryId = c.CategoryId WHERE c.CategoryId = ? LIMIT 20 OFFSET $offset");
        }

        $ans = array();

        // $_SESSION['currentOffSet'] += 20;

        $sql->bind_param('s', $id);

        $sql->execute();

        $records = mysqli_affected_rows($con);

        $result = $sql->get_result();
        while($row = $result->fetch_assoc()){
            array_push($ans, $row);
        }
        array_push($ans, array('rowsRecived' => $records));
        $sql->close();
        $con->close();
        
        return $ans;
    }
   function get_rows($id){
    $conn = connect_to_db();

    // create the query string
    if(isset($_POST['category_name'])){
        $query = "    SELECT SQL_CALC_FOUND_ROWS *
        FROM product
        WHERE CategoryId = (
          SELECT CategoryId
          FROM category
          WHERE CategoryName = '$id'
        );";
    }else{
        $query = "SELECT SQL_CALC_FOUND_ROWS *
        FROM product
        WHERE CategoryId = '$id'";
    }


    // execute the query using your database connection
    $result = mysqli_query($conn, $query);

    // get the number of rows in the result set
    $num_rows = mysqli_num_rows($result);

    // get the total number of rows in the table
    $query = "SELECT FOUND_ROWS()";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $total_rows = $row[0];  

    $conn->close();

    // calculate the number of rows not in the result set
    $other_rows = $total_rows - $num_rows;

    // handle the results as needed
    return $row;
   }
?>