CREATE DATABASE injector;

USE injector;

CREATE TABLE vitimas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(40) NOT NULL
);

INSERT INTO vitimas (nome) VALUES
('João Silva'),
('Maria Santos'),
('Pedro Oliveira'),
('Ana Costa'),
('Carlos Pereira'),
('Fernanda Martins'),
('Ricardo Ferreira'),
('Juliana Almeida'),
('André Souza'),
('Camila Rodrigues'),
('Marcelo Lima'),
('Bruna Carvalho'),
('Lucas Cardoso'),
('Larissa Oliveira'),
('Guilherme Santos'),
('Amanda Pereira'),
('Gabriel Silva'),
('Isabela Costa'),
('Rafael Martins'),
('Larissa Gonçalves'),
('Tiago Mendes'),
('Beatriz Almeida'),
('Eduardo Rodrigues'),
('Natália Ferreira'),
('Bruno Gonçalves'),
('Patrícia Souza'),
('Leonardo Carvalho'),
('Laura Santos'),
('Vinícius Oliveira'),
('Raquel Martins'),
('Gustavo Pereira'),
('Vanessa Silva'),
('Rodrigo Costa'),
('Luana Lima'),
('Matheus Carvalho'),
('Jéssica Almeida'),
('Diego Rodrigues'),
('Amanda Ferreira'),
('Fernando Gonçalves');
