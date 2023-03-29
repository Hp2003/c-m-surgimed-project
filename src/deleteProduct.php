<?php 
    require_once('connection.php');
    function delete_product(){
        $id = $_POST['item_Id'];
        $connection = connect_to_db();

        // getting data to remove images

        $stmt = $connection->prepare('SELECT ProductImg FROM product WHERE ProductId = ?');

        $stmt->bind_param('s', $id);

        $stmt->execute();
        
        $result = $stmt-> get_result();

        $data = mysqli_fetch_assoc($result);
        
        $stmt->close();
        if(!delte_files($data['ProductImg'])){
            header('Content-Type: text/plain');
            $connection->close();
            echo "can't remove";
            return 0;
        }

        $delte_query = $connection->prepare("UPDATE  product  SET ProductStatus = 'Deleted' WHERE ProductId = ?");

        $delte_query->bind_param('s', $id);

        $res = $delte_query->execute();

        if($res){
            header('Content-Type: application/json');

            $result = array(
                'text' => 'deleted'
            );
            echo json_encode($result);
            return 0;
        }
        header('Content-Type: application/json');

        $result = array(
            'text' => 'notDeleted'
        );
        echo json_encode($result);
        return 0;

    }
    function delte_files($path){
        foreach(scandir($path) as $item){
            if($item == '.' || $item == '..'){
                continue;
            }
            if(!unlink($path . DIRECTORY_SEPARATOR . $item)){
                return false;
            }
        }
        return rmdir($path);
    }
    
?>