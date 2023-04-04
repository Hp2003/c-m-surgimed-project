<?php 
    require_once('send_email.php');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // if(!isset($_SESSION['sendOrderDetails'])){
        //     $res = array(
        //         'text' => 'not allowed '
        //     );
        //     echo json_encode($res);
        //     return;
        // }
    // print_r($_SESSION['cart']);
function send_gen_order_email(){
    $email_text = "<!doctype html>
    <html lang='en'>
      <head>
        <title>Order details </title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
      </head>
      <body>
    <div class='container pagination-btn' style='min-height: 300px;'>
        <div class='row'>
            <div class='col-lg-12 text-center border rounded bg-light my-5'>
                <form action='' method='post' class='text-center searchCatForm'>
                    <h1>Order Details</h1>
                </form>
            </div>
            <div class='col-lg-9 container-fluid m-0' style='width:100%'>
                <table class='table'>
                    <thead>
                        <tr class='text-center'>
                            <th scope='col'>Serial No.</th>
                            <th scope='col'>Item Id</th>


                            
                            <th scope='col'>Item Name </th>
                            <th scope='col'>Item Quantity</th>
                            <th scope='col'>Price</th> 
                            <th scope='col'>Total</th> 
                        </tr>
                    </thead>";

$tableRows = "<tbody class='text-center tableBody'>";

$count = 1;
$grand_total = 0;
foreach($_SESSION['cart'] as $val){
    $totalPrice =  $val['Item_Price'] * $val['Item_Quantity'] ;
    // $displayTotal = "₹" . $val['Item_Price'] * $val['Item_Quantity'] ;
    $grand_total += $totalPrice;
    $tableRows .= "<tr>";
    $tableRows .= "<td><br>$count</td>";
    $tableRows .= "<td><br>$val[ItemId]</td>"; 

    $tableRows .= "<td><br>$val[Item_Name]</td>";
    $tableRows .= "<td><br>$val[Item_Quantity]</td>";
    $tableRows .= "<td><br>$val[Item_Price]</td>";
    $tableRows .= "<td> ₹ <br>$totalPrice</td>";
    $tableRows .= "</tr>";
    $count ++;
}
$tableRows .= "<hr>";
$tableRows .= "</tbody>";

$email_text .= $tableRows; // append $tableRows to $email_text
$formattedPrice = number_format($grand_total);
$email_text .= "
                    </tbody>
                </table>
            </div>
    
        </div>
    </div>
    <div class='container d-flex-row justify-content-center'>
        <h3>Total Price :- &#8377; $formattedPrice</h3> 
        <h3> UsrId :- $_SESSION[userId]</h3> 
        <h3>User Email :- $_SESSION[UserEmail]</h3> 
        <h3>Full Name :- $_SESSION[fname]</h3> 
        <h3>Phone No. :- $_SESSION[phno]</h3> 
        <h3>Full Name :- $_SESSION[fname]</h3> 
        <h3>Time :- $_SESSION[call_time]</h3> 
        <h3>Test Email For testing website</h3>
    </div>
    <h4></h4>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
      </body>
    </html>";
    // send_email('panchalhirenm123@gmail.com', $email_text);
    // unset($_SESSION['sendOrderDetails']);
    return 1;
}
    
?>