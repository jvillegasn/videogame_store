
drop schema store_records;
create schema store_records;
use store_records;

/*drop table Customers;
drop table Consoles;
drop table Games;
drop table Inventory;*/

create table Customers(
	id int AUTO_INCREMENT,
  name varchar(25) NOT NULL,
  address varchar(100),
	age int,
	sex CHAR(1) DEFAULT '-',
	phone CHAR(10) UNIQUE,
	email VARCHAR(40) UNIQUE,
	PRIMARY KEY(id)
);

DELIMITER $$
create trigger customer_trigg
BEFORE INSERT ON Customers
FOR EACH ROW
BEGIN
		DECLARE msg VARCHAR(255);
		IF(NEW.sex NOT IN('M', 'F')) THEN
        SET NEW.sex = '-';
    END IF;
		IF(NEW.age < 15) THEN
        SET msg := 'Error: age not allowed (15+)';
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
    END IF;
		IF(LENGTH(NEW.phone) < 10) THEN
        SET msg := 'Error: phone must have 10 digits.';
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
    END IF;
END$$
DELIMITER ;

insert into Customers values(40000, 'Javier Villegas', '1047 Commonwealth Avenue, Boston, MA 02215', 23, 'M', '6178179099', 'javier.vn95@gmail.com');
insert into Customers values(40001, 'Fiorella Espinoza', '887 Commonwealth Avenue, Boston, MA 02215', 21 ,'F', '9994001221', 'fio.ec@hotmail.com');
insert into Customers values(40002, 'Jorge Espinoza', '232 Chapel St, Newtown, MA 02454', 22, 'M', '8179090099', 'jespinoza10@outlook.com');
insert into Customers values(40003, 'Jaime Villegas', '477 Hartford St, Westwood, MA 02050', 35, 'M', '7073214000', 'jvillegas@yahoo.com');
insert into Customers values(40004, 'Taylor White', '466 First Street, Holbrook, MA 02100', 40, 'M', '8171003000', 'wtaylor@gmail.com');
insert into Customers values(40005, 'Sara Washington', '73 High Street, Washington, WA, 02145', 27, 'F', '9090003030', 'sara.w90@gmail.com');
insert into Customers values(40006, 'Lara Jones', '20 Park Street, Los Angeles, CA, 02001', 31, 'F', '7011123003', 'lara19_j@hotmail.com');
insert into Customers values(40007, 'David Smith', '100 Main Street, Washington, WA, 02145', 18, 'M', '6082214422', 'davidsmith.30@outlook.com');
insert into Customers values(40008, 'Steve Lee', '22 Sixth Street, Chicago, IL, 02550', 22, 'F', '9876543121', 'steve_l20@hotmail.com');
insert into Customers values(40009, 'Karen Diaz', '312 First Street, Boston, MA, 02234', 25, 'M', '9994041222', 'k_diaz2000@yahoo.com');

create table Inventory(
  item_id int,
  in_stock tinyint DEFAULT 1,
  PRIMARY KEY(item_id)
);

insert into Inventory values(100000, 1);
insert into Inventory values(100001, 1);
insert into Inventory values(100002, 1);
insert into Inventory values(100003, 1);
insert into Inventory values(100004, 1);
insert into Inventory values(100005, 1);
insert into Inventory values(100006, 1);
insert into Inventory values(100007, 1);
insert into Inventory values(100008, 1);
insert into Inventory values(100009, 1);
insert into Inventory values(200000, 1);
insert into Inventory values(200001, 1);
insert into Inventory values(200002, 1);
insert into Inventory values(200003, 1);
insert into Inventory values(200004, 1);
insert into Inventory values(200005, 1);
insert into Inventory values(200006, 1);
insert into Inventory values(200007, 1);
insert into Inventory values(200008, 1);
insert into Inventory values(200009, 1);

DELIMITER $$
create trigger Inventory_trigg
BEFORE INSERT ON Inventory
FOR EACH ROW
BEGIN
	DECLARE msg VARCHAR(255);
  IF(NEW.item_id NOT BETWEEN 100000 AND 300000-1) THEN
		SET msg := 'Error: item_id must be 6 digit between [100000, 300000]';
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
	END IF;
END$$
DELIMITER ;

