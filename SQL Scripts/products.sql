SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

DROP TABLE IF EXISTS `PRODUCTS`;

CREATE TABLE IF NOT EXISTS `PRODUCTS` (
  id int(2) NOT NULL AUTO_INCREMENT,
  name varchar(250) NOT NULL DEFAULT '',
  dept varchar(25) NOT NULL DEFAULT '',
  brand varchar(25) NOT NULL DEFAULT '',
  imgSrc varchar(35) NOT NULL DEFAULT '',
  imgAlt varchar(250) NOT NULL DEFAULT '',
  price varchar(10) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO PRODUCTS (name, dept, brand, imgSrc,imgAlt, price) VALUES
('LG 60 Inch 60UQ81006LB Smart 4K UHD HDR LED Freeview TV', 'Televisions', 'LG', 'LG60UQ81006LB.png', 'A picture of a LG 60 inch 4K smart TV', '£449.00'),
('Samsung 50 Inch UE50CU7100KXXU Smart 4K UHD HDR LED TV', 'Televisions', 'Samsung', 'SAMUE50CU7100KXXU.png', 'A picture of a Samsung 50 inch 4k smart TV', '£399.00'),
('LG 55 Inch OLED55B36LA Smart 4K UHD HDR OLED Freeview TV', 'Televisions', 'LG', 'LGOLED55B36LA.png', 'A picture of a LG 55 inch 4k smart TV', '£1499.00'),
('Bush 40 Inch Smart FHD HDR LED Freeview TV', 'Televisions', 'Bush', 'BUSH40ISMRTFHD.png', 'A picture of a Bush 40 inch HD TV', '£189.99'),
('Samsung 40 Inch UE40T5300AEXXU Smart Full HD HDR LED TV', 'Televisions', 'Samsung', 'SAMUE40T5300AEXXU.png', 'A picture of a Samsung 40 inch HD smart TV', '£249.00'),
('Bush 50 Inch Smart 4K UHD HDR LED Freeview TV', 'Televisions', 'Bush', 'BUSH50ISMRT4K.png', 'A picture of a Bush 50 inch 4K smart TV', '£269.99'),
('Google Pixel 7 Pro 5G 128GB Mobile Phone', 'Mobiles', 'Google', 'GOOGLEPIX7PRO.png', 'A picture of a Google Pixel 7 Pro 5G 128GB', '£849.00'),
('Samsung Galaxy A34 5G 256GB Mobile Phone', 'Mobiles', 'Samsung', 'SAMGALA34.png', 'A picture of a Samsung Galaxy A34 5G 256GB', '£299.00'),
('iPhone 12 5G 64GB Mobile Phone', 'Mobiles', 'Apple', 'IPHONE12.png', 'A picture of a iPhone 12 5G 64GB', '£599.00'),
('Samsung Galaxy A14 64GB Mobile Phone', 'Mobiles', 'Samsung', 'SAMGALA14.png', 'A picture of a Samsung Galaxy A14 64GB', '£174.00'),
('Google Pixel 7a 5G 128GB Mobile Phone', 'Mobiles', 'Google', 'GOOGLEPIX7A.png', 'A picture of a Google Pixel 7A 5G 128GB', '£449.00'),
('iPhone 14 5G 128GB Mobile Phone', 'Mobiles', 'Apple', 'IPHONE14.png', 'A picture of a iPhone 14 5G 128GB', '£764.00'),
('Acer 314 14in Pentium 4GB 128GB Chromebook', 'Laptops', 'Acer', 'ACER314.png', 'A picture of an Acer 314 14 inch laptop', '£189.00'),
('Apple MacBook Air 2020 13 Inch M1 8GB 256GB', 'Laptops', 'Apple', 'APPMACAIR.png', 'A picture of an Apple MacBook Air 2020', '£849.00'),
('Acer Aspire 3 15.6in Ryzen 5 8GB 256GB Laptop', 'Laptops', 'Acer', 'ACERASP3.png', 'A picture of an Acer Aspire 3 15 inch', '£349.00'),
('Lenovo IdeaPad 3i 15.6in i3 4GB 128GB Laptop', 'Laptops', 'Lenovo', 'LENID3I.png', 'A picture of a Lenovo IdeaPad 3i', '£269.99'),
('Lenovo IdeaPad 1i 14in Celeron 4GB 64GB Cloudbook', 'Laptops', 'Lenovo', 'LENID1I.png', 'A picture of a Lenovo IdeaPad 1i', '£149.99'),
('Microsoft Surface Pro 9 13in i5 8GB 256GB 2-in-1 Laptop', 'Laptops', 'Microsoft', 'SURFPRO9.png', 'A picture of a Microsoft Surface Pro 9', '£1099.00');