CREATE TABLE IF NOT EXISTS utenti (
id int NOT NULL AUTO_INCREMENT,
nome varchar(45),
cognome varchar(45),
email varchar(255),
password varchar(255),
PRIMARY KEY (id)
);