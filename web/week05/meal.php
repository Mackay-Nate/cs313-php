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

  $week = date('W');
  $meal = $_GET['meal'];
  switch ($meal) { 
    case "1":
      $mealname = "Breakfast";
      $query = "(($week * 3) % 5)";
      break;
    case "2":
      $mealname = "Lunch";
      $query = "((($week * 3) % 4) + 15)";
      break;
    case "4":
      $mealname = "dinner";
      $query = "((($week * 3) % 22) + 22)";
    default: 
  }

?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu by meal</title>
    <link rel="stylesheet" type="text/css" href="calendar.css">   
  </head>

<body>

<h1>Weekly menu by meal</h1> 

<form>

<table id="table1">
  <tr>
    <th></th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
  </tr>
  <tr>
    <td class="tborder"><?php echo $mealname ?></td>
    <?php 

      foreach ($db->query("SELECT MenuItem.id, Meal.name, MealType.type, Meal.id
                           FROM ((MenuItem
                           JOIN Meal ON MenuItem.meal_id = Meal.id) 
                           JOIN MealType ON MenuItem.meal_type = MealType.id)
                           WHERE MenuItem.meal_type = $meal AND MenuItem.id > $query 
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

</table>
</form>



  <script src="calendar.js"></script>

</body> 
</html>