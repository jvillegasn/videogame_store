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
    <section class="info">
      <?php
        include "database_connection.php";

        $query = "INSERT INTO Customers VALUES('$_POST[id]', '$_POST[name]',
          '$_POST[address]', '$_POST[age]', '$_POST[sex]', '$_POST[phone]', '$_POST[email]')";
        $result = mysqli_query($connection, $query);

        mysqli_close($connection);

        echo "CUSTOMER REGISTERED";
      ?>
      <fieldset>
        <legend>Return</legend>
        <form action="index.php" align="right">
          <input type="submit" value="Return">
        </form>
      </fieldset>
    </section>
  </body>
</html>
