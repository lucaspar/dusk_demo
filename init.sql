create database dusk_demo;
create user dusker@localhost identified by 'password';
grant all privileges on dusk_demo.* to dusker@localhost;
flush privileges;
