create database eleja;

use eleja;

create table turma(
idturma int primary key auto_increment,
periodo int not null,
curso varchar(60) not null
);

create table aluno(
idaluno int primary key auto_increment,
nome varchar(120) not null,
idturma int not null,
constraint fk_turma_aluno foreign key (idturma) references turma (idturma)
);

create table usuario(
idusuario int primary key auto_increment,
email varchar(120) not null,
senha varchar(60) not null,
tipo enum("aluno", "administrador"),
idaluno int null,
constraint fk_aluno_usuario foreign key (idaluno) references aluno (idaluno)
);

create table candidatura(
idcandidatura int primary key auto_increment,
dataIncio date not null,
dataFim date not null,
idturma int not null,
constraint fk_turma_candidatura foreign key (idturma) references turma (idturma)
);

create table votacao(
idvotacao int primary key auto_increment,
dataIncio date not null,
dataFim date not null,
idcandidatura int not null,
constraint fk_candidatura_votacao foreign key (idcandidatura) references candidatura (idcandidatura)
);

create table candidato(
idcandidato int primary key auto_increment,
idaluno int not null,
idcandidatura int not null,
constraint fk_aluno_candidato foreign key (idaluno) references aluno (idaluno),
constraint fk_candidatura_candidato foreign key (idcandidatura) references candidatura (idcandidatura)
);

create table ata(
idata int primary key auto_increment,
presidente varchar(60) not null,
vice varchar(60) not null,
totalVoto int not null,
idvotacao int not null,
constraint fk_votacao_ata foreign key (idvotacao) references votacao (idvotacao)
);

create table voto(
idvoto int primary key auto_increment,
idaluno int not null,
idcandidato int not null,
constraint fk_aluno_voto foreign key (idaluno) references aluno (idaluno),
constraint fk_candidato_voto foreign key (idcandidato) references candidato (idcandidato)
);







