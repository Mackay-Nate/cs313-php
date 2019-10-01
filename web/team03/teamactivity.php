

<!DOCTYPE html>
<html>
<body>

  <form action="form.php" method="post">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="radio" name="major" value="Computer Science">Computer Science <br>
    <input type="radio" name="major" value="Web Design and Development">Web Design and Development<br>
    <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology<br>
    <input type="radio" name="major" value="Computer Engineering">Computer Engineering<br>
    Comment: <textarea name="comment" rows="5" cols="40"></textarea><br>

    <input type="checkbox" name="continents[]" value="North America">North America<br>
    <input type="checkbox" name="continents[]" value="South America">South America<br>
    <input type="checkbox" name="continents[]" value="Europe">Europe<br>
    <input type="checkbox" name="continents[]" value="Asia">Asia<br>
    <input type="checkbox" name="continents[]" value="Australia">Australia<br>
    <input type="checkbox" name="continents[]" value="Africa">Africa<br>
    <input type="checkbox" name="continents[]" value="Antarctica">Antarctica<br>

    <input type="submit">
  </form>

</body>
</html>
