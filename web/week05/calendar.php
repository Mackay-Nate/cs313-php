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

<div id="manipulate" style="width:500px;">
  <h3>Manipulating the list of meals:</h3><br>
  <input type="button" id="add" value="Add a meal" onclick="show('form2')">
  <form method="post" action="insert.php" class="hidden" id="form2"> 
    <table>
      <tr><th colspan="2"><h3>Adding a meal</h3></th></tr>
      <tr><td>Meal name</td> 
        <td><input type="text" name="meal_name"></td></tr>
      <tr><td>What is the cook time?</td>
        <td><input type="text" name="cook" placeholder="00:00"></td></tr>
      <tr><td>How long does it take to prepare?</td>
        <td><input type="text" name="prep" placeholder="00:00"></td></tr>
    </table>
    <?php
		
		$statement = $db->prepare('SELECT id, type FROM MealType');
		$statement->execute();

		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	  {
  		$id = $row['id'];
	  	$type = $row['type'];

      echo "<input type='checkbox' name='types[]' id='types$id' value='$id'>";
  		echo "<label for='types$id'>$type</label><br />";
		  echo "\n";
  	}
		?>
    <!-- <input type="checkbox" name="type" value="breakfast">Breakfast<br>
    <input type="checkbox" name="type" value="lunch">Lunch<br>
    <input type="checkbox" name="type" value="dinner">Dinner<br> -->
    <input type="submit">
  </form>
  <h3></h3>
  <input type="button" id="edit" value="Edit a meal" onclick="show('form3')">
  <form method="post" action='' id="form3" class="hidden" onsubmit="return false">
  <h3>Search:</h3>
  <input type="text" name="search1" id="search1">
  <input type="submit" value="Search">
  <?php
    $mealName = filter_var($_POST["search1"], FILTER_SANITIZE_STRING);
    foreach ($db->query("SELECT * FROM Meal WHERE name='$mealName' ") as $row) {
      $id = $row['id'];
      echo "<a href='detail.php?id=$id'>";      
      echo $row['name'];
      echo '</a>';
      echo ' Click the meal to edit it.';
      echo '<br>';
    }
  ?>
</form>
  <h3></h3>
  <input type="button" id="delete" value="Delete a meal" onclick="show('form4')">
  <form method="post" action='' id=form4 class="hidden">
  <h4>Search:</h4>
  <input type="text" name="search2" id="search2">
  <input type="button" value="Search">
  <?php
    $mealName = filter_var($_POST["search2"], FILTER_SANITIZE_STRING);
    foreach ($db->query("SELECT * FROM Meal WHERE name='$mealName' ") as $row) {
      $id = $row['id'];
      echo "<a href='detail.php?id=$id'>";      
      echo $row['name'];
      echo '</a>';
      echo ' Click the meal to delete it.';
      echo '<br>';
    }
  ?>
</form>


</div>


  <script src="calendar.js"></script>

</body> 
</html>