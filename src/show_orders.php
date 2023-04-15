<?php 
require_once('connection.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    function show_orders(){
        if(isset($_SESSION['loggedIn'])){
            
            if(isset($_POST['order_page_process'])){
                if($_POST['order_page_process'] == 'get_order_page'){
                    header('Content-Type: application/json');
                    // Read the contents of the HTML file
                    $html = file_get_contents('./views/order_view.php');
            
                    $resData = array(
                        'html' => $html,
                        'orderData' => get_orders()
                    );
                    echo json_encode($resData);
                    return;
                }
                if($_POST['order_page_process'] == 'cancel_order'){
                    if(isset($_POST['OrderId'])){
                        cancelOrder();
                    }
                }
            }
        }

    }
    function get_orders(){
        $con = connect_to_db();
        $response = array();

        // $sql = "SELECT corder.OrderId, product.ProductTitle , corder.* FROM corder JOIN product ON corder.ProductId = product.ProductId WHERE corder.CustomerId = '{$_SESSION['userId']} ' DESC;";
        $sql = "SELECT corder.OrderId, product.ProductTitle, corder.* 
        FROM corder 
        JOIN product ON corder.ProductId = product.ProductId 
        WHERE corder.CustomerId = '{$_SESSION['userId']}' 
        ORDER BY corder.OrderId DESC ";

        $res = mysqli_query($con , $sql);
        $con->close();
        while($row = mysqli_fetch_assoc($res)){
            array_push($response, $row);
        }
        return $response;
    }
    function cancelOrder(){
        $orderId = $_POST['OrderId'];

        $con = connect_to_db();

        $sql = "UPDATE corder SET OrderStatus = 'Cancel Request' WHERE OrderId = '$orderId' AND CustomerId = '{$_SESSION['userId']}' LIMIT 1";
        
        $res = mysqli_query($con, $sql);
        
        $con->close();

        if($res){
            header('Content-Type: application/json');
            // Read the contents of the HTML file
    
            $resData = array(
                'text' => 'canelled'
            );
            echo json_encode($resData);
            return;
        }

    }
?>