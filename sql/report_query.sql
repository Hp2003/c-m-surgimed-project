-- Active: 1675590543659@@127.0.0.1@3306@c_m_surgimed

-- SELECT

--     o.OrderId as order_id,

--     u.`UserName` as user_name,

--     o.`TotalPrice` as total_price,

--     o.Price as price_per_unit,

--     o.`Quantity` as quanitiy,

--     o.`OrderStatus` as order_status,

--     o.`PlacedOn` as placed_on,

--     p.`CateGoryId` as category_id ,

--     p.`ProductId` as product_id

-- from corder o

--     join users u on o.`CustomerId` = u.`UserId`

--     join product p on o.`ProductId` = p.`ProductId`

--     join category c on c.`CategoryId` = p.`CateGoryId`

-- where o.OrderStatus = 'Placed' and p.`CateGoryId` = 925   and o.`ProductId` = 174 ORDER BY o.`PlacedOn`;

SET
    @mainCategoryId = null,
    @categoryId = null,
    @startDate = '2022-03-01 02:26:20',
    @endDate = '2023-03-27 21:08:39',
    @Status = 'Placed',
    @ProductId = 145,
    @UserId = null;

SELECT
    m3.`MainCategoryName` as main_category_name,
    m3.`MainCategoryId` as main_category_id,
    p3.`ProductTitle` as product_title,
    -- p3.`ProductTitle` as product_name,  
    o3.`CustomerId` as cutomer_id,
    o3.`PlacedOn` as placed_on,
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
    ) ORDER BY o3.`PlacedOn`LIMIT 100 OFFSET 0; 