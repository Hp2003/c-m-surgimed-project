CREATE TABLE review (
    ReviewId BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    ReviewText VARCHAR(255),
    CustomerId INT NOT NULL,
    ProductId INT NOT NULL,
    DateAdded DATE NOT NULL,
    Foreign Key (CustomerId) REFERENCES users(UserId),
    Foreign Key (ProductId) REFERENCES product(ProductId)
);

ALTER Table review ADD UpVotes INT DEFAULT  0;

Alte TABLE review REMOVE UpVotes;