create table Consoles(
  item_id int,
  name varchar(25) NOT NULL,
  manuf varchar(25),
	price FLOAT,
  foreign key (item_id) references Inventory(item_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
	PRIMARY KEY(item_id)
);

insert into Consoles values(200000,'XBOX One', 'Microsoft', 399.99);
insert into Consoles values(200001,'PlayStation 4 Slim', 'Sony', 349.99);
insert into Consoles values(200002,'Nintendo Switch', 'Nintendo', 299.99);
insert into Consoles values(200003,'NEW Nintendo 3DS XL', 'Nintendo', 129.99);
insert into Consoles values(200004,'NEW Nintendo 2DS XL', 'Nintendo', 99.99);
insert into Consoles values(200005,'XBOX 360', 'Microsoft', 119.99);
insert into Consoles values(200006,'PlayStation 3', 'Sony', 119.99);
insert into Consoles values(200007,'PlayStation 4 Pro', 'Sony', 449.99);
insert into Consoles values(200008,'XBOX One X', 'Microsoft', 499.99);
insert into Consoles values(200009,'SUPER Nintendo', 'Nintendo', 79.99);

DELIMITER $$
create trigger DeleteConsole_trigg
AFTER DELETE ON Consoles
FOR EACH ROW
BEGIN
  DELETE FROM Inventory where item_id=OLD.item_id;
END$$
DELIMITER ;

DELIMITER $$
create trigger PriceConsole_trigg
BEFORE INSERT ON Consoles
FOR EACH ROW
BEGIN
	DECLARE msg VARCHAR(255);
	IF(NEW.price <= 0) THEN
		SET msg := 'Error: item price has to be postive float';
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
END IF;
END$$
DELIMITER ;

create table Games(
  item_id int,
  title varchar(25) NOT NULL,
  platform varchar(25) NOT NULL,
  manuf varchar(25),
	price float,
  foreign key (item_id) references Inventory(item_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	PRIMARY KEY (item_id)
);

DELIMITER $$
create trigger DeleteGame_trigg
AFTER DELETE ON Games
FOR EACH ROW
BEGIN
  DELETE FROM Inventory where item_id=OLD.item_id;
END$$
DELIMITER ;

DELIMITER $$
create trigger PriceGame_trigg
BEFORE INSERT ON Games
FOR EACH ROW
BEGIN
	DECLARE msg VARCHAR(255);
	IF(NEW.price <= 0) THEN
		SET msg := 'Error: item price has to be postive float';
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
END IF;
END$$
DELIMITER ;

insert into Games values(100000,'FIFA 19','Xbox One','Electronic Arts', 59.99);
insert into Games values(100001,'FIFA 19','PlayStation 4','Electronic Arts', 59.99);
insert into Games values(100002,'Call Of Duty: Black Ops 4','Xbox One','Activision', 47.99);
insert into Games values(100003,'Mario Kart 8 Deluxe','Nintendo Switch','Nintendo', 59.99);
insert into Games values(100004,'Dragon Ball Xenoverse 2','Xbox One', 'Dimps', 29.99);
insert into Games values(100005,'Dragon Ball Fighter Z','Xbox One','Dimps', 49.99);
insert into Games values(100006,'Dragon Ball Fighter Z','PlayStation 4','Dimps', 49.99);
insert into Games values(100007,'Dragon Ball Fighter Z','Nintendo Switch','Dimps', 49.99);
insert into Games values(100008,'Super Smash Bros Ultimate','Nintendo Switch','Nintendo', 59.99);
insert into Games values(100009,'God Of War 4','PlayStation 4','Santa Monica Studio', 49.99);

create table Customer_Console(
	own_id int AUTO_INCREMENT,
	cust_id int,
	cons_id int,
	foreign key (cust_id) references Customers(id)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	foreign key (cons_id) references Consoles(item_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	PRIMARY KEY(own_id)
);

DELIMITER $$
create trigger SellConsole_trigg
BEFORE INSERT ON Customer_Console
FOR EACH ROW
BEGIN
	DECLARE msg VARCHAR(255);
	IF((SELECT in_stock FROM Inventory WHERE item_id=NEW.cons_id) = 0) THEN
		SET msg := 'Error: item is not in stock!';
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
	ELSE
		UPDATE Inventory SET in_stock=0 WHERE item_id=NEW.cons_id;
	END IF;
END$$
DELIMITER ;

DELIMITER $$
create trigger ReturnConsole_trigg
AFTER DELETE ON Customer_Console
FOR EACH ROW
BEGIN
	DECLARE msg VARCHAR(255);
	IF((SELECT in_stock FROM Inventory WHERE item_id=OLD.cons_id) = 1) THEN
		SET msg := 'Error: item already in stock!';
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
	ELSE
		UPDATE Inventory SET in_stock=1 WHERE item_id=OLD.cons_id;
	END IF;
END$$
DELIMITER ;

insert into Customer_Console values(0, 40000, 200000);
insert into Customer_Console values(1, 40000, 200003);
insert into Customer_Console values(2, 40003, 200001);
insert into Customer_Console values(3, 40004, 200009);
insert into Customer_Console values(4, 40009, 200007);

create table Customer_Game(
	own_id int AUTO_INCREMENT,
	cust_id int,
	game_id int,
	foreign key (cust_id) references Customers(id)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	foreign key (game_id) references Games(item_id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	PRIMARY KEY(own_id)
);

DELIMITER $$
create trigger SellGame_trigg
BEFORE INSERT ON Customer_Game
FOR EACH ROW
BEGIN
	DECLARE msg VARCHAR(255);
	IF((SELECT in_stock FROM Inventory WHERE item_id=NEW.game_id) = 0) THEN
		SET msg := 'Error: item is not in stock!';
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
	ELSE
		UPDATE Inventory SET in_stock=0 WHERE item_id=NEW.game_id;
	END IF;
END$$
DELIMITER ;

DELIMITER $$
create trigger ReturnGame_trigg
AFTER DELETE ON Customer_Game
FOR EACH ROW
BEGIN
	DECLARE msg VARCHAR(255);
	IF((SELECT in_stock FROM Inventory WHERE item_id=OLD.game_id) = 1) THEN
		SET msg := 'Error: item already in stock!';
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
	ELSE
		UPDATE Inventory SET in_stock=1 WHERE item_id=OLD.game_id;
	END IF;
END$$
DELIMITER ;

insert into Customer_Game values(0, 40000, 100000);
insert into Customer_Game values(1, 40000, 100009);
insert into Customer_Game values(2, 40005, 100001);
insert into Customer_Game values(3, 40006, 100002);
insert into Customer_Game values(4, 40003, 100005);
