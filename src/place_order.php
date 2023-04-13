<?php 
require_once('connection.php');
require_once('genrate_email.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    function place_order(){
        if(isset($_SESSION['loggedIn'])){
                $item_ids = explode(',',$_POST['item_ids']);
                $itm_quantity = explode(',',$_POST['item_quentity']);
                $address = $_POST['address'];
                $PhoneNumber = $_POST['phone_number'];
                $_SESSION['call_time'] = $_POST['time'];
                $_SESSION['fname'] = $_POST['fname'];
                $_SESSION['phno'] = $PhoneNumber;

                

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
                if(send_gen_order_email()){
                    unset($_SESSION['cart']);
                    header('Content-Type: application/json');
                    $res = array(
                        'text' => 'placed'
                    );
                    echo json_encode($res);
                return;
                }
                

                // header('Content-Type: application/json');
                // $res = array(
                //     'text' => 'placed'
                // );
                // echo json_encode($res);
                // return;
                
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
            $avialable = $quantity <= $qoh;
            return array($avialable, $price);
        }
    }
    function insert_in_order_table($item_ids, $itm_quantity, $address, $paymentMethod, $PhoneNumber, $total_price){
        $date = date("Y/m/d");
        $con = connect_to_db();
        for($i = 0 ; $i<count($total_price) ; $i++){
            $sql = "INSERT INTO corder (CustomerId, TotalPrice , PlacedOn, OrderStatus, ProductId, Quantity, DeliveryAddress, PhoneNumber,Price )
            VALUES('{$_SESSION['userId']}', '$total_price[$i]','$date', 'Pending','$item_ids[$i]' , '$itm_quantity[$i]' , '$address' , '$PhoneNumber' , '{$_SESSION['cart'][$i]['Item_Price']}')";

            // decrease_quantity($item_ids[$i], $itm_quantity[$i]);
            mysqli_query($con, $sql );
        }
        $con->close();
        
        return 1;
    }   
    function decrease_quantity($proId, $quantity){
        $con = connect_to_db();

        $sql = "UPDATE product SET QuantityOnHand = QuantityOnHand - '$quantity' WHERE ProductId = '$proId'";

        $res = mysqli_query($con , $sql);

        $con->close();

        return $res;
    }
?>