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
    <title> </title>
    <link rel="stylesheet" type="text/css" href=".css">   
  </head>

<body onload="document.getElementById('random').focus();">

<h1>Dinner menu</h1> 

<form>
Enter a random number to generate the meals. <br>
<input type="text" style="width: 40px;" id="random" name="random">
<input type="button" value="Populate calendar">

<table>
  <tr>
    <th></th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
  </tr>
  <tr>
    <td>Breakfast</td>
    <?php 
      $query ="SELECT MenuItem.id, Meal.name, MealType.type
               FROM ((MenuItem
               JOIN Meal ON MenuItem.meal_id = Meal.id) 
               JOIN MealType ON MenuItem.meal_type = MealType.id)
               WHERE MealType.id = 1;";
      $min ="SELECT MIN(id) AS SmallestId 
             FROM ((MenuItem
             JOIN Meal ON MenuItem.meal_id = Meal.id) 
             JOIN MealType ON MenuItem.meal_type = MealType.id)
             WHERE MealType.id = 1;";
      $max ="SELECT MAX(id) AS LargestId 
             FROM ((MenuItem
             JOIN Meal ON MenuItem.meal_id = Meal.id) 
             JOIN MealType ON MenuItem.meal_type = MealType.id)
             WHERE MealType.id = 1;";

      $number = filter_var($_POST["random"], FILTER_SANITIZE_STRING);
      for ($i = $min; $i < $min + 5; $i++ ) { 
        $id = $number + $i % 13;
        foreach ($db->query("SELECT * FROM Meal WHERE id='$id' ") as $row) {
          $id = $row['id'];
          $mealName = $row['name'];
          echo "<a href='detail.php?id=$id'>";
    
          echo $mealName;
          echo "</a>"; 
      }


    ?>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
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
    <td>Lunch</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
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
    <td>Dinner</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
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



<h6>Search for a meal</h6>
<form method="post" action=''>
	<span>Search:</span><input type="text" name="search" id="search">
  <input type="submit" value="Search">
</form>

<?php
    $mealName = filter_var($_POST["search"], FILTER_SANITIZE_STRING);
    foreach ($db->query("SELECT * FROM Meal WHERE name='$mealName' ") as $row) {
      $id = $row['id'];
      echo "<a href='detail.php?id=$id'>";      
      echo $row['name'];
      echo '</a>';
      echo ' is a good meal.';
      echo '<br>';
    }
?>

  <script src=".js"></script>

</body> 
</html>