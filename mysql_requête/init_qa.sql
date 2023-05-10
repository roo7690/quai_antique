CREATE TABLE USER (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
firstname VARCHAR(250) NOT NULL ,
lastname VARCHAR(250) NOT NULL,
email VARCHAR(250) NOT NULL,
PASSWORD VARCHAR(250) NOT NULL,
confirme BOOLEAN NOT NULL
);

CREATE TABLE admin (
id_admin INT PRIMARY KEY NOT NULL,
produit BOOLEAN NOT NULL,
galerie BOOLEAN NOT NULL,
horaire BOOLEAN NOT null
);

CREATE TABLE ACTION (
id_user INT PRIMARY KEY NOT NULL ,
state_reservation BOOLEAN NOT NULL,
nbr_enfant INT ,
nbr_couvert INT ,
msg_reservation TEXT,
note INT ,
msg_note text
);

CREATE TABLE horaire (
DATE VARCHAR(14) PRIMARY KEY ,
midi VARCHAR(11),
soir VARCHAR(11),
ordre INT UNIQUE NOT NULL
);

CREATE TABLE creneau (
DATE INT ,
horaire VARCHAR(5) NOT NULL,
reserver INT,
WEEK INT NOT NULL
);

CREATE table galerie(
title VARCHAR(250),
FILE VARCHAR(250)
);

CREATE table produit (
title VARCHAR(250),
description TEXT,
TYPE VARCHAR(20),
prix FLOAT
);

CREATE table menu (
title VARCHAR(250),
description TEXT,
prix FLOAT
);

