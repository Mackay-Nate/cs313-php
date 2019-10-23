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
      $prepTime = $row['cookTime'];
      $time     = strtotime($prepTime);
      $newformat = date('h:m:s a', $prepTime);
      $newformat1 = date('m', strtotime($row['cookTime']));
      $newformat2 = date('m:s', $prepTime);
      $newformat3 = date('h:i', $prepTime);

      echo 'prep' . $prepTime . '<br>';
      echo 'ti' . $time . '<br>';
      echo 'new' . $newformat . '<br>';
      echo 'new1' . $newformat1 . '<br>';
      echo 'new2' . $newformat2 . '<br>';
      echo 'new3' . $newformat3 . '<br>';


      echo $row['name'];
      echo ' is a good meal.';
      echo $minutes;
      echo $prepTime;
      echo  'It takes ';
      echo $minutes;
      echo 'It takes ' . $prepTime . ' minutes to prepare it.';
      echo '<br>';
      echo 'It takes ';
      echo MINUTE($prepTime); 
      echo 'minutes.';
    }
?>
