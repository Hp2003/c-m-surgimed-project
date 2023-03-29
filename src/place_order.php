<?php 
require_once('connection.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    function place_order(){
        if(isset($_SESSION['loggedIn'])){
                $item_ids = explode(',',$_POST['item_ids']);
                $itm_quantity = explode(',',$_POST['item_quentity']);
                // $grand_total = $_POST['grand_total'];
                $address = $_POST['address'];
                // $paymentMethod = $_POST['method'];
                $PhoneNumber = $_POST['phone_number'];

                

                $prices = array();
                for($i = 0 ; $i<count($item_ids) ; $i++){
                    $ans = check_quantity_available($item_ids[$i], $itm_quantity[$i]);
                    if($ans[0] == false){
                        header('Content-Type: application/json');
                        $res = array(
                            'text' => 'quantityIsNotAvilable',
                            'index' => $i
                        );
                        echo json_encode($res);
                        return;
                    }
                    array_push($prices, $ans[1]);
                }
                $total_price = array();

                for($i = 0 ; $i<count($prices) ; $i++){
                    $total = $prices[$i] * $itm_quantity[$i] ;
                    array_push($total_price,  $total);
                }
                insert_in_order_table($item_ids , $itm_quantity, $address, 'cod' , $PhoneNumber , $total_price );
                unset($_SESSION['cart']);
                header('Content-Type: application/json');
                $res = array(
                    'text' => 'placed'
                );
                echo json_encode($res);
                return;
                
        }else{
            header('Content-Type: application/json');
            $res = array(
                'text' => 'notLoggedin'
            );
            echo json_encode($res);
            return;
        }
    }
    function check_quantity_available($proId, $quantity){
        $sql = "SELECT QuantityOnHand, ProductPrice from product where ProductId = '$proId' LIMIT 1";

        $con = connect_to_db();

        $res = mysqli_query($con, $sql);

        $con -> close();
        if($res){
            $result = mysqli_fetch_assoc($res);
            $qoh = $result['QuantityOnHand'];
            $price = $result['ProductPrice'];

            return array($quantity <= $qoh, $price);
        }
    }
    function insert_in_order_table($item_ids, $itm_quantity, $address, $paymentMethod, $PhoneNumber, $total_price){
        $date = date("Y/m/d");
        $con = connect_to_db();
        for($i = 0 ; $i<count($total_price) ; $i ++){
            $sql = "INSERT INTO corder (CustomerId, TotalPrice , PlacedOn, OrderStatus, ProductId, Quantity, DeliveryAddress, PhoneNumber )
            VALUES('{$_SESSION['userId']}', '$total_price[$i]','$date', 'Placed','$item_ids[$i]' , '$itm_quantity[$i]' , '$address' , '$PhoneNumber' )";

            decrease_quantity($item_ids[$i], $itm_quantity[$i]);
            mysqli_query($con, $sql );
        }
        $con->close();
        

    }   
    function decrease_quantity($proId, $quantity){
        $con = connect_to_db();

        $sql = "UPDATE product SET QuantityOnHand = QuantityOnHand - '$quantity' WHERE ProductId = '$proId'";

        $res = mysqli_query($con , $sql);

        $con->close();

        return $res;
    }
?>