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
          echo 'ACCOUNT NOT FOUND! PLEASE RETURN';
        }

        mysqli_close($connection);
      ?>
      <form action="update_query.php" method="post">
        <fieldset>
          ID <input type="text" name="id" value=<?php echo "$_POST[id]"; ?> readonly><br>
          Name: <input type="text" name="name" size="30" maxlength="25" required>
          Age: <input type="number" name="age" min="15" max="100" value="15">
          Sex: <input type="radio" name="sex" value="M"> Male
          <input type="radio" name="sex" value="F"> Female
          <input type="radio" name="sex" value="-"> Other <br>
          Address: <input type="text" name="address" size="85" maxlength="100"><br>
          Phone: <input type="text" name="phone" size="15" maxlength="10">
          Email: <input type="email" name="email" size="30" maxlength="50">
          <input type="submit" name="updated" value="Submit">
          <input type="submit" name="clear" value="Clear">
        </fieldset>
      </form>
      <fieldset>
        <legend>Return</legend>
        <form action="customer_list.php" align="right">
          <input type="submit" value="Return">
        </form>
      </fieldset>
    </section>
  </body>
</html>
