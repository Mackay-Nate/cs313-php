<?php 
  $name = htmlspecialchars($_POST['meal_name']);
  $prep = htmlspecialchars($_POST['prep']);
  $cook = htmlspecialchars($_POST['cook']);


?> 


alert('Your meal has been added.');


header("Location: calendar.php");

