create database trenes;

create table trenes.trenes(
idTren int(4) primary key not null auto_increment,
idOrigen varchar(3) not null,
idDestino varchar(3) not null,
precio decimal(4) not null
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

create table trenes.estaciones(
idEstacion varchar(3) primary key not null,
nombre varchar(30) not null
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

create table trenes.clientes(
dni varchar(9) primary key not null,
nombre varchar(45) not null,
apellido1 varchar(45) not null,
apellido2 varchar(45) not null,
email varchar(45) not null,
telefono int(9) not null,
pass varchar(255)
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

create table trenes.billetes(
localizador varchar(50) primary key not null,
dni varchar(9) not null,
idtren varchar(3) not null,
fecha varchar(45) not null
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

insert into trenes.estaciones values ("MAD","MADRID");
insert into trenes.estaciones values ("BAR","BARCELONA");
insert into trenes.estaciones values ("VAL","VALENCIA");
insert into trenes.estaciones values ("SEV","SEVILLA");

insert into trenes.trenes values (null,"MAD","VAL",65);
insert into trenes.trenes values (null,"MAD","VAL",78);
insert into trenes.trenes values (null,"MAD","VAL",85);
insert into trenes.trenes values (null,"MAD","VAL",45);

insert into trenes.trenes values (null,"MAD","SEV",45);
insert into trenes.trenes values (null,"MAD","SEV",35);
insert into trenes.trenes values (null,"MAD","SEV",36);
insert into trenes.trenes values (null,"MAD","SEV",36);

insert into trenes.trenes values (null,"MAD","BAR",25);
insert into trenes.trenes values (null,"MAD","BAR",85);
insert into trenes.trenes values (null,"MAD","BAR",136);
insert into trenes.trenes values (null,"MAD","BAR",81);

insert into trenes.trenes values (null,"VAL","MAD",65);
insert into trenes.trenes values (null,"VAL","MAD",78);
insert into trenes.trenes values (null,"VAL","MAD",85);
insert into trenes.trenes values (null,"VAL","MAD",45);

insert into trenes.trenes values (null,"SEV","MAD",45);
insert into trenes.trenes values (null,"SEV","MAD",35);
insert into trenes.trenes values (null,"SEV","MAD",36);
insert into trenes.trenes values (null,"SEV","MAD",36);

insert into trenes.trenes values (null,"BAR","MAD",25);
insert into trenes.trenes values (null,"BAR","MAD",85);
insert into trenes.trenes values (null,"BAR","MAD",136);
insert into trenes.trenes values (null,"BAR","MAD",81);

insert into trenes.trenes values (null,"SEV","BAR",81);
insert into trenes.trenes values (null,"BAR","SEV",81);
insert into trenes.trenes values (null,"VAL","SEV",81);
insert into trenes.trenes values (null,"SEV","VAL",81);

insert into trenes.trenes values (null,"BAR","VAL",81);

