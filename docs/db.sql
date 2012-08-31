--购物车数据库设计
--20120713
--author: lixm666@gamil.com

drop database shopdb;
create database shopdb;
use shopdb;

set names utf8;

create table users
(
    id int primary key,
    name varchar(64) not null default '',
    pwd char(32) not null default '',
    email varchar(128) not null default '',
    tel varchar(128) not null default '',
    grade tinyint unsigned not null default 1
) engine=myisam default charset=utf8;

insert into users(id,name,pwd,email,tel,grade) 
    values(101,'xiaoming',md5('xiaoming'),'lixueming666@126.com','13810894472',1),
    (100,'lixm',md5('lixm'),'lixueming666@126.com','13810894472',1);

create table book
(
    id int primary key auto_increment,
    name varchar(64) not null default '',
    author varchar(64) not null default '',
    publishHouse varchar(128) not null default '',
    price float not null default 0,
    nums int not null default 10
) engine=myisam default charset=utf8;

insert into book(name,author,publishHouse,price,nums) 
    values('php应用开发详解','萧峰','电子工业出版社',59,100),
    ('php Web服务开发','谭美君','电子工业出版社',45,100),
    ('php编程思想','小红','机械工业出版社',99,1000),
    ('php编程指南','王芳','电子工业出版社',68,1000),
    ('php应用开发详解','小健','电子工业出版社',56,1000),
    ('php参考手册','小星','电子工业出版社',56,1000),
    ('php Web服务开发','雪明','电子工业出版社',550,10000);

create table mycart
(
    id int unsigned primary key auto_increment,
    userid int,
    bookid int,
    nums int unsigned,
    cartDate int unsigned,
    foreign key(userid) references users(id),
    foreign key(bookid) references book(id)
) engine=myisam default charset=utf8;

create table orders
(
    id int primary key auto_increment,
    userId int not null,
    totalPrice float not null default 0,
    orderDate int unsigned not null,
    foreign key(userId) references users(id)
) engine=myisam default charset=utf8;

create table ordersItem
(
    id int primary key auto_increment,
    ordersId int,
    bookId int,
    bookNum int not null default 0,
    foreign key(ordersId) references orders(id),
    foreign key(bookId) references book(id)
) engine=myisam default charset=utf8;
