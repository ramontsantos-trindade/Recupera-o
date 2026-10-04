
CREATE DATABASE IF NOT EXISTS loja_brinquedos
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE loja_brinquedos;

CREATE TABLE IF NOT EXISTS brinquedos (
  id           INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  nome         VARCHAR(100)  NOT NULL,
  categoria    VARCHAR(50)   NOT NULL,
  faixa_etaria VARCHAR(30)   NOT NULL,
  preco        DECIMAL(10,2) NOT NULL,
  estoque      INT UNSIGNED  NOT NULL DEFAULT 0,
  criado_em    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB;


INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, estoque) VALUES
  ('Bloco de Montar 100 peças', 'Educativo', '3 a 5 anos', 59.90, 25),
  ('Carrinho de Controle Remoto', 'Veículos', '6 a 8 anos', 129.90, 10),
  ('Boneca Articulada', 'Bonecas', '3 a 5 anos', 89.50, 14),
  ('Quebra-Cabeça 500 peças', 'Jogos', '9 anos ou mais', 45.00, 30);