-- Active: 1675590543659@@127.0.0.1@3306@c_m_surgimed
SET
    @categoryId = null,
    @startDate = '2022-04-01 00:00:00',
    @endDate = '2022-04-30 23:59:59', 
    @Status = 'Placed',
    @ProductId = null,
    @UserId = null,
    @mainCategoryId = null;
  
SELECT   
    YEAR(o3.PlacedOn) AS year, 
    MONTH(o3.PlacedOn) AS month, 
    DAY(o3.`PlacedOn`) AS Day,  
    DATE_FORMAT(o3.PlacedOn, '%Y-%m-%d') AS date, 
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



-- Active: 1675590543659@@127.0.0.1@3306@c_m_surgimed
SET
    @categoryId = null,
    @startDate = '2022-03-01 02:26:20',
    @endDate = '2023-02-27 21:08:39', 
    @Status = 'Placed',
    @ProductId = null,
    @UserId = null,
    @mainCategoryId = null;

SELECT 
    m3.MainCategoryId AS main_category_id, 
    SUM(o3.TotalPrice) AS total_selling,
    COUNT(*) AS total_units_sold,
    m3.MainCategoryName AS main_category_name,  
    o3.OrderId AS order_id, 
    p3.ProductId AS product_id,
    p3.CategoryId AS category_id, 
    (
        SELECT COUNT(*) 
        FROM corder o  
        JOIN product p ON o.ProductId = p.ProductId  
        JOIN category c ON p.CateGoryId = c.CategoryId  
        JOIN maincategory m ON m.MainCategoryId = c.MainCategoryId
        WHERE o.OrderStatus = 'Cancelled'
        AND o.PlacedOn BETWEEN @startDate AND @endDate 
        AND (
            CASE
                WHEN @UserId IS NOT NULL THEN o.CustomerId = @UserId
                ELSE 1 = 1 
            END
        )
        AND ( 
            @ProductId IS NULL
            OR o.ProductId = @ProductId 
        )
        AND (
            @categoryId IS NULL
            OR p.CategoryId = @categoryId 
        )
        AND (
            @mainCategoryId IS NULL
            OR c.MainCategoryId = @mainCategoryId
        )
    ) AS cancelled_orders
FROM corder o3 
JOIN product p3 ON o3.ProductId = p3.ProductId 
JOIN category c3 ON p3.CategoryId = c3.CategoryId
JOIN maincategory m3 ON m3.MainCategoryId = c3.MainCategoryId 
WHERE o3.OrderStatus = 'Placed'  AND 
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
ORDER BY o3.PlacedOn
LIMIT 100 OFFSET 0;




----------------------------------------------------------------------------------------------------------------------------------------------------------------



SET
    @categoryId = null,
    @startDate = '2022-04-01 00:00:00',
    @endDate = '2022-10-31 23:59:59', 
    @Status = 'Placed',
    @ProductId = 171,
    @UserId = 1271,
    @mainCategoryId = null;  

SELECT
    SUM(o3.`TotalPrice`) as total_selling,    
    COUNT(*) as total_units_sold,
    m3.`MainCategoryName` as main_category_name, 
    p3.ProductId as product_id,
    o3.`Quantity` as quntity,
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
