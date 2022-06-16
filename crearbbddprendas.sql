drop database prendas;
create database prendas DEFAULT CHARACTER SET utf8;

CREATE TABLE fases (
id_fase int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
nombre_prenda varchar(100) not null, 
n_fase int(3) NOT NULL, 
descripcion_fase varchar(100) not null, 
maquina varchar(20) not null, 
puntada varchar(20), 
rpm varchar(10), 
ppc varchar(10), 
tc varchar(10) not null, 
observaciones varchar(80))
ENGINE=InnoDB DEFAULT CHARACTER SET = utf8;