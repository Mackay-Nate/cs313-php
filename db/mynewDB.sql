--creation of the Menu db 
CREATE TABLE Menu (
  id          SERIAL NOT NULL PRIMARY KEY,
  menu_item   INT NOT NULL REFERENCES MenuItem(id),
  clean_up    INT NOT NULL REFERENCES Member(id),
);

--creation of MenuItem db 
CREATE TABLE MenuItem (
  id         SERIAL NOT NULL PRIMARY KEY,
  meal_type  INT NOT NULL REFERENCES MealType(id),
  meal_id    INT NOT NULL REFERENCES Meal(id)
);

--creation of Meal db 
CREATE TABLE Meal (
  id          SERIAL NOT NULL PRIMARY KEY,
  name        varchar(80) NOT NULL,
  prepTime    time, 
  cookTime    time, 
  frequency   int, 
  --ingredients REFERENCES ingredient(id)
);

--creation of the Member db 
CREATE TABLE Member (
  id          SERIAL NOT NULL PRIMARY KEY,
  firstName   varchar(16) NOT NULL UNIQUE
);

--creation of types of meals db 
CREATE TABLE MealType (
  id         SERIAL NOT NULL PRIMARY KEY,
  type       varchar(16)
);

--creation of a list of ingredients
CREATE TABLE ingredient (
  id         SERIAL NOT NULL PRIMARY KEY, 
  ingredient varchar(30)
);

--create a list of ingredients for each meal 
CREATE TABLE MenuIngredient ( 
  id         SERIAL NOT NULL PRIMARY KEY,
  meal_id    REFERENCES Meal(id),
  ingredient REFERENCES ingredient)id)
);

INSERT INTO MealType (type) VALUES ('breakfast');
INSERT INTO MealType (type) VALUES ('lunch');
INSERT INTO MealType (type) VALUES ('snack');
INSERT INTO MealType (type) VALUES ('dinner');

INSERT INTO Member (firstName) VALUES ('Nate');
INSERT INTO Member (firstName) VALUES ('Jen');
INSERT INTO Member (firstName) VALUES ('Grandpa');
INSERT INTO Member (firstName) VALUES ('Grandma');
INSERT INTO Member (firstName) VALUES ('Natalie');
INSERT INTO Member (firstName) VALUES ('Ava');
INSERT INTO Member (firstName) VALUES ('Corbin');
INSERT INTO Member (firstName) VALUES ('William');

--INSERT INTO Meal (name, prepTime, cookTime) VALUES ('', '00:', '00:'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Oatmeal', '00:00', '00:10'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Eggs', '00:02', '00:10'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('French Toast', '00:03', '00:15'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Coffee Cake', '00:10', '00:35'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Breakfast burritos', '00:15', '00:15'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('cereal', '00:00', '00:00'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Omlets', '00:05', '00:10'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Pancakes', '00:10', '00:15'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Waffles', '00:10', '00:20'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Breakfast sandwiches', '00:15', '00:10'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Swedish pancakes', '00:10', '00:20');
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('German pancakes', '00:05', '00:35');
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Biscuits & gravy', '00:15', '00:15');


INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Ramen', '00:00', '00:04'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('sandwiches', '00:05', '00:00'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('leftovers', '00:02', '00:00'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Quesidillas', '00:10', '00:15'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Mac & Cheese', '00:00', '00:04'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Corn dogs', '00:00', '00:01'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Hot dogs', '00:00', '00:02'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Bagels', '00:02', '00:00'); 

INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Lasagna', '00:10', '00:45'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Sausage soup', '00:20', '04:00'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Tuna roll', '00:20', '00:40'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('CafeRio chicken', '00:30', '08:00'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('CafeRio pork', '00:30', '03:00'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Ham, Eggs, & Potatoes', '00:15', '03:00:'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Fettuccine Alfredo', '00:00', '00:15'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Spaghetti', '00:00', '00:15'); 
INSERT INTO Meal (name, prepTime, cookTime) VALUES ('Chicken, Rice, & Broccoli', '00:20', '03:00'); 


INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '1');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '2');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '3');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '4');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '5');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '6');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '7');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '8');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '9');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '10');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '11');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '12');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('1', '30');

INSERT INTO MenuItem (meal_type, meal_id) VALUES ('2', '13');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('2', '14');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('2', '15');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('2', '16');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('2', '17');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('2', '18');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('2', '19');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('2', '20');

INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '2');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '3');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '4');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '5');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '7');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '8');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '9');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '10');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '11');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '12');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '14');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '15');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '16');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '17');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '18');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '19');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '20');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '21');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '22');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '23');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '24');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '25');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '26');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '27');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '28');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '29');
INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '30');

/*query for dinner meal order by menuitem id   */
SELECT MenuItem.id, Meal.name, MealType.type, Meal.id
FROM ((MenuItem
JOIN Meal ON MenuItem.meal_id = Meal.id) 
JOIN MealType ON MenuItem.meal_type = MealType.id)
WHERE MenuItem.meal_type = 4

ORDER BY MenuItem.id
LIMIT 5

/* correct an item */
UPDATE MenuItem 
SET meal_type = '4', meal_id = '23'
WHERE id = 40;

/*switched some meals around*/
UPDATE MenuItem SET meal_type='4', meal_id=3 Where id=22

ALTER TABLE Meal ADD prep int;
ALTER TABLE Meal ADD cook int;

UPDATE Meal SET prep=0, cook=10 WHERE id=1;
UPDATE Meal SET prep=2, cook=10 WHERE id=2;
UPDATE Meal SET prep=3, cook=15 WHERE id=3;
UPDATE Meal SET prep=10, cook=35 WHERE id=4;
UPDATE Meal SET prep=15, cook=15 WHERE id=5;
UPDATE Meal SET prep=0, cook=0 WHERE id=6;
UPDATE Meal SET prep=5, cook=10 WHERE id=7;
UPDATE Meal SET prep=10, cook=15 WHERE id=8;
UPDATE Meal SET prep=10, cook=20 WHERE id=9;
UPDATE Meal SET prep=15, cook=10 WHERE id=10;
UPDATE Meal SET prep=10, cook=20 WHERE id=11;
UPDATE Meal SET prep=5, cook=35 WHERE id=12;
UPDATE Meal SET prep=0, cook=4 WHERE id=13;
UPDATE Meal SET prep=5, cook=0 WHERE id=14;
UPDATE Meal SET prep=2, cook=0 WHERE id=15;
UPDATE Meal SET prep=10, cook=15 WHERE id=16;
UPDATE Meal SET prep=0, cook=4 WHERE id=17;
UPDATE Meal SET prep=0, cook=1 WHERE id=18;
UPDATE Meal SET prep=0, cook=2 WHERE id=19;
UPDATE Meal SET prep=2, cook=0 WHERE id=20;
UPDATE Meal SET prep=10, cook=45 WHERE id=21;
UPDATE Meal SET prep=20, cook=240 WHERE id=22;
UPDATE Meal SET prep=20, cook=40 WHERE id=23;
UPDATE Meal SET prep=30, cook=480 WHERE id=24;
UPDATE Meal SET prep=30, cook=180 WHERE id=25;
UPDATE Meal SET prep=15, cook=180 WHERE id=26;
UPDATE Meal SET prep=0, cook=15 WHERE id=27;
UPDATE Meal SET prep=0, cook=15 WHERE id=28;
UPDATE Meal SET prep=20, cook=180 WHERE id=29;
UPDATE Meal SET prep=15, cook=15 WHERE id=30;

