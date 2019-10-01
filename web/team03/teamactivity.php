

<!DOCTYPE html>
<html>
<body>

  <form action="form.php" method="post">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="radio" name="major" value="cs">Computer Science <br>
    <input type="radio" name="major" value="wdd">Web Design and Dev.<br>
    <input type="radio" name="major" value="cit">Computer Info Tech<br>
    <input type="radio" name="major" value="ce">Computer Engineering<br>
    Comment: <textarea name="comment" rows="5" cols="40"></textarea><br>

    <input type="checkbox" name="continents" value="North America">North America<br>
    <input type="checkbox" name="continents" value="South America">South America<br>
    <input type="checkbox" name="continents" value="Europe">Europe<br>
    <input type="checkbox" name="continents" value="Asia">Asia<br>
    <input type="checkbox" name="continents" value="Australia">Australia<br>
    <input type="checkbox" name="continents" value="Africa">Africa<br>
    <input type="checkbox" name="continents" value="Antarctica">Antarctica<br>
    <input type="submit">
  </form>

</body>
</html>
