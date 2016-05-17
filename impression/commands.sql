create database impression;

use impression;
grant all on impression.* to testuser@localhost identified by "1234";

create table posts(
id int primary key auto_increment,
name varchar(32),
impression varchar(32),
created_at datetime
);

alter table posts add image blob;
alter table posts add mime-type ;
