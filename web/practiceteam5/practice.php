<!DOCTYPE html>
<head>
</head>
<body>
	<h1>Scripture Resources</h1>
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

		$book = $_POST['book'];
	}
	catch (PDOException $ex)
	{
  		echo 'Error!: ' . $ex->getMessage();
  		die();
	}

	foreach ($db->query("SELECT * FROM TestScriptures WHERE book = '$book'") as $row) {
	}

?>

	<form name="insert" action="result.php" method="post">
		Add Scripture: 
		<br> Book: <input type="text" name="book" /> 
		<br> Chapter: <input type="text" name="chapter" /> 
		<br>Verse: <input type="text" name="verse" /> <br/>
		<br>Content: <input type="textarea" name="content" />
		<br>Topic: 
		<?php
			foreach ($db->query("SELECT * FROM topic") as $row) {
				echo '<input type="checkbox" name="topics[]"' . $row["id"] . '" value="' . $row["name"] . '>' . $row["name"];
				echo '<br/>';
		}
		?>

		<br/><input type="submit" value="Submit"><br/>
	</form>
</body>