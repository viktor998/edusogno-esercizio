CREATE TABLE IF NOT EXISTS eventi (
id int NOT NULL AUTO_INCREMENT,
attendees text,
nome_evento varchar(255),
data_evento datetime,
PRIMARY KEY (id)
);