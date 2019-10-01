<?php 
  $continents = $_POST["continents"];
  $length = count($continents);

  $map = array("na" => "North America", "sa" => "South America", "eu" => "Europe", "as" => "Asia", "au" => "Australia", "af" => "Africa", "an" => "Antarctica");

  $major = array("cs" => "Computer Science", "wdd" => "Web Design and Development", "cit" => "Computer Information Technology", "ce" => "Computer Engineering");


?>

<html>
<body>

  Welcome <?php echo $_POST["name"]; ?><br>
  Your email address is: <?php echo $_POST["email"]; ?><br>
  Your major is: <?php echo $_POST["major"]; ?><br>
  Your comments: <?php echo $_POST["comment"]; ?> <br>
  Your continents are:
  <?php 
    foreach ($continents as $visit) {
      echo $map[$visit]);
      echo "<br>";
    }
  ?>

</body>
</html>
