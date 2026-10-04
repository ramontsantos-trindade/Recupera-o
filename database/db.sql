CREATE DATABASE Rec_brinquedos;

USE Rec_brinquedos;

CREATE TABLE Brinquedos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    categoria VARCHAR(100),
    faixa_etaria VARCHAR(30) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT NOT NULL
);