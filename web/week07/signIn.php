<?php
  // Start the session
  session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
​  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="">
  <title>Signin Page</title>
​</head>

  <header>
​    <h2>Login Page</h2>
  </header>

<body>
  <nav>
    <ul class="navigation">
      <li class="active"><a href="https://morning-bastion-33855.herokuapp.com/week7team/signup.php">Sign up page</a></li>
    </ul>
  </nav>

  <?php
    // require 'password.php';
​    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit']))
    {
      
      try
      {

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

        //getting user info from database for comparision
        $queryUser = 'SELECT userpassword FROM users WHERE username = :username';
        $stmt = $db->prepare($queryUser);
        //binding puts my variables into my place holders
        $stmt->bindValue(':username', $_POST["username"], PDO::PARAM_STR);
        $stmt->execute();

        //array that holds the results from the database
        $userRowSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $hashedPassword = -1;
        if(!empty($userRowSet))
        {
          $hashedPassword = $userRowSet[0]["userpassword"];

          if(password_verify($_POST["pwd1"], $hashedPassword))
          {
            $_SESSION["username"] = $_POST["username"];
            header("Location: welcome.php");
          }
          else
          {
            header("Location: signIn.php");
          }
        }
        else
        {
        header("Location: signIn.php");
        }
​
​      }//end try
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
    }//end if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit']))
    else
    {
    ?>

    <div>
      <form action="" method="post">
        Please enter your username:<input type="text" name="username"><br><br>
        password (7 letters and a number):<input type="password" name="pwd1"><br><br>
        <input type="submit" value="Login" name="btnSubmit" ><br><br>
​      </form>
    </div>
  <?php }//end else ?>
​
​
</body>
</html>