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

<h3>Meal Details</h3> 


<?php
  $id = $_GET["id"];
  foreach ($db->query("SELECT * FROM Meal WHERE id='".$id."'") as $row) {
      
      echo $row['name'];
      echo ' is a good meal. It takes ';
      echo 'It takes $row[prepTime] or $row["prepTime"] minutes to prepare it.'

      echo $row[prepTime] . ' time to prepare, and ';
      echo $row['cookTime'] . ' time to cook.';
      echo $db;
      echo '<br>';
    }
?>