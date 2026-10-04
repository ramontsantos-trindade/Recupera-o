CREATE DATABASE Rec_brinquedos;

USE Rec_brinquedos;

CREATE Brinquedos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    categoria VARCHAR(100),
    faixa_etaria VARCHAR (30) NOT NULL,
    preço DECIMAL (10, 2) NOT NULL,
    quantidade INT NOT NULL
)