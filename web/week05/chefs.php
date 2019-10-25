<?php  
  session_start();

  try
  {
    $dbUrl = getenv('DATABASE_URL');

    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $ex)
  {
    echo 'Error!: ' . $ex->getMessage();
    die();
  }
?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Dinner Menu</title>
    <link rel="stylesheet" type="text/css" href="calendar.css">   
  </head>

<body onload="document.getElementById('random').focus();">

<h1>Weekly Dinner menu</h1> 

<form>







Enter a random number to generate the meals. <br>
<input type="text" style="width: 40px;" id="random" name="random" placeholder="1">
<input type="button" value="Populate calendar" onclick='calendar.php?random="random"'>

<table id="table1">
  <tr>
    <th></th>
    <th></th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
  </tr>
  <tr>
    <td class="tborder" rowspan="3">Breakfast</td>
    <td class="tborder"></td>
    <?php 

      $number = filter_var($_POST["random"], FILTER_SANITIZE_STRING);
      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, MenuItem.meal_id
                           FROM ((MenuItem
                           JOIN Meal ON MenuItem.meal_id = Meal.id) 
                           JOIN MealType ON MenuItem.meal_type = MealType.id)
                           WHERE MenuItem.meal_type = 1
                           ORDER BY RANDOM()
                           LIMIT 5") as $row) {
        //$id = $row['id'];
        $mealid =   $row['meal_id'];
        $mealName = $row['name'];
        echo '<td class="tborder"><h3>';
        echo "<a href='detail.php?id=$mealid'>";
        echo $mealName;
        echo "</a>"; 
        echo '</h3></td>';
        }
    ?>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>chef</td>
    <td>Ava</td>
    <td>Natalie</td>
    <td>Jen</td>
    <td>Ava</td>
    <td>Jen</td>
  </tr>
  <tr>
    <td class="tborder" rowspan="2">Lunch</td>
    <td class="tborder">meal</td>
    <?php
      $query ="SELECT MenuItem.id, Meal.name, MealType.type
               FROM ((MenuItem
               JOIN Meal ON MenuItem.meal_id = Meal.id)
               JOIN MealType ON MenuItem.meal_type = MealType.id)
               WHERE MenuItem.meal_type = 2;";

      $number = filter_var($_POST["random"], FILTER_SANITIZE_STRING);
      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, MenuItem.meal_id
                           FROM ((MenuItem
                           JOIN Meal ON MenuItem.meal_id = Meal.id) 
                           JOIN MealType ON MenuItem.meal_type = MealType.id)
                           WHERE MenuItem.meal_type = 2
                           ORDER BY RANDOM()
                           LIMIT 5") as $row) {
        echo '<td class="tborder"><h3>';
        //$id = $row['id'];
        $mealid = $row['meal_id'];
        $mealName = $row['name'];
        echo "<a href='detail.php?id=$mealid'>";
        echo $mealName;
        echo "</a>"; 
        echo '</h3></td>';
      }
    ?>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td class="tborder" rowspan="3">Dinner</td>
    <td class="tborder"></td>
    <?php 
      $query ="SELECT MenuItem.id, Meal.name, MealType.type
               FROM ((MenuItem
               JOIN Meal ON MenuItem.meal_id = Meal.id) 
               JOIN MealType ON MenuItem.meal_type = MealType.id)
               WHERE MenuItem.meal_type = 4;";

      $number = filter_var($_POST["random"], FILTER_SANITIZE_STRING);
      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, MenuItem.meal_id 
                           FROM ((MenuItem
                           JOIN Meal ON MenuItem.meal_id = Meal.id) 
                           JOIN MealType ON MenuItem.meal_type = MealType.id)
                           WHERE MenuItem.meal_type = 4
                           ORDER BY RANDOM()
                           LIMIT 5") as $row) {
        echo '<td class="tborder"><h3>';
        $mealid = $row['meal_id'];
        // $id = $row['id'];
        $mealName = $row['name'];
        echo "<a href='detail.php?id=$mealid'>";
        echo $mealName;
        echo "</a>"; 
        echo '</h3></td>';
      }

    ?> 
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td>chef</td>
    <td>Janice</td>
    <td>Jen</td>
    <td>Janice</td>
    <td>Jen</td>
    <td>Nate</td>
  </tr>


</table>
</form>


  <script src="calendar.js"></script>

</body> 
</html>