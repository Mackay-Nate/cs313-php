<?php 
  $name = htmlspecialchars($_POST['meal_name']);
  $prep = htmlspecialchars($_POST['prep']);
  $cook = htmlspecialchars($_POST['cook']);

  echo "$name\n";
  echo "$prep\n";
  echo "$cook\n";


?> 


alert('Your meal has been added.');


header("Location: search.php");

