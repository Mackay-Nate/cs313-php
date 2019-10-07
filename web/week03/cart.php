
<?php

$firstname = $_POST['first_name'];
$lastname  = $_POST['last_name'];
$address   = $_POST['address'];
$phone     = $_POST['phone'];
$creditcard= $_POST['credit_card'];
$cardtype  = $_POST['card_type'];
$cardexp   = $_POST['exp_date'];

$total = $_POST['total'];

if (isset($_POST['item_0'])) {
  $total += $_POST['item_0'];
}
if (isset($_POST['item_1'])) {
  $total += $_POST['item_1'];
}
if (isset($_POST['item_2'])) {
  $total += $_POST['item_2'];
}
if (isset($_POST['item_3'])) {
  $total += $_POST['item_3'];
}
if (isset($_POST['item_4'])) {
  $total += $_POST['item_4'];
}
if (isset($_POST['item_5'])) {
  $total += $_POST['item_5'];
}

?>

<!DOCTYPE html>
<html lang="en-us">

<head>
<meta charset="UTF-8">
<title>Classic Violin Shop Purchase Confirmation</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="week03.js"></script>
<link rel="stylesheet" type="text/css" href="week03.css">


</head>
<body>

  <h1>Classic Violin Shop Purchase Confirmation</h1>

  <div id="blockArea">

    <form action="confirm.php" method="POST">
      <table onselect="getTotal();">
        <tr>
          <th></th>
          <th style="width:200px;">Repair</th>
          <th style="width:100px;">Cost</th>
        </tr>

        <?php
        if (isset($_POST['item_0'])) {
        print "<tr>
          <td></td>
          <td>Rehair Violin bow</td>
          <td>$ 28.00</td>
        </tr>";
        }

        if (isset($_POST['item_1'])) {
          print "<tr>
            <td></td>
            <td>Rehair Viola bow</td>
            <td>$ 28.00</td>
          </tr>"; }
  
          if (isset($_POST['item_2'])) {
          print "<tr>
            <td></td>
            <td>Rehair Cello bow</td>
            <td>$ 33.00</td>
          </tr>"; }
  
          if (isset($_POST['item_3'])) {
          print "<tr>
            <td></td>
            <td>Violin bridge</td>
            <td>$ 25.00</td>
          </tr>"; }
  
  
          if (isset($_POST['item_4'])) {
            print "<tr>
              <td></td>
              <td>Cello bridge</td>
              <td>$ 40.00</td>
            </tr>"; }
    
            if (isset($_POST['item_5'])) {
            print "<tr>
              <td></td>
              <td>Violin peg</td>
              <td>$ 15.00</td>
            </tr>"; }
            ?>
    
            <tr id="total">
              <td></td>
              <td>Total Price:</td>
              <td id="totalCost">$ <?php echo $total; ?>.00</td>
            </tr>
          </table>

      <button type="submit" name="confirm">Confirm Order</button>
      <button type="submit" name="cancel">Cancel Order</button>      
    </form>
  </div>

  <footer>
    <img src="logo3.jpg" alt="Classic Violin Shop;">
    Classic Violin Shop established in 1999.
    <p> © 2019 </p>
  </footer>

</body>
</html>




