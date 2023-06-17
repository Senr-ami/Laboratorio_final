CREATE TABLE usuarios (
    ID INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    Nombre varchar(20) NOT NULL,
    Apellido1 varchar(20) NOT NULL,
    Apellido2 varchar(20) NOT NULL,
    Email varchar(50) NOT NULL UNIQUE,
    Login varchar(15) NOT NULL,
    Password varchar(255) NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=utf8mb4;
