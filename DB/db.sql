create database scraper;
use scraper;
create table accounts
(
    id       int auto_increment
        primary key,
    username varchar(150) null,
    password varchar(150) null
);

create table sites
(
    id         int auto_increment
        primary key,
    page_url   varchar(100) null,
    account_id int          null,
    page_name  varchar(150) null,
    constraint page_account__fk
        foreign key (account_id) references accounts (id)
);

create table links
(
    id      int auto_increment
        primary key,
    name    varchar(100) null,
    url     varchar(150) null,
    page_id int          null,
    constraint links_page__fk
        foreign key (page_id) references sites (id)
);