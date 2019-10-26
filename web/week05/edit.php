<?php 
  $id = htmlspecialchars($_POST['search']);
  $prep = htmlspecialchars($_POST['']);
  $cook = htmlspecialchars($_POST['']);


?> 

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <script src="calendar.js"></script>
    <link rel="stylesheet" type="text/css" href="calendar.css">   
  </head>

<body>

<h2> Type in the name of the meal you'd like to edit </h2>
<form method="post" action=''>
	<span>Search:</span><input type="text" name="search" id="search" value="Oatmeal">
  <input type="submit" value="Search" >
</form>

<?php
    $mealName = filter_var($_POST["search"], FILTER_SANITIZE_STRING);
    foreach ($db->query("SELECT * FROM Meal WHERE name='$mealName' ") as $row) {
      $id = $row['id'];
      echo "<h3><a href='detail.php?id=$id'>";
      echo $row['name'];
      echo '</a></h3>';
      echo '<br>';
    }
?>

</body>
</html>
