create database petshop;
use petshop;

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

ALTER TABLE usuarios
CHANGE COLUMN id id INT NOT NULL AUTO_INCREMENT,
CHANGE COLUMN nome name VARCHAR(100) NOT NULL,
CHANGE COLUMN email email VARCHAR(100) NOT NULL,
CHANGE COLUMN senha password VARCHAR(255) NOT NULL;


INSERT INTO usuarios (nome, email, senha)
VALUES 
    ('João Silva', 'joao.silva@email.com', 'senha1'),
    ('Maria Oliveira', 'maria.oliveira@email.com', 'senha2'),
    ('Carlos Pereira', 'carlos.pereira@email.com', 'senha3'),
    ('Ana Souza', 'ana.souza@email.com', 'senha4'),
    ('Pedro Costa', 'pedro.costa@email.com', 'senha5');
    
INSERT INTO usuarios (name, email, password)
VALUES 
  ('João', 'a@email', '123')

