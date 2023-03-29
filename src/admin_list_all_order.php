    <?php 
    require_once('connection.php');
    function display_all_orders(){
        if($_POST['admin_order_page_process'] == 'get_order_page'){
            header('Content-Type: application/json');
            // Read the contents of the HTML file
            $html = file_get_contents('./views/admin_views/admin_order_view.php');
    
            $resData = array(
                'html' => $html,
                'orderData' => get_all_orders()
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
    function get_all_orders(){
         $con = connect_to_db();

         $sql = "SELECT * FROM corder ";

         $result = mysqli_query($con, $sql);

         $data = array();

         $con->close();

         while($row = mysqli_fetch_assoc($result)){
            array_push($data, $row);
         }
         return $data;
    }
?>