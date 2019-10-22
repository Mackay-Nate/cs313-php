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

		$book    = htmlspecialchars($_POST['book']);
		$chapter = htmlspecialchars($_POST['chapter']);
		$verse   = htmlspecialchars($_POST['verse']);
		$content = htmlspecialchars($_POST['content']);
		$topics  = htmlspecialchars($_POST{'topics'});

    $query = 'INSERT INTO TestScriptures (book, chapter, verse, content)
		VALUES (:book, :chapter, :verse, :content)';
    $statement = $db->prepare($query);

		$statement->bindValue(':book', $book);
		$statement->bindValue(':chapter', $chapter);
		$statement->bindValue(':verse', $verse);
		$statement->bindValue(':content', $content);

		$statement->execute();
		$scripture_id = $db->lastInsertId("testscriptures_id_seq");

		foreach ($topics as $topic_id)
  	{
	  	echo "Scripture_id: $scripture_id, topic_id: $topic_id";
 
		  $statement = $db->prepare('INSERT INTO ScriptureToTopics (scripture_id, topic_id) VALUES (:scripture_id, :topic_id)');

			$statement->bindValue(':scripture_id', $scripture_id);
  		$statement->bindValue(':topic_id', $topic_id);
	  	$statement->execute();
  	}
	}
	catch (PDOException $ex)
	{
  		echo 'Error!: ' . $ex->getMessage();
  		die();
	}

foreach ($db->query("SELECT * FROM TestScriptures ") as $row) {
	echo "<b>" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . "</b> <br/>Topics: ";
	 foreach ($db->query("SELECT *
	 			FROM topic WHERE topic.id = " . $row['topic_id']) as $topic) {
	 		echo $topic['name'] . " ";
	 	}
	echo '<br>';
  echo '"' . $row['content'] . '"<br><br>';
}

?>
</body>