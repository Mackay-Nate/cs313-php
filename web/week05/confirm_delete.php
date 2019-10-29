<?php 
  $name = htmlspecialchars($_POST['meal']);
  $id   = (int)htmlspecialchars($_POST['id']);

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

  // $stmtMeals = $db->prepare('SELECT type FROM MealType t'
  // . ' INNER JOIN MenuItem mi ON mi.meal_type = t.id'
  // . ' WHERE mi.meal_id = :meal_id');
  // $stmtMeals->bindValue(':meal_id', $id);
  // $stmtMeals->execute();

  // while ($topicRow = $stmtMeals->fetch(PDO::FETCH_ASSOC))
  // {
  //   echo $topicRow['type'] . '<br>';
  //   $statement = $db->prepare('DELETE FROM MenuItem WHERE meal_id=:id');
  //   $statement->bindValue(':id', $id, PDO::PARAM_INT);
  //   $statement->execute();
    
  // }

  // $typeIds = $_POST['id'];
  
  // foreach ($typeIds as $typeId) {
  //   $statement = $db->prepare('DELETE FROM MenuItem WHERE meal_id=:id');
  //   $statement->bindValue(':id', $id, PDO::PARAM_INT);
  //   $statement->execute();
  // }

  $statement = $db->prepare('DELETE FROM Meal WHERE id=:id');
  $statement->bindValue(':id', $id, PDO::PARAM_INT);
  $statement->execute();  
  echo $id;

//  header("Location: search.php");
?>
