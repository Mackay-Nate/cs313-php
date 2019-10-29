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

  $id = htmlspecialchars($_POST['search']);

?> 

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <script src="calendar.js"></script>
    <link rel="stylesheet" type="text/css" href="calendar.css">   
  </head>

<body onload='document.getElementById("search").focus()'>

<h2> Type in the name of the meal you'd like to edit </h2>
<form method="post" action=''>
	<span>Meal name:</span><input type="text" name="search" id="search" value="Oatmeal">
  <input type="submit" value="Search" >
</form>

<?php
    $mealName = filter_var($_POST["search"], FILTER_SANITIZE_STRING);
    foreach ($db->query("SELECT * FROM Meal WHERE name='$mealName' ") as $row) {
      $id = $row['id'];
      $name = $row['name'];
      echo "<h3><a href='detail.php?id=$id'>";
      echo $name;
      echo '</a></h3>';
      echo '<br>'; 

      echo $name . ' takes ';
      echo $row['prep'];
      echo ' minutes to prepare it, and ' . $row['cook'] . ' minutes to cook it.' . '<br>';
      echo $name . ' is a good meal for:' . '<br>';
      
      //display meal type
      $stmtMeals = $db->prepare('SELECT type FROM MealType t'
      . ' INNER JOIN MenuItem mi ON mi.meal_type = t.id'
      . ' WHERE mi.meal_id = :meal_id');
      $stmtMeals->bindValue(':meal_id', $row['id']);
      $stmtMeals->execute();
    
      while ($topicRow = $stmtMeals->fetch(PDO::FETCH_ASSOC))
      {
        echo $topicRow['type'] . '<br>';
      }

      echo '<h3>Are you sure you want to delete this meal?<h3>';

      echo '<form method="post" action="confirm_delete.php">
              <input type="hidden" name="id" value="$id">
              $id
              <input type="hidden" name="meal" value="$name">
    
              <input type="submit" value="Confirm" onclick="successDelete()">
            </form>';
      echo '<form method="post" action="search.php">
              <input type="submit" value="Cancel" >
            </form>';
    }
?>

</body>
</html>
