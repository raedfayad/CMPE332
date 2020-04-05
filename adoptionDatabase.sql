create table organization (
	org_name varchar(40) not null primary key, 
	street_num varchar(5) not null, 
	street_name varchar(30) not null, 
	city varchar(20) not null,
	province char(2) not null,
	postal_code char(6) not null,
	phone_num char(10)	
);

create table employee(
	employee_name varchar(40)  not null primary key,
	street_num varchar(5) not null, 
	street_name varchar(30) not null, 
	city varchar(20) not null,
	province char(2) not null,
	postal_code char(6) not null,
	phone_num char(10),
	workplace varchar(40) not null, 
	foreign key (workplace) references organization (org_name) on delete cascade
);	

create table owner(
	owner_name varchar(40) not null,
	workplace varchar(40)  not null,
	primary key (owner_name, workplace),
	foreign key (owner_name) references employee (employee_name),
	foreign key (workplace) references organization (org_name) 
);
	
create table SPCA (	
	org_name varchar(40) not null,
  	adoption_fee integer,
	foreign key (org_name) references organization (org_name) 
);

create table shelter (	
	shelter_name varchar(40) not null,
  	adoption_fee integer,
	website_url varchar(40),
	foreign key (shelter_name) references organization (org_name) 
);

create table shelter_info (
	shelter_name varchar(40) not null,
	a_type varchar(30) not null,
	a_max integer not null, 
	primary key (shelter_name, a_type),
	foreign key (shelter_name) references shelter (shelter_name) on delete cascade 
);
	
create table rescuer (
	rescuer_name varchar(40) not null,
	foreign key (rescuer_name) references organization (org_name) 
);

create table family (
	last_name varchar(20) not null,
	phone_num char(10) not null,
	street_num varchar(5) not null, 
	street_name varchar(30) not null, 
	city varchar(20) not null,
	province char(2) not null,
	primary key (last_name, phone_num)
);

create table driver(
	name varchar(40) not null primary key,
	emergency_phone char(10) not null,
	drivers_license varchar(20),
	license_plate varchar(7),
	rescuer_org varchar(40), 
	foreign key (rescuer_org) references rescuer (rescuer_name) on delete cascade
);

create table animal (
	id integer not null primary key,
	animal_type varchar(20) not null,
	arrival_date date not null,
	departure_date date,
	spca_branch varchar(40) not null,
	shelter_branch varchar(40),
	driver_name varchar(40),
	family_name varchar(20),
	family_num char(10), 
	foreign key (spca_branch) references SPCA (org_name),
	foreign key (shelter_branch) references shelter (shelter_name),
	foreign key (driver_name) references driver (name),
	foreign key (family_name, family_num) references family (last_name, phone_num)
	
);

create table vet_visit (
	vet_name varchar(40) not null, 
	reason varchar(300) not null, 
	animal_weight_kg integer not null, 
	visit_date date not null,
	animal_id integer not null,
	appt_id integer not null primary key,
	foreign key (animal_id) references animal (id)
);

create table donations (
	donator_name varchar(40) not null, 
	amount integer not null, 
	donation_date date not null, 
	org_name varchar(40) not null,
	primary key (donator_name, amount, donation_date, org_name),
	foreign key (org_name) references organization (org_name) 
);

