CREATE TABLE Product(
    ProductId INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    ProductTitle VARCHAR(255) NOT NULL,
    ProductCategroy INT NOT NULL,
    ProductImg VARCHAR(100),
    ProductDesc VARCHAR(1000),
    ProductSpecification VARCHAR(1000)
);

ALTER TABLE Product ADD ProductPrice FLOAT NOT NULL CHECK(ProductPrice > 0);

ALTER TABLE product ADD CateGoryId INT NOT NULL ;
ALTER TABLE product ADD CONSTRAINT CategoryId
Foreign Key (CategoryId) REFERENCES category(CategoryId);

ALTER TABLE Product ADD QuantityOnHand INT NOT NULL CHECK(QuantityOnHand >= 0) DEFAULT  0;

ALTER TABLE Product ADD ProductKeywords VARCHAR(200) NOT NULL ;
ALTER TABLE Product ADD ProductStatus VARCHAR(20) DEFAULT  'Available' ;