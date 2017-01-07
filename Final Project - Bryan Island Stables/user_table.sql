/*
Robert Fink
rwfwcb
CMP_SC 2830 FINAL PROJECT
Bryan Island Stables
*/

create table barn_user(
  email varchar(250) PRIMARY KEY NOT NULL,
  salt varchar(20) NOT NULL,
  hashed_password varchar(256) NOT NULL,
  user_type varchar(10) NOT NULL
)ENGINE=INNODB;

create table message(
  ID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  sender varchar(250) NOT NULL,
  reciever varchar(250) NOT NULL,
  subject varchar(100),
  content varchar(256) NOT NULL,
  FOREIGN KEY (reciever) REFERENCES barn_user(email)
)ENGINE=INNODB;
