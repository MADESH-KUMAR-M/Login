create table `test`.`login`
(`id` int(2) auto_increment primary key , 
`user` varchar(50) ,
`email` varchar(50),
`password` varchar(50),
`reg_time` timestamp default current_timestamp on update current_timestamp);