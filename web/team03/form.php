<?php 
  $continents = $_POST["continents"];

  $map = array("na" => "North America", "sa" => "South America", "eu" => "Europe", "as" => "Asia", "au" => "Australia", "af" => "Africa", "an" => "Antarctica");

?>

<html>
<body>

  Welcome <?php echo $_POST["name"]; ?><br>
  Your email address is: <?php echo $_POST["email"]; ?><br>
  Your major is: <?php echo $_POST["major"]; ?><br>
  Your comments: <?php echo $_POST["comment"]; ?> <br>
  Your continents are: <br>
  <?php 
    foreach ($continents as $visit) {
      echo $map["$visit"];
      echo "<br>";
    }
  ?>

</body>
</html>
