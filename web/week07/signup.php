<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <title>Signup Page</title>
</head>
<body>
  <nav>
    <ul class="navigation">
      <li class="active"><a href="signIn.php">Sign in page</a></li>
    </ul>
  </nav>
  ​
  <?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit']))
    {
      $pwd1 = $_POST['pwd1'];
      $pwd2 = $_POST['pwd2'];
      $valid = true;

      if ($pwd1 != $pwd2) 
      { 
        $passError = "Your passwords do not match";
        $star = "*";
        $valid = false;
      }

      if (!preg_match("/^[A-z0-9][A-z0-9][A-z0-9][A-z0-9][A-z0-9][A-z0-9][A-z0-9][A-z0-9]*$/",$pwd1)) 
      {
        $passError = "Your password needs 7 letters";
        $valid = false;
      }

      if (!preg_match("/^[0-9]*$/",$pwd1)) 
      {
        $passError = "Your password needs one number";
        $valid = false;
      }

      if (($pwd1 == $pwd2) && ($valid))
      {

        try
        {

          $passwordHash = password_hash($_POST["pwd1"], PASSWORD_DEFAULT);

          //connecting to database
          $dbUrl = getenv('DATABASE_URL');
          $dbOpts = parse_url($dbUrl);
          $dbHost = $dbOpts["host"];
          $dbPort = $dbOpts["port"];
          $dbUser = $dbOpts["user"];
          $dbPassword = $dbOpts["pass"];
          $dbName = ltrim($dbOpts["path"],'/');

          $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          //inserting new user into database
          $query = "INSERT INTO users (username, userpassword) VALUES (:name, :hashpassword)";
          $stmt = $db->prepare($query);
          $stmt->bindValue(':name', $_POST["username"], PDO::PARAM_STR);
          $stmt->bindValue(':hashpassword', $passwordHash, PDO::PARAM_STR);
          $stmt->execute();

          header("Location: https://morning-bastion-33855.herokuapp.com/week7team/signIn.php");
          die();
        }//end try
        catch (PDOException $ex)
        {
          echo 'Error!: ' . $ex->getMessage();
          die();
        }
        catch (Exception $ex)
        {
          echo 'Error!: ' . $ex->getMessage();
          die();
        }
      }// end if ($pwd1 == $pwd2)
    }//end if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit']))
    // else
    // {
  ?>
  ​
  <div>
    <form action="" method="post">
      Please enter your username:<input type="text" name="username"><br><br>
      password (7 letters and a number):<input type="password" id ="pwd1" name="pwd1"><span style="color:red;"><?php echo $star; ?></span><br><br>
      password:<input type="password"  id="pwd2" name="pwd2"><span style="color:red;"><?php echo $star; ?></span><br><br>
      <input type="submit" value="addUser" name="btnSubmit"  ><span style="color:red;"><?php echo $passError; ?></span><br><br>

    </form>
  </div>
    ​
	</body>
</html>