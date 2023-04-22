CREATE TABLE `brand` (
  `BrandId` int NOT NULL AUTO_INCREMENT,
  `BrandName` varchar(140) NOT NULL,
  `BrandLogo` varchar(130) NOT NULL,
  `Website` varchar(100) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`BrandId`),
  UNIQUE KEY `BrandId` (`BrandId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci