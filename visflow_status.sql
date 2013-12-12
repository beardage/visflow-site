drop table if exists status;
create table status
(
 id         bigint not null auto_increment primary key,
 lastupdate datetime,
 status     int not null
 );

insert into status(id, lastupdate, status) values(1, now(), 1);
insert into status(id, lastupdate, status) values(2, now(), 2);
insert into status(id, lastupdate, status) values(3, now(), 3);