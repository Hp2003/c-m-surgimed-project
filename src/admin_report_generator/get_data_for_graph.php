<?php 
    require_once('./src/connection.php');
    function get_graph_data($main_id = null, $status, $start_date, $end_date,$sub_id = null, $product_id = null, $user_id = null){
        $con = connect_to_db();
        // Setting variables
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

        // Getting main data
        $sql = ("SELECT   
        YEAR(o3.PlacedOn) AS year, 
        MONTH(o3.PlacedOn) AS month, 
        DAY(o3.`PlacedOn`) AS Day,  
        SUM(o3.TotalPrice) as revenue,
        DATE_FORMAT(o3.PlacedOn, '%Y-%m-%d') AS date, 
        o3.Quantity as quty,
        COUNT(*) AS total_units_sold 
    FROM corder o3 
    RIGHT JOIN product p3 ON o3.ProductId = p3.ProductId 
    RIGHT JOIN category c3 ON p3.CategoryId = c3.CategoryId 
    RIGHT JOIN maincategory m3 ON m3.MainCategoryId = c3.MainCategoryId  
    WHERE o3.OrderStatus = IFNULL(@Status, o3.OrderStatus) COLLATE utf8mb4_unicode_ci  AND  
     o3.PlacedOn BETWEEN @startDate  AND  @endDate   
    AND (  
        CASE  
            WHEN @UserId IS NOT NULL THEN o3.CustomerId = @UserId 
            ELSE 1 = 1   
        END
    ) 
    AND (  
        @ProductId IS NULL 
        OR o3.ProductId = @ProductId  
    ) 
    AND (
        @categoryId IS NULL 
        OR p3.CategoryId = @categoryId  
    )
    AND (
        @mainCategoryId IS NULL
        OR c3.MainCategoryId = @mainCategoryId
    )
    GROUP BY YEAR(o3.PlacedOn), MONTH(o3.PlacedOn), DATE_FORMAT(o3.PlacedOn, '%Y-%m-%d')
    ORDER BY year, month, date;
        ");
    $res = mysqli_query($con, $sql);
    $resArray = array();
    if($res){
        while($row = mysqli_fetch_assoc($res)){
            array_push($resArray, $row);
        }
        return $resArray;
    }
    return $res;
}
function get_yearly_data($sub_id = null, $start_date, $end_date, $status = 'Placed', $product_id = null, $user_id = null, $main_id = null){
    $con = connect_to_db();

    $set_variable = $con->prepare(
    "SET
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

    $sql = "SELECT  
    SUM(o3.`TotalPrice`) as total_selling,  
    COUNT(*) as total_units_sold,
    MONTH(o3.PlacedOn) as month,
    m3.`MainCategoryName` as main_category_name,
    p3.ProductId as product_id, 
    o3.Quantity as qty,
    p3.`CateGoryId` as category_id   
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
        AND o3.OrderStatus = IFNULL(@Status, o3.OrderStatus) COLLATE utf8mb4_unicode_ci
        AND o3.`PlacedOn` BETWEEN @startDate AND @endDate
        AND (
            CASE
                WHEN @UserId IS NOT NULL THEN o3.`CustomerId` = @UserId 
                ELSE 1 = 1 
            END
        )
    )
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
        AND o3.OrderStatus = IFNULL(@Status, o3.OrderStatus) COLLATE utf8mb4_unicode_ci
        AND o3.`PlacedOn` BETWEEN @startDate AND @endDate
        AND (
            CASE
                WHEN @UserId IS NOT NULL THEN o3.`CustomerId` = @UserId 
                ELSE 1 = 1 
            END
        )
    )
ORDER BY o3.`PlacedOn`;
";

    $res = $con->query($sql);
    if($res){
        return mysqli_fetch_assoc($res);
    }
    return $res;
}
