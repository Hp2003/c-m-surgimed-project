<?php 
require_once('connection.php');
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
    function search_by_category(){
        $con = connect_to_db();
        if(isset($_POST['process'])){
            if($_POST['process'] == 'loadFistTime'){
                $catId = $_POST['categoryId'];
                $offset = $_POST['offset'];

                $_SESSION['catId'] = $catId;
                header('Content-Type: application/json');
                $data = searchProduct($catId, $offset);
                $response = array(
                    'text' => $data
                );

                echo json_encode($response);
                return ;
            }
            if($_POST['process'] == 'pagination'){
                
                header('Content-Type: application/json');
                $response = array(
                    'text' => searchProduct($_SESSION['catId'], $_POST['offset'])
                );
                echo json_encode($response);
                return ;
            }
            
        }


    }
    function searchProduct($catId, $offset){
        $con = connect_to_db();


        $sql = $con -> prepare("SELECT * FROM product WHERE CategoryId = ? AND ProductStatus = 'Available' LIMIT 16 OFFSET ?");

        $sql->bind_param('ss', $catId, $offset);

        $sql->execute();

        $result = $sql->get_result();

        $res = array();

        $imgs = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($res, $row);
            array_push($imgs,scandir($row['ProductImg'])[2]);
        }

        array_push($res, $imgs);

        return $res;
    }
?>