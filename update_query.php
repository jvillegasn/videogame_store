<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Videogame Store </title>
    <link rel="stylesheet" href="store_style.css">
  </head>
  <body>
    <header>
      <?php include "header.html" ?>
    </header>
    <section class="index">
      <?php
        include "database_connection.php";

        $query = "UPDATE Customers
                  SET name='$_POST[name]', age='$_POST[age]', sex='$_POST[sex]',
                  address='$_POST[address]', phone='$_POST[phone]',
                  email='$_POST[email]'
                  WHERE id='$_POST[id]'";
        $result = mysqli_query($connection, $query);

        mysqli_close($connection);
        echo "CUSTOMER UPDATED!";
      ?>
      <fieldset>
        <legend>Return</legen>
        <form action="index.php" align="right">
          <input type="submit" value="Return">
        </form>
      </fieldset>
    </section>
  </body>
</html>
