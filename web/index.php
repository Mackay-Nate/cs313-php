
<!DOCYTPE html>
<html lang="en-us">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nate Mackay's CS 313 assignments</title>
    <link rel="stylesheet" type="text/css" href="week02/week02.css">
  </head>

<body>
  <header>
    <?php
      echo "<h1>Nate Mackay</h1>";
    ?>
  </header>

  <h3>CS 313 Assignment</h3>
    <div id="assignments">
      <ul>
        <li><a href="week02/week02.php">Week 02: Homepage</a></li>
        <li><a href="week03/confirm.php">Week 03: Shopping cart</a></li>
        <li><a href="../db/myDB.sql">Week 04: Database</a></li>
        <li><a href="week05/calendar.php">Week 05: Database Access</a></li>
      </ul>
    </div>

  <footer>
    <?php
      date_default_timezone_set("America/Denver");
      echo "Today is " . date("l") . ". ";
      echo "The date is " . date("m-d-Y") . ". ";
      echo "The time is " . date("h:i:sa") . ". ";
    ?>
  </footer>

</body>
</html>
