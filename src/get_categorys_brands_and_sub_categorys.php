<?php 
    require_once('connection.php');
    function get_categorys_brands_and_sub_categorys(){
        if(isset($_POST['process_forProPage'])){
            if($_POST['process_forProPage'] == 'getMainCategory'){
                header('Content-Type: application/json; charset=utf-8');
                $res = array(
                    'text' => get_main_categorys()
                );
                echo json_encode($res);
                return ;
            }
            elseif($_POST['process_forProPage'] == 'getSubCategory'){
                header('Content-Type: application/json; charset=utf-8');
                $res = array(
                    'text' => get_sub_category($_POST['mainCategoryId'])
                );
                echo json_encode($res);
                return ;
            }
            elseif($_POST['process_forProPage'] == 'getbrands'){
                header('Content-Type: application/json; charset=utf-8');
                $res = array(
                    'text' => get_brands()
                );
                echo json_encode($res);
                return ;
            }
        }
    }

    function get_main_categorys(){
        $con = connect_to_db();

        $sql = "SELECT * FROM MainCategory WHERE IsDeleted = 0 ";

        $res = mysqli_query($con, $sql);

        $response = array();

        $con->close();
        while($row = mysqli_fetch_assoc($res)){
            array_push($response, $row);
        }

        return $response;
    }
    function get_sub_category($id){
        $con = connect_to_db();

        $sql = "SELECT * FROM category WHERE IsDeleted = 0 AND MainCategoryId = '$id' ";

        $res = mysqli_query($con, $sql);

        $response = array();

        $con->close();
        while($row = mysqli_fetch_assoc($res)){
            array_push($response, $row);
        }

        return $response;
    }
    function get_brands($rmdelted = true){
        $con = connect_to_db();
        $sql = '';
        if($rmdelted){
            $sql = "SELECT b.BrandId, b.BrandName,b.CreatedAt, b.UpdatedAt, COUNT(p.ProductId) AS ProductCount
            FROM brand b
            LEFT JOIN product p ON b.BrandId = p.BrandId AND p.ProductStatus = 'Available'
            WHERE b.IsDeleted = 0
            GROUP BY b.BrandId ";
        }else{
            $sql = "SELECT b.BrandId, b.BrandName,b.CreatedAt, b.UpdatedAt, COUNT(p.ProductId) AS ProductCount
            FROM brand b
            LEFT JOIN product p ON b.BrandId = p.BrandId AND p.ProductStatus = 'Available'
            GROUP BY b.BrandId ";
        }

        $res = mysqli_query($con, $sql);

        $response = array();

        $con->close();
        while($row = mysqli_fetch_assoc($res)){
            array_push($response, $row);
        }

        return $response;
    }
?>