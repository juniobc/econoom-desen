
/*Tabela de Material*/
create table t001(

    cd_barra int not null unique,
    nm_mat varchar(100) NOT NULL,
    marca_mat varchar(100) NOT NULL,
    cd_emb int NOT NULL,
    cd_un_med int NOT NULL,
    qt_un_medida float NOT NULL,
    preco_mat float NOT NULL,
    lat_mat float8 NOT NULL,
    long_mat float8 NOT NULL,
    
    primary key(cd_barra),
    
    foreign key(cd_emb) references t002(cd_emb),
    foreign key(cd_un_med) references t003(cd_un_med)

);

/*Tabela Embalagens*/
create sequence sq_cd_emb_t002 increment 1 minvalue 0 maxvalue 99;


create table t002(

    cd_emb int default nextval('sq_cd_emb_t002') not null unique,
    nm_emb varchar(50) not null,
    primary key(cd_emb)
    
);

insert into t002(nm_emb) values('GARRAFA PET');


/*Tabela unidade de medida*/
create sequence sq_cd_un_med_t003 increment 1 minvalue 0 maxvalue 999;


create table t003(

    cd_un_med int default nextval('sq_cd_un_med_t003') not null unique,
    nm_un_med varchar(15) not null,
    alias_un_medida varchar(5) not null,
    primary key(cd_un_med)
    
);

insert into t003(nm_un_med, alias_un_medida) values('LITRO', 'L');
insert into t003(nm_un_med, alias_un_medida) values('GRAMA', 'G');
insert into t003(nm_un_med, alias_un_medida) values('KILOGRAMA', 'KG');
insert into t003(nm_un_med, alias_un_medida) values('METRO', 'M');
insert into t003(nm_un_med, alias_un_medida) values('UNIDADE', 'UN');
insert into t003(nm_un_med, alias_un_medida) values('MILILITRO', 'ML');