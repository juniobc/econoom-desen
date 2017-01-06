create sequence sq_id_album increment 1 minvalue 0 maxvalue 99999;

create table album(

    id int default nextval('sq_id_album') not null unique,
    artist varchar(100) NOT NULL,
    title varchar(100) NOT NULL,
    primary key(id)

);