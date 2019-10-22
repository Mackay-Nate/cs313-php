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
		<br>
		<?php
		
		$statement = $db->prepare('SELECT id, name FROM topic');
		$statement->execute();

		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	  {
  		$id = $row['id'];
	  	$name = $row['name'];
  		// Notice that we want the value of the checkbox to be the id of the label
	  	echo "<input type='checkbox' name='chkTopics[]' id='chkTopics$id' value='$id'>";
		  // Also, so they can click on the label, and have it select the checkbox,
  		// we need to use a label tag, and have it point to the id of the input element.
  		// The trick here is that we need a unique id for each one. In this case,
	  	// we use "chkTopics" followed by the id, so that it becomes something like
		  // "chkTopics1" and "chkTopics2", etc.
  		echo "<label for='chkTopics$id'>$name</label><br />";
	  	// put a newline out there just to make our "view source" experience better
		  echo "\n";
  	}
		?>

		<br/><input type="submit" value="Submit"><br/>
	</form>
</body>