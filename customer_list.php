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
    <section class="list">
      <table style="width:100%">
        <th style="align:center">Account List</th>
      </table>
      <table style="width:100%">
        <tr>
          <th>ID</th>
          <th>Name</th>
        </tr>
        <?php
          include "database_connection.php";

          $query = "SELECT * FROM Customers";
          $result = mysqli_query($connection, $query);

          if(mysqli_num_rows($result) > 0){
            while($account = mysqli_fetch_assoc($result)){
                echo  "<tr>".
                      "<td align=center>".$account["id"]."</td>".
                      "<td>".$account["name"]."</td>".
                      "</tr>";
            }
          }
          else{
            echo "<tr>
                  <td> None </td>
                  <td> None </td>
                  </tr>";
          }


          mysqli_close($connection);
        ?>
      </table>
      <form action="" method="post">
        <fieldset>
          ID: <input type="text" name="id" size="10" maxlength="5" autofocus required>
          <input type="submit" name="show" formaction="customer_account.php" value="Show">
          <input type="submit" name="update" formaction="update_account.php" value="Update">
          <input type="submit" name="delete" formaction="delete_account.php" value="Delete">
        </fieldset>
      </form>
      <fieldset>
        <legend>Return</legend>
        <form action="index.php" align="right">
          <input type="submit" value="Return">
        </form>
      </fieldset>
    </section>
  </body>
</html>
