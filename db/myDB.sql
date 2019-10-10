
--creation of the Menu db 10/8
CREATE TABLE Menu (
  id           SERIAL NOT NULL PRIMARY KEY,
  name,        varchar(80) NOT NULL,
  type,        varchar(16), 
  prepTime,    time, 
  cookTime,    time, 
  frequency,   int, 
  ingredients, varchar(255)
);

--creation of the Member db 10/8
CREATE TABLE Member (
  id          SERIAL NOT NULL PRIMARY KEY,
  firstName,  varchar(16) NOT NULL UNIQUE
);

--data/template with the db
INSERT INTO Menu VALUES ('name', 'type', prepTime, cookTime, frequency, 'ingredients');
INSERT INTO Menu VALUES ('', '', '', '', , ''); 
INSERT INTO Member VALUES('firstName');

--Member db inserted 10/8
INSERT INTO Member VALUES('Nate');
INSERT INTO Member VALUES('Jen');
INSERT INTO Member VALUES('grandma');
INSERT INTO Member VALUES('grandpa');
INSERT INTO Member VALUES('Natalie');
INSERT INTO Member VALUES('Ava');
INSERT INTO Member VALUES('Corbin');

--Menu db inserted 10/8
INSERT INTO Menu VALUES ('Oatmeal', 'breakfast', '00:00', '00:10', 8, 'oats, milk, water, peanut_butter, chocolate_chips, cinnamon, apple_sauce');
INSERT INTO Menu VALUES ('Eggs', 'breakfast', '00:02', '00:10', 4, 'eggs, milk');
INSERT INTO Menu VALUES ('French toast', 'breakfast', '00:03', '00:15', 3, 'bread, eggs, milk');
INSERT INTO Menu VALUES ('Coffee cake', 'breakfast', '00:10', '00:35', 1, 'coffee, cake');
INSERT INTO Menu VALUES ('Breakfast burrito', 'breakfast', '00:15', '00:15', 3, 'tortillas, eggs, sausage, cheese, milk');
INSERT INTO Menu VALUES ('ramen', 'lunch', '00:00', '00:04', 3, 'ramen');

--Menu db inserted 10/9
INSERT INTO Menu VALUES ('cereal', 'breakfast', '00:00', '00:00', 2, 'cereal');
INSERT INTO Menu VALUES ('sandwiches', 'lunch', '00:05', '00:00', 2, 'bread, cheese, deli_meat, pickles, ketchup, mustard');
INSERT INTO Menu VALUES ('left overs', 'lunch', '00:01', '00:00', 4, 'left overs');
INSERT INTO Menu VALUES ('quesidillas', 'lunch', '00:10', '00:15', 3, 'tortillas, cheese, meat, peppers');
INSERT INTO Menu VALUES ('omlets', 'breakfast', '00:02', '00:08', 3, 'eggs, peppers, cheese');
INSERT INTO Menu VALUES ('pancakes', 'breakfast', '00:10', '00:15', 2, 'flour, sugar, salt, eggs, oil, milk, baking soda, baking powder');
INSERT INTO Menu VALUES ('waffles', 'breakfast', '00:10', '00:20', 2, 'flour, sugar, salt, eggs, oil, milk, baking soda, baking powder');
INSERT INTO Menu VALUES ('mac & cheese', 'lunch', '00:00', '00:04', 1, 'mac & cheese');
INSERT INTO Menu VALUES ('corn dogs', 'lunch', '00:00', '00:01', 1, 'corn dogs');
--dinner ideas 
INSERT INTO Menu VALUES ('hot dogs', 'dinner', '00:00', '00:02', 1, 'hot dogs, buns, ketchup, mustard, pickles');
INSERT INTO Menu VALUES ('lasagna', 'dinner', '00:10', '00:45', 1, 'noodles, cheedar cheese, mozzarella cheese, cottage cheese, ground beef, onion, tomato paste, basil, garlic powder, parsley');
INSERT INTO Menu VALUES ('sausage soup', 'dinner', '00:20', '04:00', 1, 'sausage, potatoes, onion, celery, carrots, corn, chicken broth, evaporated milk, cheddar cheese');
INSERT INTO Menu VALUES ('tuna roll', 'dinner', '00:20', '00:40', 2, 'flour, salt, butter, cheese, onion, evaporated milk, marjoram, thyme, tuna, parsley, egg');
INSERT INTO Menu VALUES ('cafe rio chicken', 'dinner', '00:30', '08:00', 1, 'chicken, salsa, brown sugar');
INSERT INTO Menu VALUES ('cafe rio pork', 'dinner', '00:30', '03:00', 1, 'pork roast, brown sugar, pace picante sauce, tortillas, cheese, lettuce, rice, diced tomatoes, dressing');
INSERT INTO Menu VALUES ('ham, eggs, & potatoes', 'dinner', '00:15', '03:30', 1, 'cubed ham, eggs, potatoes, oil, onions, peppers, evaporated milk');

