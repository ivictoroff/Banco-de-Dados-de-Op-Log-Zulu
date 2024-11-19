drop database dbmat;
create database dbmat;
use dbmat;

create table usuario(
usuario varchar (255),
senha varchar (255)
);

create table efetivo (
eid  int PRIMARY KEY  auto_increment,
participantes varchar (225),
participantesEb bool,
participantesMb bool,
participantesFab bool,
participantesOs bool,
participantesGov bool,
participantesPv bool,
participantesCv bool
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
	recebidos bool,
    descentralizados bool,
    empenhados bool,
    devolvidos bool
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