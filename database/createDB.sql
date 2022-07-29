create database if not exists bootcamp_sivirilova;
use bootcamp_sivirilova;
create table category (
	category_id int auto_increment,
    name varchar(40) not null unique,
    description varchar(200),
    primary key (category_id)
);
create table image (
	image_id int auto_increment,
    url varchar(200) not null unique,
    alt varchar(200) not null,
    primary key (image_id)
);
create table product (
	product_id int auto_increment,
    name varchar(40) not null unique,
    price int unsigned not null,
    price_sale int unsigned, -- без not null: возможно товар без скидки
    price_promocode int unsigned, -- без not null: возможно не действует промокод
    main_category int not null,
	main_image int not null,
    description varchar(200) not null,
    is_active bool not null, -- есть ли товар в продаже
    primary key (product_id),
    foreign key (main_category) references category(category_id) on delete cascade on update cascade,
    foreign key (main_image) references image(image_id) on delete cascade on update cascade
);
create table product_category (
	category_id int not null,
    product_id int not null,
	foreign key (category_id) references category(category_id) on delete cascade on update cascade,
    foreign key (product_id) references product(product_id) on delete cascade on update cascade
);
create table product_image(
	image_id int not null,
    product_id int not null,
    foreign key (image_id) references image(image_id) on delete cascade on update cascade,
    foreign key (product_id) references product(product_id) on delete cascade on update cascade
);