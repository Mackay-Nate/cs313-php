<?php

  $message = "Your order...";

  if (isset($_POST['confirm'])) {
    $message = "<div> Your order has been confirmed. </div>";
  } else {
    $message = "Your order has been cancelled.";
  }

?>

<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="UTF-8">
  <title>Classic Violin Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="week03.js"></script>
  <link rel="stylesheet" type="text/css" href="week03.css">

</head>
<body>

  <h1>Classic Violin Shop Order</h1>

  <div id="blockArea">

    <form action="cart.php" method="POST">

      <div id="blockArea3">
        <table style="text-align: right;">
          <tr>
            <th style="width:400px; text-align: left;"> <?php echo $message; ?></th>
          </tr>

        </table>
      </div>
    </form>
  </div>


  <footer>
    <img src="logo3.jpg" alt="Classic Violin Shop;">
    Classic Violin Shop established in 1999.
    <p> © 2019 </p>
  </footer>

</body>
</html>
