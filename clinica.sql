DROP DATABASE if exists clinica;
CREATE DATABASE clinica;
USE clinica;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE tutor (
    id_tutor INT AUTO_INCREMENT PRIMARY KEY,
    nome_tutor VARCHAR(255) NOT NULL,
    telefone_tutor VARCHAR(255) NOT NULL
);

CREATE TABLE pet (
    id_pet INT AUTO_INCREMENT PRIMARY KEY,
    nome_pet VARCHAR(255) NOT NULL,
    tipo_pet VARCHAR(255) NOT NULL,
    id_tutor INT,
    FOREIGN KEY (id_tutor) REFERENCES tutor(id_tutor)
);

INSERT INTO usuario (id_usuario, email, senha)
VALUES
(1, 'clinica@clinica.com', 'clinica123');

INSERT INTO tutor (id_tutor, nome_tutor, telefone_tutor)
VALUES
(1, 'Maria Souza', '41999999999'),
(2, 'Carlos Lima', '41988888888');

INSERT INTO pet (id_pet, nome_pet, tipo_pet, id_tutor)
VALUES
(1, 'Amora', 'gato', 1),
(2, 'Zorro', 'cachorro', 2),
(3, 'Billy', 'gato', 1);

