 
create database Goorgoorlu;

use Goorgoorlu;

create table Admin(
   username varchar(32),
   password varchar(255),
   constraint pk_user primary key(username,password)
);

 
create table Goorgoorlukat(
    id int auto_increment,
    username varchar(32),
    password varchar(255),
    numTel varchar(32),
    nom varchar(32),
    type int(1), #if simple user(no competence setted) / Goorgoorlukat(with 1 comp ore more)
    status int(1), #In the case of a Goorgoorlu , if avalaible or not.
    prenom varchar(32),
    note int, 
    localisation varchar(32),
    constraint pk_id primary key(id)
);

create table job(
    id int auto_increment,
    libelle varchar(32),
    constraint pk_id primary key(id)
);

#In order to managa our notifs system 
create table notifs(
    id int auto_increment,
    id_receiver int,#the one who will receive the notif
    id_sender int,#From who it commes from
    type int, #According to type we will decide what to display as content (0:recues,1:en cours, 2:emises)
    constraint pk_id primary key(id)

);

#represente la table qui lie le travailleur et le job cad -> un travailleur peur effectuer un ou plusieurs travail
create table Gjob(
    id_Gg int,
    id_job int,
    tarif varchar(32), # Example : 2500/heure
    constraint pk_id primary key (id_Gg,id_job),
    constraint fk_gg foreign key(id_Gg) references Goorgoorlukat(id),
    constraint fk_job foreign key(id_job) references job(id)
);
#All the contents added by a Goorgoolukat
#Specifying for who and for which job (display reason)
create table Gcontent(
    id int auto_increment,
    id_Gg int,
    id_job int,
	path varchar(32),
    constraint pk_id primary key (id)
);

insert into Goorgoolukat(username,password,numTel,nom,type,status,prenom,note,localisation) values("Aziz","sy","771974257","Wane","GG","disponible","Cheikh","5","derklke");
insert into Goorgoolukat(username,password,numTel,nom,type,status,prenom,note,localisation) values("blabla","sy","771974257","Wane","GG","disponible","Cheikh","5","derklke");