create database if not exists sistema_agendas;

use sistema_agendas;
create table if not exists usuarios(
idUsuario INT auto_increment primary key,
Nome VARCHAR(50) NOT NULL,
Email varchar(50) NOT NULL,
Senha char(255)NOT NULL
);
INSERT INTO usuarios (idUsuario, Nome, Email, Senha) VALUES (1, 'Vinicius', 'vlucassouza@gmail.com', '$2y$10$KokA21fFwoeCVIanakXaGetkNTfQ4ST8hVpcJb8urqUu1PTFSsixW');
-- SENHA ENCRIPTADA
-- LOGIN: email: vlucassouza@gmail.com || senha: 123456

use sistema_agendas;
create table if not exists agendas(
idAgenda INT auto_increment primary key,
Nome varchar(50) NOT NULL,
Telefone varchar(20) NOT NULL,
Endereco varchar (100) NOT NULL
);
