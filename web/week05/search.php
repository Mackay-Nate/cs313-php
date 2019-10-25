<?php

?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Search options</title>
    <link rel="stylesheet" type="text/css" href="calendar.css">   
  </head>

<body>

  <h1>Menu database search options:</h1>

  <div id="options">
    <h3>Please choose how you would like to view your meals</h3>
    <!--drop down menu -->
    <form onsubmit="return false;">
      <button value="week" name="options"  type="button" onclick="show('week')">View the whole week</button><br>
      <button value="day" name="options" type="button" onclick="show('day')">View one day this week</button><br>
      <button value="meals" name="options" type="button" onclick="show('meals')">View one meal for this week</button><br>
      <button value="chef" name="options" onclick="chef.php">List of Chefs</button>
    </form>

    <!--view the entire week options-->
    <form class="hidden" id="week" method="post" action="week.php">
      <h4>Select a week</h4>
      <input type="text" placeholder="1-52" name="week"><br>
      <input type="submit" class="submit">
    </form>

    <!--by day options-->
    <form class="hidden" id="day" method="post" action="day.php">
      <h4>Select a day</h4>
      <input type="radio" name="day" value="monday">Monday<br>
      <input type="radio" name="day" value="tuesday">Tuesday<br>
      <input type="radio" name="day" value="wednesday">Wednesday<br>
      <input type="radio" name="day" value="thursday">Thursday<br>
      <input type="radio" name="day" value="friday">Friday<br>
      <input type="submit" class="submit">
    </form>

    <!--view by meal-->
    <form class="hidden" id="meals" method="post" action="meal.php">
      <h4>Select a meal</h4>
      <input type="radio" name="meal" value="1">breakfast<br>
      <input type="radio" name="meal" value="2">lunch<br>
      <input type="radio" name="meal" value="4">dinner<br>
      <input type="submit" class="submit">
    </form>

  </div>

  <div id="manipulate">
    <h3>Manipulating the list of meals:</h3>
    <!--3 buttons to choose from-->
    <button type="button" id="add" value="Add a meal" onclick="show('form2')">Add a meal</button><br>
    <form method="post" action="insert.php" class="hidden" id="form2">
      <table id="add">
        <tr><th colspan="2"><h3>Adding a meal</h3></th></tr>
        <tr><td>Meal name</td> 
          <td><input type="text" name="meal_name"></td></tr>
        <tr><td>What is the cook time?</td>
          <td><input type="text" name="cook" placeholder="00:00"></td></tr>
        <tr><td>How long does it take to prepare?</td>
          <td><input type="text" name="prep" placeholder="00:00"></td></tr>
        <tr><td colspan="2">
          <?php 

          ?>
          <input type="checkbox" name="type" value="breakfast">Breakfast
          <input type="checkbox" name="type" value="lunch">Lunch
          <input type="checkbox" name="type" value="dinner">Dinner</td></tr>
        <tr><td></td><td><input type="submit"></td></tr>
      </table>
    </form>
    
    <button type="button" id="edit" value="Edit a meal">Edit a meal</button><br>
    <?php
    
    ?>

    <button type="button" id="delete" value="Delete a meal">Delete a meal</button><br>
    <?php

    ?>
    
    </div>
    
  <script src="calendar.js"></script>
</body>
</html>