CREATE DATABASE simpleRestAPIPHP DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE simpleRestAPIPHP;
CREATE TABLE sra_products (
	pro_id INT(4)  PRIMARY KEY AUTO_INCREMENT,
	pro_name VARCHAR(256) NOT NULL,
	pro_price FLOAT(7,2) NOT NULL
);
