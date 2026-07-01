CREATE DATABASE WebShopAuth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER 'WebShopUser'@'localhost' IDENTIFIED BY 'Pass123';

GRANT ALL PRIVILEGES ON WebShopAuth.* TO 'WebShopUser'@'localhost';

FLUSH PRIVILEGES;