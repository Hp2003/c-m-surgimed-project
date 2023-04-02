<?php 
require_once('./src/get_categorys_brands_and_sub_categorys.php');
require_once('./src/connection.php');
require_once('./src/deleteProduct.php');
    function brand_handler_main(){
        if(isset($_POST['process'])){
            if($_POST['process'] == 'getView'){
                header('Content-Type: application/json');
                // Read the contents of the HTML file
                $html = file_get_contents('./views/admin_views/edit_brand_view.php');
                $resData = array(
                    'html' => $html,
                    'brandData' => get_brands(false)
                );
                echo json_encode($resData);
                return;
            }
            if($_POST['process'] == 'addnewbrand'){
                header('Content-Type: application/json');
                $resData = array(
                    'data' => addNewbrand($_POST['brandName'])
                );
                echo json_encode($resData);
                return;
            }
            if($_POST['process'] == 'removebrand'){
                header('Content-Type: application/json');
                $resData = array(
                    'data' => removebrand($_POST['brandId'])
                );
                echo json_encode($resData);
                return;
            }
            if($_POST['process'] == 're-openbrand'){
                header('Content-Type: application/json');
                $resData = array(
                    'data' => re_openBrand($_POST['brandId'])
                );
                echo json_encode($resData);
                return;
            }
            if($_POST['process'] == 'searchbrand'){
                header('Content-Type: application/json');
                $resData = array(
                    'data' => searchBrand($_POST['name'])
                );
                echo json_encode($resData);
                return;
            }
        }
    }
    function addNewbrand($nameOfBrand){
        // $date = date('y-m-d h:i:s');

        $con = connect_to_db();

        $sql = "INSERT INTO brand (BrandName, BrandLogo) VALUES ('$nameOfBrand', '' )";
        try{
            $result = mysqli_query($con, $sql);

            if(mysqli_affected_rows($con) > 0){
                $con->close();
                return 1;
            }else {
                $con->close();
                return 0;
            }
        }catch(Exception $e){
            $con->close();

            if($con->errno() ==1062 ){
                return 2;
            }else{
                return 0;
            }
        }

    }
    function removebrand($id){
        $con = connect_to_db();

        $gettingProducts = "SELECT * FROM product WHERE BrandId = '$id' ";

        $res = mysqli_query($con, $gettingProducts);

        while($row = mysqli_fetch_assoc($res)){
            delte_files_cat($row['ProductImg']);
        }

        $deletePro = "UPDATE product SET ProductStatus  = 'Deleted' WHERE BrandId = '$id'";

        mysqli_query($con, $deletePro);

        $res = $delBrand = "UPDATE brand SET IsDeleted = 1 WHERE BrandId = '$id'";
        mysqli_query($con, $delBrand);

        $con->close();
        if($res){
            return 1;
        }else{
            return 0;
        }
    }
    function re_openBrand($id){
        $con = connect_to_db();

        $gettingProducts = "UPDATE brand SET IsDeleted = 0  WHERE BrandId = '$id' ";

        $res = mysqli_query($con, $gettingProducts);

        return $res;
    }
    function searchBrand($name){
        $con = connect_to_db();

        $sql = "SELECT * FROM brand WHERE BrandName LIKE '%$name%'";

        $res = mysqli_query($con, $sql);

        $resarray = array();

        $con->close();
        if($res){
            while($row = mysqli_fetch_assoc($res)){
                array_push($resarray, $row);
            }
            return $resarray;
        }
        return false;
    }
?>