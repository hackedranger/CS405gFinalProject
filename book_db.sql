
create table books (ISBN INT(13) PRIMARY KEY NOT NULL, name varchar(30), publisher varchar(30), language varchar(15), pubDate DATE, price DECIMAL(8,2) NOT NULL, QUANTITY INT NOT NULL DEFAULT 0, subject VARCHAR(20), summary TEXT);

CREATE TABLE authors (author varchar(30), ISBN int(13) NOT NULL, FOREIGN KEY(ISBN) REFERENCES books(ISBN));

CREATE TABLE users (UID INT PRIMARY KEY NOT NULL AUTO_INCREMENT, email VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, role ENUM('manager', 'customer') NOT NULL DEFAULT 'customer', fname VARCHAR(30) NOT NULL, mname VARCHAR(30), lname VARCHAR(30) NOT NULL, age INT, gender ENUM('male','female'));

CREATE TABLE book_keywords (ISBN INT(13), KEYWORD VARCHAR(30) NOT NULL, FOREIGN KEY(ISBN) REFERENCES books(ISBN));

CREATE TABLE reviews (UID INT NOT NULL, ISBN INT(13) NOT NULL, rating INT, review TEXT, FOREIGN KEY (UID) REFERENCES users(UID), FOREIGN KEY (ISBN) REFERENCES books(ISBN));

CREATE TABLE orders (orderNumber INT PRIMARY KEY NOT NULL AUTO_INCREMENT, UID INT, ISBN INT(13), ccNumber INT NOT NULL, cost DECIMAL(8,2) NOT NULL, status VARCHAR(30) NOT NULL, quantity INT NOT NULL, billingAddr VARCHAR(30) NOT NULL, orderDate DATE NOT NULL, shippingAddr VARCHAR(30) NOT NULL, FOREIGN KEY(UID) REFERENCES users(UID), FOREIGN KEY(ISBN) REFERENCES books(ISBN));
