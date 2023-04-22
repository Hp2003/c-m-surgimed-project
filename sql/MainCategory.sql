CREATE TABLE `maincategory` (
  `MainCategoryId` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `CreatedTime` datetime NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  `MainCategoryName` varchar(200) NOT NULL,
  `IsDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`MainCategoryId`),
  UNIQUE KEY `MainCategoryName` (`MainCategoryName`),
  UNIQUE KEY `unique_name` (`MainCategoryName`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci