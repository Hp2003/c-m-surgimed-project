CREATE TABLE `category` (
  `CategoryId` int NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(100) NOT NULL,
  `CreateAt` datetime DEFAULT NULL,
  `UpdateAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MainCategoryId` int NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CategoryId`),
  UNIQUE KEY `CategoryId` (`CategoryId`),
  UNIQUE KEY `CategoryName` (`CategoryName`),
  KEY `fk_maincategory` (`MainCategoryId`),
  CONSTRAINT `fk_maincategory` FOREIGN KEY (`MainCategoryId`) REFERENCES `maincategory` (`MainCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=928 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci