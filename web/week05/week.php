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

  $week = $_GET['week'];
  if ($week == "") { 
    $week = date('W'); 
  }
  echo $week;
?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Dinner Menu</title>
    <link rel="stylesheet" type="text/css" href="calendar.css">   
  </head>

<body>

<h1>Weekly Dinner menu</h1> 

<form action="week.php">
<input type="submit" value="Populate calendar for this week">

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

      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, Meal.id
                           FROM ((MenuItem
                           JOIN Meal ON MenuItem.meal_id = Meal.id) 
                           JOIN MealType ON MenuItem.meal_type = MealType.id)
                           WHERE MenuItem.meal_type = 1 AND MenuItem.id > ($week % 5) 
                           ORDER BY MenuItem.id
                           LIMIT 5") as $row) {
        $mealid =   $row['id'];
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
      WHERE MenuItem.meal_type = 2 AND MenuItem.id > (($week % 4) + 15)     ORDER BY MenuItem.id
      LIMIT 5") as $row) {
        $mealid = $row['id'];
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
    <td class="tborder" rowspan="3">Dinner</td>
    <td class="tborder"></td>
    <?php 
      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, Meal.id
      FROM ((MenuItem
      JOIN Meal ON MenuItem.meal_id = Meal.id) 
      JOIN MealType ON MenuItem.meal_type = MealType.id)
      WHERE MenuItem.meal_type = 4 AND MenuItem.id > (($week % 22) + 22) 
      ORDER BY MenuItem.id
      LIMIT 5") as $row) {
        echo '<td class="tborder"><h3>';
        $mealid = $row['id'];
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