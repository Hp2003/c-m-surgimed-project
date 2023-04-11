    <?php 
    require_once('connection.php');
    function display_all_orders(){
        if($_POST['admin_order_page_process'] == 'get_order_page'){
            header('Content-Type: application/json');
            // Read the contents of the HTML file
            $html = file_get_contents('./views/admin_views/admin_order_view.php');
    
            $resData = array(
                'html' => $html,
                'orderData' => get_all_orders($_POST['offset'])
            );
            echo json_encode($resData);
            return;
        }
        if($_POST['admin_order_page_process'] == 'placeOrder'){
            if(isset($_POST['OrderId'])){
                header('Content-Type: application/json');
                echo json_encode(array( 'text' => orderHnalder($_POST['OrderId'] , 'Placed')));


                return;
            }
        }
        elseif($_POST['admin_order_page_process'] == 'cancelOrder'){
            if(isset($_POST['OrderId'])){
                header('Content-Type: application/json');
                echo json_encode(array( 'text' => orderHnalder($_POST['OrderId'] , 'Cancelled')));

                return;
            }
        }
    }
    function get_all_orders($offset){
         $con = connect_to_db();
         $orderStatus = null ;
         $search = null;
        if($_POST['orderStatus'] === 'Default'){
            $orderStatus = null;
        }
        else{
            $orderStatus = $_POST['orderStatus'];
        }
        // $orderStatus = $_POST['orderStatus'];
        if(!empty($_POST['search']) && $_POST['search'] != "null"){
            $search = $_POST['search'];
        }

        //  $orderStatus = 'Pending';
         $sql = $con->prepare("SET @var = CONVERT(? USING utf8mb4);");
         $sql->bind_param('s', $orderStatus);
         $sql->execute();

         $sql2 = $con->prepare("SET @searchId = CONVERT(? USING utf8mb4);");
         $sql2->bind_param('s', $search);
         $sql2->execute();

        $sql = $con->prepare("

        SELECT *
        FROM corder
        WHERE (@searchId IS NOT NULL AND CustomerId = @searchId AND (@var IS NULL OR OrderStatus = @var))
        OR (@var IS NOT NULL AND OrderStatus = @var AND (@searchId IS NULL OR CustomerId = @searchId))
        OR (@var IS NULL AND @searchId IS NULL)
        ORDER BY PlacedOn DESC
        LIMIT 50 OFFSET ? ;");

        $sql->bind_param('i', $offset);
        $sql->execute();
     
         $result = $sql->get_result();
         
         $data = array();
         $sql->close();
         $con->close();

         while($row = mysqli_fetch_assoc($result)){
            array_push($data, $row);
         }
         return $data;
        }

        function orderHnalder($id, $status){
            $con = connect_to_db();
            if (!$con) {

            }
            $id = intval($id);

            $sql = $con->prepare("UPDATE corder SET OrderStatus = ? WHERE OrderId = ? LIMIT 1");

            $sql->bind_param('ss', $status, $id);

            if (!$sql->execute()) {
                echo "Error updating order status: " . $sql->errno . " - " . $sql->error;
            } else {
                if(mysqli_affected_rows($con) > 0){

                    $con->close();
                    return 1;
                }
            }
            // header('Content-Type: text/plain');
            // echo mysqli_affected_rows($con);
            // return;1
            $con->close();
            return 0;
        }

        ?>