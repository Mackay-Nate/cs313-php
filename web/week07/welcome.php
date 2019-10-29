<?php
// Start the session
session_start();
​
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
​
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <title>Welcome Page</title>
​
	</head>
	<body>
​
		Welcome  <?php echo $_SESSION["username"]; ?><br>
​
	</body>
</html>