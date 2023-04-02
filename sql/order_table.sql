create table Corder (
    OrderId BIGINT PRIMARY KEY NOT NULL auto_increment ,
    CustomerId INT NOT NULL,
    TotalPrice INT NOT NULL check (TotalPrice > 0),
    PlacedOn DATE NOT NULL,
    OrderStatus VARCHAR(30) NOT NULL,
    ProductId INT NOT NULL ,
    Foreign Key (CustomerId) REFERENCES users(UserId),
    Foreign Key (ProductId) REFERENCES product(ProductId)
);

ALTER TABLE Corder ADD Quantity INT NOT NULL check (Quantity > 0 );
ALTER TABLE Corder ADD DeliveryAddress VARCHAR(300) NOT NULL  ;
ALTER TABLE Corder ADD PhoneNumber VARCHAR(15) NOT NULL  ;
ALTER TABLE Corder ADD TotalPrice INT CHECK (TotalPrice >= 0) NOT NULL;