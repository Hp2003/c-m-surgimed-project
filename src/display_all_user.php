<?php 
require_once('connection.php');
    function display_all_user(){
        if(isset($_POST['process_for_all_user_page'])){
            if($_POST['process_for_all_user_page'] ==  'get_ui'){
                header('Content-Type: application/json');
                // Read the contents of the HTML file
                $html = file_get_contents('./views/admin_views/list_all_user_view.php');
                $offset = $_POST['offset'];
                if(isset($_POST['order'])){
                    $order = $_POST['order'];
                }else{
                    $order = 'old';
                }
                // $
                $resData = array(
                    'html' => $html,
                    'userData' => get_all_use_data( $offset, $order)
                );
                echo json_encode($resData);
                return;
            }if($_POST['process_for_all_user_page'] ==  'loadMoreUser'){
                header('Content-Type: application/json');
                $offset = $_POST['offset'];
                $order = $_POST['order'];

                $resData = array(
                    'userData' => get_all_use_data( $offset, $order)
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

            }if($_POST['process_for_all_user_page'] ==  'searchWithUserName'){
                if(isset($_POST['id'])){
                    
                    header('Content-Type: application/json');
                    $resData = array(
                        'userData' => search_with_name($_POST['id'], $_POST['offset'])
                    );
                    echo json_encode($resData);
                    return;
                }
            }
            if($_POST['process_for_all_user_page'] ==  'DeleteUser'){
                if(isset($_POST['uid'])){
                    
                    header('Content-Type: application/json');
                    $resData = array(
                        'userData' => removeUser($_POST['uid'])
                    );
                    echo json_encode($resData);
                    return;
                }
            }
            if($_POST['process_for_all_user_page'] ==  'reopenaccount'){
                if(isset($_POST['uid'])){
                    
                    header('Content-Type: application/json');
                    $resData = array(
                        'userData' => re_open_account($_POST['uid'])
                    );
                    echo json_encode($resData);
                    return;
                }
            }
        }
    }
    function get_all_use_data( $offset, $order = 'old'){
        $con = connect_to_db();
        if($order == 'new'){
            $sql = $con->prepare("SELECT
            users.UserName,
            FirstName,
            UserId,
            LastName,
            Gender,
            Email,
            IsDeleted,
            `JoinedAt`,
            corder.*,
            COUNT(corder.OrderId) AS order_count
        FROM users
        LEFT JOIN corder ON users.UserId = corder.CustomerId AND corder.OrderStatus = 'Placed'
        GROUP BY users.UserName, FirstName, UserId, LastName, Gender, Email, IsDeleted, JoinedAt
        ORDER BY JoinedAt DESC
        LIMIT 25 
        OFFSET ?;");
        }if($order == 'old'){
            $sql = $con->prepare("SELECT
            users.UserName,
            FirstName,
            UserId,
            LastName,
            Gender,
            Email,
            IsDeleted,
            `JoinedAt`,
            corder.*,
            COUNT(corder.OrderId) AS order_count
        FROM users
        LEFT JOIN corder ON users.UserId = corder.CustomerId AND corder.OrderStatus = 'Placed'
        GROUP BY users.UserName, FirstName, UserId, LastName, Gender, Email, IsDeleted, JoinedAt
        ORDER BY JoinedAt 
        LIMIT 25
        OFFSET ?;
        ");

        }if($order == 'deleted'){
            $sql = $sql = $con->prepare("SELECT
            users.UserName,
            FirstName,
            UserId,
            LastName,
            Gender,
            Email,
            IsDeleted,
            `JoinedAt`,
            corder.*,
            COUNT(corder.OrderId) AS order_count
        FROM users
        LEFT JOIN corder ON users.UserId = corder.CustomerId AND corder.OrderStatus = 'Placed' 
        WHERE  users.IsDeleted = 1
        GROUP BY users.UserName, FirstName, UserId, LastName, Gender, Email, IsDeleted, JoinedAt
        ORDER BY JoinedAt DESC
        LIMIT 25
        OFFSET ?;");

        }

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
        if(preg_match('/^#!:\d+$/', $user_id)){
            $con = connect_to_db();
            $id = str_replace( '#!:', '',$user_id );
            
            $sql = $con->prepare("SELECT
            users.UserName,
            FirstName,
            UserId,
            LastName,
            Gender,
            Email,
            IsDeleted,
            `JoinedAt`,
            corder.*,
            COUNT(corder.OrderId) AS order_count
        FROM users
        LEFT JOIN corder ON users.UserId = corder.CustomerId AND corder.OrderStatus = 'Placed' 
        WHERE  users.UserId = ?
        GROUP BY users.UserName, FirstName, UserId, LastName, Gender, Email, IsDeleted, JoinedAt");
            
            $sql->bind_param('s', $id);
            
            $sql->execute();
            
            $result = $sql->get_result();
            
            $sql->close();
            
            $con->close();
            $affected_rows = mysqli_num_rows($result);
            if($affected_rows <= 0 ){
                return 'UserNotFound';
            }
            return mysqli_fetch_assoc($result);   
        }
        
        
    }
    function search_with_name($user_name, $offset){
        $con = connect_to_db();
        $input = '%'.$user_name.'%';
        
        $sql = $con->prepare("SELECT
        users.UserName,
        FirstName,
        UserId,
        LastName,
        Gender,
        Email,
        IsDeleted,
        `JoinedAt`,
        corder.*,
        COUNT(corder.OrderId) AS order_count
    FROM users
    LEFT JOIN corder ON users.UserId = corder.CustomerId AND corder.OrderStatus = 'Placed' 
    WHERE  users.UserName LIKE ?
    GROUP BY users.UserName, FirstName, UserId, LastName, Gender, Email, IsDeleted, JoinedAt
        LIMIT 25 OFFSET ? ");
        
        $sql->bind_param('ss', $input, $offset);
        
        $sql->execute();
        
        $result = $sql->get_result();
        
        $sql->close();
        
        $con->close();
        $affected_rows = mysqli_num_rows($result);
        if($affected_rows <= 0 ){
            return "UserNotFound";
        }
        if($affected_rows >= 25){
            $end = true;
        }else{
            $end = false;
        }
        $res = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($res, $row);
        }
        array_push($res, $end);
        return $res;
    }


    function removeUser($uid){
        $con = connect_to_db();

        $sql = $con->prepare("UPDATE users SET IsDeleted = 1 WHERE UserId = ? ;");
        $delorders = $con->prepare("UPDATE corder SET OrderStatus = 'Cancelled' WHERE CustomerId = ? LIMIT 1");

        $delorders->bind_param('s', $uid);
        $delorders->execute();
        $res = $delorders->close();

        $sql->bind_param('s', $uid);
        $sql->execute();
        $res1 = $sql->close();

        $con->close();

        if($res1 && $res){
            return true;
        }else{
            return false;
        }
    }
    function re_open_account($uid){
        $con = connect_to_db();

        $sql = $con->prepare("UPDATE users SET IsDeleted = 0 WHERE UserId = ? ;");
        // $delorders = $con->prepare("UPDATE corder SET OrderStatus = 'Cancelled' WHERE CustomerId = ? LIMIT 1");


        $sql->bind_param('s', $uid);
        $res1 = $sql->execute();
        $sql->close();

        $con->close();

        if( $res1){
            return true;
        }else{
            return false;
        }
    }
?>