<?php 
    require_once('../src/connection.php');

//     $con = connect_to_db();

//     $sql = "SELECT m.`MainCategoryId` as `MainCategoryId` ,
// (SELECT COUNT(*) 
//     FROM corder o3 JOIN product p3 ON o3.ProductId = p3.ProductId 
//     JOIN category c3 ON p3.CateGoryId = c3.CategoryId 
//     WHERE c3.MainCategoryId = 19 AND p3.CateGoryId = 927 AND o3.OrderStatus = 'Placed') as total_rows,
// (SELECT SUM(o3.`TotalPrice`)  
//     FROM corder o3 JOIN product p3 ON o3.ProductId = p3.ProductId 
//     JOIN category c3 ON p3.CateGoryId = c3.CategoryId  
//     WHERE c3.MainCategoryId = 19 AND p3.CateGoryId = 927 AND o3.OrderStatus = 'Placed') as total_selling

// FROM corder o

// JOIN product p on o.ProductId = p.`ProductId`
// JOIN users u on o.`CustomerId` = u.`UserId`
// JOIN category c on p.`CateGoryId` = c.`CategoryId`
// JOIN maincategory m on m.`MainCategoryId` = c.`MainCategoryId` 
// WHERE p.`CateGoryId` = 927 AND c.`MainCategoryId` = 19 AND o.`OrderStatus` = 'Placed'  LIMIT 100 OFFSET 0 ;";

// $res = mysqli_query($con, $sql);

function get_sum_of_category($main_id, $status, $start_date, $end_date, $sub_id = null){
    $con = connect_to_db();
    // Setting up variables for mysql querys

    $set_variable = $con->prepare("
    SET
        @categoryId = ?,
        @startDate = ?,
        @endDate = ?,
        @Status = ?;
    ");
    $set_variable->bind_param('isss', $sub_id, $start_date, $end_date, $status);
    $set_variable->execute();
    $set_variable->close();
    // getting total ammount of selling

    $sql = $con->prepare(
    "SELECT
    m3.`MainCategoryId` as main_category_id, 
    SUM(o3.`TotalPrice`) as total_selling,
    COUNT(*) as total_units_sold,
    m3.`MainCategoryName` as main_category_name,
    p3.`CateGoryId` as category_id
FROM corder o3
    JOIN product p3 ON o3.ProductId = p3.ProductId
    JOIN category c3 ON p3.CateGoryId = c3.CategoryId
    JOIN maincategory m3 ON m3.`MainCategoryId` = c3.`MainCategoryId`
WHERE
    c3.MainCategoryId = ?
    AND ( 
        CASE
            WHEN @categoryId IS NOT NULL THEN p3.`CateGoryId` = @categoryId
            ELSE 1 = 1
        END
    )
    AND ( 
        CASE 
            WHEN @Status IS NOT NULL THEN o3.OrderStatus = @Status COLLATE utf8mb4_unicode_ci
            ELSE 1 = 1 
        END
    )
    AND o3.`PlacedOn` BETWEEN @startDate AND @endDate;
    
    ");

    $sql->bind_param('i' , $main_id);

    $sql->execute();
    
    $res = mysqli_fetch_assoc($sql->get_result());
    $sql->close();
    $con->close();
    return $res;
}   
function get_all_main_categorys(){
    $con = connect_to_db();

    $sql = "SELECT MainCategoryId , MainCategoryName FROM maincategory ";

    $res = mysqli_query($con, $sql);

    $response = array();
    while($row = mysqli_fetch_assoc($res)){
        array_push($response, $row);
    }
    $con->close();
    return $response;
}
function get_sub_categorys($mainCategoryId = null){
    $con = connect_to_db();

    // setting variable
    $set_variable = $con->prepare("SET @mainCatId = ?;");
    $set_variable->bind_param('i', $mainCategoryId);
    $set_variable->execute();
    $set_variable->close();

    // getting categorys
    $sql = $con->prepare(
        "SELECT CategoryId, CategoryName
    FROM category c
    WHERE
        CASE
            WHEN @mainCatId IS NOT NULL THEN c.`MainCategoryId` = @mainCatId 
            ELSE 1 = 1
        END; 
    ");
    $sql->execute();
    
    $res = $sql->get_result();
    $response = array();
    while($row = mysqli_fetch_assoc($res)){
        array_push($response, $row);
    }
    $sql->close();
    $con->close();
    return $response;
}
function get_main_category_info(){
    $main_categorys = get_all_main_categorys();
    $response = array();
    foreach($main_categorys as $row){

        array_push($response, get_sub_categorys($row['MainCategoryId']));
    }
    print_r($response);
}
// print_r(get_sum_of_category(19,'Placed','2022-04-30', '2023-05-31'));
get_main_category_info();
?>