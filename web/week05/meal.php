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

  $meal = $_POST['meal'];
  echo $meal;
  $week = date('W');
  echo "<br>week: " . $week;

  switch ($meal) { 
    case "breakfast":
      $meal = "Breakfast";
      $meal_type = 1;
      $query = "($week % 5)";
      break;
    case "lunch":
      $meal = "Lunch";
      $meal_type = 2;
      $query = "(($week % 4) + 15)";
      break;
    case "dinner":
      $meal = "dinner";
      $meal_type = 4;
      $query = "(($week % 22) + 22)";
      break;
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
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
  </tr>
  <tr>
    <td class="tborder"><?php echo $meal ?></td>
    <!--<td class="tborder"></td>-->
    <?php 

      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, Meal.id
                           FROM ((MenuItem
                           JOIN Meal ON MenuItem.meal_id = Meal.id) 
                           JOIN MealType ON MenuItem.meal_type = MealType.id)
                           WHERE MenuItem.meal_type = $meal_type AND MenuItem.id > $query 
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

</table>
</form>



  <script src="calendar.js"></script>

</body> 
</html>