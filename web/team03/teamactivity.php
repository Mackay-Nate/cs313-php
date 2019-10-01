

<!DOCTYPE html>
<html>
<body>

  <form action="form.php" method="post">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="radio" name="major" value="cs">Computer Science
    <input type="radio" name="major" value="wdd">Web Design and Dev.
    <input type="radio" name="major" value="cit">Computer Info Tech
    <input type="radio" name="major" value="ce">Computer Engineering
    Comment: <textarea name="comment" rows="5" cols="40"></textarea>

    <input type="checkbox" name="continents" value="North America">North America
    <input type="checkbox" name="continents" value="South America">South America
    <input type="checkbox" name="continents" value="Europe">Europe
    <input type="checkbox" name="continents" value="Asia">Asia
    <input type="checkbox" name="continents" value="Australia">Australia
    <input type="checkbox" name="continents" value="Africa">Africa
    <input type="checkbox" name="continents" value="Antarctica">Antarctica
    <input type="submit">
  </form>

</body>
</html>
