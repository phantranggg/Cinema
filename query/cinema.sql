create table movie(
	movie_id serial not null,
	title character varying(30) not null,
	score int,
	director character(30) not null,
	country character(20) not null,
	release_date date,
	length int not null,
	subtitle character(10),
	genres character(50) not null,
	rating character(5) not null,
    url_movie varchar(50) not null, 
    constraint pk_movie primary key (movie_id)
);

create table theater(
	theater_id serial not null,
	name char(30) not null,
	email char(20) not null,
	opening_day date,
	hotline char(15) not null,
	street char(20) not null,
	city char(20) not null,
    row_num int not null,
    column_num int not null,
    url_theater varchar(50) not null,
	constraint pk_theater primary key (theater_id)
);

create table users (
	user_id serial not null,
	user_name varchar(40) not null,
	date_of_birth date not null,
	join_date date not null,
	account_type char(10) not null,
	email varchar(30) not null,
	phone char(15) not null,
	address varchar(50),
	is_manager boolean not null,
    password char(30) not null,
	constraint pk_user primary key (user_id)
	);
    
create table schedule(
	schedule_id serial not null,
	movie_id serial not null,
	theater_id serial not null,
	show_time time not null,
	show_date date not null,
	constraint pk_schedule primary key (schedule_id),
	constraint fk_schedule_movie foreign key (movie_id) references movie(movie_id),
	constraint fk_schedule_theater foreign key (theater_id) references theater(theater_id)	
);

create table ticket(
	schedule_id serial not null,
	user_id serial not null,
	buy_time timestamp not null,
	chair_number char(5) not null,
	ticket_type char(10) not null,
	price float not null,
	constraint pk_ticket primary key (schedule_id, user_id),
	constraint fk_ticket_schedule foreign key (schedule_id) references schedule(schedule_id),
	constraint fk_ticket_users foreign key (user_id) references users(user_id)
);

create table likes(
	movie_id serial not null,
	user_id serial not null,
	CONSTRAINT pk_like PRIMARY KEY (movie_id, user_id),
	CONSTRAINT fk_like_movie FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
	CONSTRAINT fk_like_users FOREIGN KEY (user_id) REFERENCES users(user_id)
)