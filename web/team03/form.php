<?php 
  $continents = $_POST["continents"];
  $length = count($continents);
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
      $clean = htmlspecialchars($visit);
      echo $clean;
      echo "<br>";
    }
  ?>

</body>
</html>
