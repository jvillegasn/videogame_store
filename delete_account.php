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

        $query = "SELECT * FROM Customers WHERE id='$_POST[id]'";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result)==0){
          echo 'ACCOUNT NOT FOUND!';
        }
        else{
          $query = "DELETE FROM Customers WHERE id='$_POST[id]'";
          $result = mysqli_query($connection, $query);

          echo 'DELETED!';
        }

        mysqli_close($connection);
      ?>
      <fieldset>
        <legend>Return</legen>
        <form action="customer_list.php" align="right">
          <input type="submit" value="Return">
        </form>
      </fieldset>
    </section>
  </body>
</html>
