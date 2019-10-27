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
  $prep = htmlspecialchars($_POST['']);
  $cook = htmlspecialchars($_POST['']);


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

<body>

<h2> Type in the name of the meal you'd like to edit </h2>
<form method="post" action=''>
	<span>Search:</span><input type="text" name="search" id="search" value="Oatmeal">
  <input type="submit" value="Search" >
</form>

<?php
    $mealName = filter_var($_POST["search"], FILTER_SANITIZE_STRING);
    foreach ($db->query("SELECT * FROM Meal WHERE name='$mealName' ") as $row) {
      $id = $row['id'];

      echo "<h3><a href='detail.php?id=$id'>";
      echo $row['name'];
      echo '</a></h3>';
      echo '<br>'; 

      echo  $row['name'] . ' takes ';
      echo $row['prep'];
      echo ' minutes to prepare it, and ' . $row['cook'] . ' minutes to cook it.' . '<br>';
      echo $row['name'] . 'is a good meal for:' . '<br>';
      


      
      
      echo '<h3>What would you like to change?<h3>';

      echo '<form method="post" action="add.php" id="form2">
      <table id="add">
        <tr><th colspan="2"><h3>Edit a meal</h3></th></tr>
        <tr><td>Meal name</td> 
          <td><input type="text" name="meal_name"></td></tr>
        <tr><td>Cook time?</td>
          <td><input type="text" name="cook" placeholder="in minutes"></td></tr>
        <tr><td>Preparation time?</td>
          <td><input type="text" name="prep" placeholder="in minutes"></td></tr>
        <tr><td colspan="2">
          <?php 

          ?>
          <input type="checkbox" name="type[]" id="breakfast" value="1"><label for="breakfast">Breakfast</label>
          <input type="checkbox" name="type[]" id="lunch" value="2">Lunch
          <input type="checkbox" name="type[]" id="dinner" value="4">Dinner</td></tr>
        <tr><td></td><td><input type="submit" value="Add to database"></td></tr>
      </table>
    </form>';

    }
?>

</body>
</html>
