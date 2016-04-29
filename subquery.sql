/*前提条件*/
create database subquery_db;

use subquery_db;

grant all on subquery_db.* to testuser@localhost identified by '9999';

create table sales(
member_id int primary key auto_increment,
sale int,
month int
);
insert into sales (member_id,sale,month) values
  (1 , 75 , 4),
  (2 , 200 , 5),
  (3 , 15 , 6),
  (4 , 700 , 5),
  (5 , 672 , 4),
  (6 , 56 , 8),
  (7 , 231 , 9),
  (8 , 459 , 8),
  (9 , 8 , 7),
  (10 , 120 , 4);


create table members(
member_id int primary key auto_increment,
name varchar(32)
);

create table age(
member_id int primary key auto_increment,
age int
);

insert into members (name) values
  ("Tanaka"),
  ("Sato"),
  ("Suzuki"),
  ("Tsuchiya"),
  ("Yamada"),
  ("Sasaki"),
  ("Harada"),
  ("Takahashi"),
  ("Nishida"),
  ("Nakada");

insert into age (age) values
  (24),
  (25),
  (47),
  (55),
  (39),
  (26),
  (43),
  (33),
  (24),
  (20);

/*1. 最大の売上を出した社員の名前*/

select * from members
where member_id = (select member_id from sales order by sale desc limit 1);

/*2. 売上の平均以上を達成した社員の名前*/

select * from members
where member_id =
any(select member_id from sales where sale >= (select avg(sale) from sales));

/*3. 30代以下の社員が達成した売上の合計*/

select sum(sale) from sales where member_id in (
select member_id from age where age <= 30);