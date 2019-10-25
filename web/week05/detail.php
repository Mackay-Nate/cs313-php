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

<head>
  <title> Meal Details</title>
  <link rel="stylesheet" type="text/css" href="calendar.css">   
</head>

<h3>Meal Details</h3> 

<?php
  $id = htmlspecialchars($_GET["id"]);
  
  foreach ($db->query("SELECT * FROM Meal WHERE id='".$id."'") as $row) {
      $prepTime = $row['prep'];
      $cookTime = $row['cook'];

      echo $row['name'];
      echo ' is a good meal.';
      echo  'It takes ';
      echo $prepTime;
      echo ' minutes to prepare it, and ' . $cookTime . ' minutes to cook it.';
      echo '<br>';
    }
?>
