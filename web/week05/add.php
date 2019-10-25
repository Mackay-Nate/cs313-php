<?php 
  $name = htmlspecialchars($_POST['meal_name']);
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

  //INSERT INTO MenuItem (meal_type, meal_id) VALUES ('4', '23');
  $stmt = $db->prepare('INSERT INTO Meal (name, prep, cook) VALUES (:name ,:prep, :cook)');
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':prep', $prep, PDO::PARAM_INT);
  $stmt->bindValue(':cook', $cook, PDO::PARAM_INT);
  $stmt->execute();

?>

<form action="search.php">
  Your meal has been added to the database. 
  <?php echo meal_id_seq; ?>

  <input type="button" value="Return">

</form>