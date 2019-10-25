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

  $day = $_POST['day'];
  echo $day;
  $week = date('W');
  echo "<br>week: " . $week;

  switch ($day) { 
    case "monday":
      $day = "Monday";
      $addon = 0;
      break;
    case "tuesday":
      $day = "Tuesday";
      $addon = 1;
      break;
    case "wednesday":
      $day = "Wednesday";
      $addon = 2;
      break;
    case "thursday":
      $day = "Thursday";
      $addon = 3;
      break;
    case "friday":
      $day = "Friday";
      $addon = 4;
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

<h1>Daily menu</h1> 

<form>
 <!-- View meals for this week. <br>
 <input type="text" style="width: 40px;" id="random" name="random" placeholder="1">
 <input type="button" value="Populate calendar" onclick=''> -->

<table id="table1">
  <tr>
    <th></th>
    <th></th>
    <th><?php echo $day; ?></th>
  </tr>
  <tr>
    <td class="tborder" rowspan="3">Breakfast</td>
    <td class="tborder"></td>
    <?php 

      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, Meal.id
                           FROM ((MenuItem
                           JOIN Meal ON MenuItem.meal_id = Meal.id) 
                           JOIN MealType ON MenuItem.meal_type = MealType.id)
                           WHERE MenuItem.meal_type = 1 AND MenuItem.id > (($week % 5) + $addon) 
                           ORDER BY MenuItem.id
                           LIMIT 1") as $row) {
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
  </tr>
  <tr>
    <td>chef</td>
    <td>Jen</td>
  </tr>
  <tr>
    <td class="tborder" rowspan="2">Lunch</td>
    <td class="tborder"></td>
    <?php
      $query ="SELECT MenuItem.id, Meal.name, MealType.type
               FROM ((MenuItem
               JOIN Meal ON MenuItem.meal_id = Meal.id)
               JOIN MealType ON MenuItem.meal_type = MealType.id)
               WHERE MenuItem.meal_type = 2;";

      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, Meal.id
      FROM ((MenuItem
      JOIN Meal ON MenuItem.meal_id = Meal.id) 
      JOIN MealType ON MenuItem.meal_type = MealType.id)
      WHERE MenuItem.meal_type = 2 AND MenuItem.id > (($week % 4) + 15 + $addon)     
      ORDER BY MenuItem.id
      LIMIT 1") as $row) {
        $mealid = $row['meal_id'];
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
  </tr>
  <tr>
    <td class="tborder" rowspan="3">Dinner</td>
    <td class="tborder"></td>
    <?php 
      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, Meal.id
      FROM ((MenuItem
      JOIN Meal ON MenuItem.meal_id = Meal.id) 
      JOIN MealType ON MenuItem.meal_type = MealType.id)
      WHERE MenuItem.meal_type = 4 AND MenuItem.id > (($week % 23) + 23 + $addon) 
      ORDER BY MenuItem.id
      LIMIT 1") as $row) {
        echo '<td class="tborder"><h3>';
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
  </tr>
  <tr>
    <td>chef</td>
    <td>Janice</td>
  </tr>


</table>
</form>



  <script src="calendar.js"></script>

</body> 
</html>