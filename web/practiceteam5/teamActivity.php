<?php 

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

<h3>Scripture Resources</h3> 

<?php 
  # core requirement 3
  # foreach ($db->query('SELECT * FROM TestScriptures') as $row) { 
  #   echo $row['book'] . ' ';
  #   echo $row['chapter'] . ':';
  #   echo $row['verse'] . ' - "';
  #   // echo $row['content'] . '"'; 
  #   echo '<br>';
  }
?>

  <form method="post" action=''>
  	<span>Search:</span><input type="text" name="search">
    <input type="submit" value="Search">
  </form>

  <?php
    $book = filter_var($_POST["search"], FILTER_SANITIZE_STRING);
    foreach ($db->query("SELECT * FROM scriptures WHERE book='".$book."'") as $row) {
      echo '<a href="detail.php">';
      echo $row['book'] . ' ';
      echo $row['chapter'] . ':';
      echo $row['verse'] . ' - "';
      echo '</a>';
      echo '<br>';
    }
	?>

