<?php 
require_once('connection.php');
    function display_all_user(){
        if(isset($_POST['process_for_all_user_page'])){
            if($_POST['process_for_all_user_page'] ==  'get_ui'){
                header('Content-Type: application/json');
                // Read the contents of the HTML file
                $html = file_get_contents('./views/admin_views/list_all_user_view.php');
                $offset = $_POST['offset'];
                // $
                $resData = array(
                    'html' => $html,
                    'userData' => get_all_use_data( $offset)
                );
                echo json_encode($resData);
                return;
            }if($_POST['process_for_all_user_page'] ==  'loadMoreUser'){
                header('Content-Type: application/json');
                $offset = $_POST['offset'];

                $resData = array(
                    'userData' => get_all_use_data( $offset)
                );
                echo json_encode($resData);
                return;
            }if($_POST['process_for_all_user_page'] ==  'searchWithUserId'){
 
                if(isset($_POST['id'])){

                        header('Content-Type: application/json');
                        $resData = array(
                            'userData' => search_user($_POST['id'])
                        );
                        echo json_encode($resData);
                        return;
                }

            }
        }
    }
    function get_all_use_data( $offset){
        $con = connect_to_db();

        $sql = $con->prepare("SELECT users.UserName, FirstName, UserId, LastName, Gender, Email, corder.*, (SELECT COUNT(*) FROM corder WHERE CustomerId = users.UserId AND OrderStatus = 'Placed') AS order_count , (SELECT COUNT(*) FROM corder) AS total_order_count FROM users LEFT JOIN corder ON users.UserId = corder.CustomerId LIMIT 25 OFFSET ? ;");

        $sql->bind_param('s', $offset);

        $sql->execute();

        $result = $sql->get_result();

        
        
        $res = array();
        $end = false;
        $affected_rows = mysqli_num_rows($result);
        $sql->close();
        if($affected_rows >= 25){
            $end = true;
        }else{
            $end = false;
        }
        $con->close();
        while($row = mysqli_fetch_assoc($result)){
            array_push($res, $row);
        }
        array_push($res, $end);
        return $res;
    }
    function search_user( $user_id){
        
        $con = connect_to_db();
        $id = str_replace( '#!:', '',$user_id );

    $sql = $con->prepare("SELECT users.UserName, FirstName, UserId, LastName, Gender, Email, corder.*, 
    (SELECT COUNT(*) FROM corder WHERE CustomerId = users.UserId AND OrderStatus = 'Placed') AS order_count , 
    (SELECT COUNT(*) FROM corder) AS total_order_count 
    FROM users 
    LEFT JOIN corder ON users.UserId = corder.CustomerId 
    WHERE users.UserId = ? ");

    $sql->bind_param('s', $id);

    $sql->execute();

    $result = $sql->get_result();

    $sql->close();

    $con->close();
    return mysqli_fetch_assoc($result);
    }

?>