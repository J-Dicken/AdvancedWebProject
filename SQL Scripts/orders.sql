SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

DROP TABLE IF EXISTS `ORDERS`;

CREATE TABLE IF NOT EXISTS `ORDERS` (
  orderID int NOT NULL AUTO_INCREMENT,
  email varchar(125) NOT NULL DEFAULT '',
  name varchar(50) NOT NULL DEFAULT '',
  tel varchar(10) NOT NULL DEFAULT '',
  productID int NOT NULL,
  price varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (orderID),
  FOREIGN KEY (email) REFERENCES USERS(email),
  FOREIGN KEY (productID) REFERENCES PRODUCTS(id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
