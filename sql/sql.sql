CREATE DATABASE assignment1;

CREATE TABLE pizzaOrders(
	id int not null auto_increment,
    fname VARCHAR(20) not null,
    lname VARCHAR(20) not null,
    phoneNum VARCHAR(12) not null, #705-123-3456
    email VARCHAR(30) not null, # if they have a longer email than 30 chars I don't know I guess no pizza
    toppingOne VARCHAR (15) not null,
    toppingTwo VARCHAR (15) not null,
    toppingThree VARCHAR (15) not null,
    notes VARCHAR(500),
    primary key (id));

INSERT INTO pizzaOrders (fname, lname, phoneNum, email, toppingOne, toppingTwo, toppingThree, notes) 
VALUES ('TheTester', 'Testing', '705-123-3456', 'ILovePizza@pizzacompany.com', 'pepperoni', 'bacon bits', 'pineapple', 'I am testing the notes');

