drop database dbmat;
create database dbmat;
use dbmat;

create table usuario(
uid  int PRIMARY KEY  auto_increment,
pg varchar (255),
usuario varchar (255),
senha varchar (255),
adm varchar (255)
);

create table efetivo (
eid  int PRIMARY KEY  auto_increment,
participantes varchar (225),
participantesEb varchar (255),
participantesMb varchar (255),
participantesFab varchar (255),
participantesOs varchar (255),
participantesGov varchar (255),
participantesPv varchar (255),
participantesCv varchar (255)
);

create table operacao (
	opid int PRIMARY KEY auto_increment,
    operador varchar (255),
	operacao varchar (350),
    estado varchar (350),
    missao varchar (350),
    cma varchar (100),
    rm varchar (50),
    comandoOp varchar (199),
    comandoApoio varchar (200),
    inicioOp date ,
    fimOp date 
    );
    
    create table tipoOp (
	tid  int PRIMARY KEY  auto_increment,
	tipoOp varchar (225),
    acaoOuApoio varchar (225),
    transporte varchar (255) ,
    manutencao varchar (255) ,
    aviacao varchar (255) ,
    suprimento varchar (255) ,
    desTransporte varchar (255) ,
    desManutencao varchar (255) ,
    desSuprimento varchar (255) ,
    desAviacao varchar (255) 
    );
    
create table recursos (
	rid  int PRIMARY KEY  auto_increment,
	recebidos varchar (255),
    descentralizados varchar (255),
    empenhados varchar (255),
    devolvidos varchar (255)
    );
    
create table infos (
	iid  int PRIMARY KEY  auto_increment,
	outrasInfos varchar(255)
    );
    
    create table anexos (
    aid int primary key  auto_increment,
    relatorioFinal varchar (255),
    relatorioComando varchar (255) ,
    fotos varchar (255),
    outrosDocumentos varchar (255)
    );