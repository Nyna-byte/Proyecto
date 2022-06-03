drop database prendas;
create database prendas;
use prendas;

create table camisa (n_fase varchar(3), descripcion_fase varchar(20), maquina varchar(20), puntada varchar(20), rpm varchar(10), ppc varchar(10), tc varchar(10), observaciones varchar(80)) ENGINE=InnoDB;
/** create table $nombre_prenda */
alter table camisa add constraint pk_n_fase primary key (n_fase);

insert into camisa (n_fase,descripcion_fase,maquina,tc) values (1,Orillar tela y entretela de tira ,plana,120);


