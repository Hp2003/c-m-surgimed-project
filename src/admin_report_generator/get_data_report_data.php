<?php 
    require_once('./src/connection.php');

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

function get_sum_of_category($main_id, $status, $start_date, $end_date,$sub_id = null, $product_id = null, $user_id = null, $offset = 0){
    $con = connect_to_db();
    // Setting up variables for mysql querys

    $set_variable = $con->prepare("
    SET
    @categoryId = ?,
    @startDate = ?,
    @endDate = ?, 
    @Status = ?,
    @ProductId = ?,
    @UserId = ?,
    @mainCategoryId = ?;
    ");
    $set_variable->bind_param('isssiii', $sub_id, $start_date, $end_date, $status, $product_id, $user_id, $main_id);
    $set_variable->execute();
    $set_variable->close();
    // getting total ammount of selling

    $sql = $con->prepare(
    "SELECT 
    m3.`MainCategoryId` as main_category_id,
    c3.`CategoryName` as category_name,
    SUM(o3.`TotalPrice`) as total_selling,
    COUNT(*) as total_units_sold,
    m3.`MainCategoryName` as main_category_name,
    o3.`OrderId` as `OrderId`,
    p3.ProductTitle as 'product_name',
    p3.ProductId as product_id,
    p3.`CateGoryId` as category_id  , (  
        SELECT COUNT(*) 
FROM corder o  
JOIN product p ON o.ProductId = p.ProductId 
JOIN category c ON p.CateGoryId = c.CategoryId  
JOIN maincategory m ON m.`MainCategoryId` = c.`MainCategoryId`
WHERE o.`OrderStatus` = 'Cancelled'
AND o.`PlacedOn` BETWEEN @startDate AND @endDate 
AND (
    CASE
        WHEN @UserId IS NOT NULL THEN o.`CustomerId` = @UserId
        ELSE 1 = 1 
    END
)
AND (
    @ProductId IS NULL
    OR o.`ProductId` = @ProductId 
)
AND (
    @categoryId IS NULL
    OR p.`CategoryId` = @categoryId
)
AND (
    @mainCategoryId IS NULL
    OR c.`MainCategoryId` = @mainCategoryId
)) as cancelled_orders -- 2nd part 
FROM corder o3 
    JOIN product p3 ON o3.ProductId = p3.ProductId
    JOIN category c3 ON p3.CateGoryId = c3.CategoryId
    JOIN maincategory m3 ON m3.`MainCategoryId` = c3.`MainCategoryId` 
WHERE 
 (
        @ProductId IS NOT NULL
        AND o3.`ProductId` = @ProductId
        AND (
            IFNULL( 
                @mainCategoryId,
                m3.`MainCategoryId`
            ) = m3.`MainCategoryId`
            OR @mainCategoryId IS NULL
        )
    )
    AND o3.OrderStatus = IFNULL(@Status, o3.OrderStatus) COLLATE utf8mb4_unicode_ci
    OR (
        @ProductId IS NULL 
        AND p3.`CateGoryId` = IFNULL(@categoryId, p3.`CateGoryId`)
        AND (
            IFNULL(
                @mainCategoryId,
                m3.`MainCategoryId`
            ) = m3.`MainCategoryId`
            OR @mainCategoryId IS NULL
        )
    )
    AND o3.OrderStatus = IFNULL(@Status, o3.OrderStatus) COLLATE utf8mb4_unicode_ci
    AND o3.`PlacedOn` BETWEEN @startDate AND @endDate
    AND (
        CASE
            WHEN @UserId IS NOT NULL THEN o3.`CustomerId` = @UserId 
            ELSE 1 = 1 
        END
    ) ORDER BY o3.`PlacedOn` LIMIT 100 OFFSET ? ;");

    $sql->bind_param('i', $offset);
    $sql->execute();
    
    $res = mysqli_fetch_assoc($sql->get_result());
    $sql->close();
    $con->close();
    return $res;
}   
// ////////////////////////////////////////////////////////////

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
// ////////////////////////////////////////////////////////////

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
// get_main_category_info();

// /////////////////////////////////////////////////////////////////////////////////

function get_all_productids($sub_id){
    $con = connect_to_db();

    $sql = "SELECT p.ProductId from product p WHERE CategoryId = $sub_id ";

    $res = mysqli_query($con, $sql);

    $response = array();
    while($row = mysqli_fetch_assoc($res)){
        array_push($response, $row);
    }
    $con->close();
    return $response;
}
// /////////////////////////////////////////////////////////////////////////////////
function get_details($main_id, $status, $start_date, $end_date,$sub_id = null, $product_id = null, $user_id = null, $offset = 0){
    $con = connect_to_db();
    // Setting up variables for mysql querys

    $set_variable = $con->prepare("
    SET
    @categoryId = ?,
    @startDate = ?,
    @endDate = ?, 
    @Status = ?,
    @ProductId = ?,
    @UserId = ?,
    @mainCategoryId = ?;
    ");
    $set_variable->bind_param('isssiii', $sub_id, $start_date, $end_date, $status, $product_id, $user_id, $main_id);
    $set_variable->execute();
    $set_variable->close();
    // getting total ammount of selling

    $sql = $con->prepare(
    "SELECT
    m3.`MainCategoryName` as main_category_name,
    m3.`MainCategoryId` as main_category_id,
    p3.`ProductTitle` as product_title,
    -- p3.`ProductTitle` as product_name,  
    o3.`CustomerId` as cutomer_id,
    o3.`PlacedOn` as placed_on,
    o3.`Price` as `product_price`,
    o3.Quantity as unit_sold,
    o3.TotalPrice as total_price,
    -- IF(@proOrderDetails IS NOT NULL, o3.`OrderId`, NULL) as `OrderId`, 
    -- IF(@proOrderDetails IS NOT NULL, p3.`CateGoryId`, NULL) as category_id 
    o3.`OrderId` as order_id,
    p3.`CateGoryId` as categroy_id,
    p3.`ProductId` as product_id,
    o3.`OrderStatus` as order_status
FROM corder o3
    JOIN product p3 ON o3.ProductId = p3.ProductId
    JOIN category c3 ON p3.CateGoryId = c3.CategoryId
    JOIN maincategory m3 ON m3.`MainCategoryId` = c3.`MainCategoryId`
WHERE ( (
            @ProductId IS NOT NULL
            AND o3.`ProductId` = @ProductId
            AND IFNULL(
                @mainCategoryId,
                m3.`MainCategoryId`
            ) = m3.`MainCategoryId`
        )
        OR (
            @ProductId IS NULL
            AND p3.`CateGoryId` = IFNULL(@categoryId, p3.`CateGoryId`)
            AND IFNULL(
                @mainCategoryId,
                m3.`MainCategoryId`
            ) = m3.`MainCategoryId`
        ) 
    )
    AND o3.OrderStatus = IFNULL(@Status, o3.OrderStatus) COLLATE utf8mb4_unicode_ci
    AND o3.`PlacedOn` BETWEEN @startDate AND @endDate
    AND (
        CASE
            WHEN @UserId IS NOT NULL THEN o3.`CustomerId` = @UserId
            ELSE 1 = 1
        END
    ) ORDER BY o3.`PlacedOn`LIMIT 100 OFFSET ? ; ");

    $sql->bind_param('i', $offset);
    $sql->execute();
    
    $res = $sql->get_result();
    $response = array();
    $sql->close();
    $con->close();
    while($row = mysqli_fetch_assoc($res)){
        array_push($response, $row);
    }


    return $response;
}
?>