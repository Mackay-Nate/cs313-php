<?php 
  $name = htmlspecialchars($_POST['meal']);
  $id   = htmlspecialchars($_POST['id']);
  $prep = htmlspecialchars($_POST['prep']);
  $cook = htmlspecialchars($_POST['cook']);

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

  $typeIds = $_POST['type'];
  
  $statement = $db->prepare('UPDATE Meal SET prep=:prep, cook=:cook WHERE id=:id');
  $statement->bindValue(':id', $id, PDO::PARAM_INT);
  $statement->bindValue(':prep', $prep, PDO::PARAM_INT);
  $statement->bindValue(':cook', $cook, PDO::PARAM_INT);
  $statement->execute();

  // $id = $db->lastInsertId("meal_id_seq");
  // echo "id is " . $id . '<br>';

  foreach ($typeIds as $typeId) {
    // echo 'This is a foreach statement';
    $statement = $db->prepare('UPDATE MenuItem SET meal_type=:mealtype WHERE meal_id=:id');
    $statement->bindValue(':mealtype', $typeId, PDO::PARAM_INT);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
  }

  header("Location: search.php");
?>

<!-- <!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <script src="calendar.js"></script>
    <link rel="stylesheet" type="text/css" href="calendar.css">   
  </head>

<body>

<form action="search.php" method="post">
  <h1>Your meal has been added to the database. </h1>

  <input type="submit" value="Return">

</form>

</body>
</html> -->