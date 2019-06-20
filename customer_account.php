<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Account Info </title>
    <link rel="stylesheet" href="store_style.css">
  </head>
  <body>
    <header>
      <?php include "header.html" ?>
    </header>
    <section class="info">
      <?php include "database_connection.php"; ?>
      <?php
        $query ="SELECT * FROM Customers WHERE id='$_POST[id]'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)==0){
          echo 'ACCOUNT NOT FOUND!';
        }
       ?>
      <table style="width:100%">
        <th style="align:center">Customer Account</th>
      </table>
      <table style="width:100%">
        <tr>
          <th>ID</th>
          <th>NAME</th>
          <th>ADDRESS</th>
          <th>AGE</th>
          <th>SEX</th>
          <th>PHONE</th>
          <th>EMAIL</th>
        </tr>
        <?php
          include "database_connection.php";

          $query = "SELECT * FROM Customers WHERE id='$_POST[id]'";
          $result = mysqli_query($connection, $query);

          if(mysqli_num_rows($result)!=0){
            $account = mysqli_fetch_assoc($result);
            echo  "<tr>".
                  "<td align=center>$account[id]</td>".
                  "<td>$account[name]</td>".
                  "<td>$account[address]</td>".
                  "<td align=center>$account[age]</td>".
                  "<td align=center>$account[sex]</td>".
                  "<td align=center>$account[phone]</td>".
                  "<td>$account[email]</td>".
                  "</tr>";
          }
          else{
            echo  "<tr>
                  <td align=center>None</td><td>None</td><td>None</td>
                  <td align=center>None</td><td align=center>None</td>
                  <td align=center>None</td><td>None</td>
                  </tr>";
          }
        ?>
      </table>
      <table style="width:100%">
        <th style="align:center">Game List</th>
      </table>
      <table style="width:100%">
        <tr>
          <th>ID</th>
          <th>GAME</th>
          <th>PLATFORM</th>
          <th>MANUFACTURER</th>
          <th>PRICE</th>
        </tr>
        <?php
          $query = "SELECT * FROM Games
                    WHERE item_id IN(SELECT game_id FROM Customer_Game
                                WHERE cust_id='$_POST[id]')";
          $result = mysqli_query($connection, $query);

          if(mysqli_num_rows($result) > 0){
            while($game = mysqli_fetch_assoc($result)){
              echo  "<tr>".
                    "<td align=center>$game[item_id]</td>".
                    "<td>$game[title]</td>".
                    "<td>$game[platform]</td>".
                    "<td>$game[manuf]</td>".
                    "<td align=center>$ $game[price]</td>".
                    "</tr>";
            }
          }
          else{
            echo  "<tr>
                  <td align=center>None</td><td>None</td><td>None</td>
                  <td>None</td><td align=center>None</td>
                  </tr>";
          }
        ?>
      </table>
      <table style="width:100%">
        <th style="align:center">Console List</th>
      </table>
      <table style="width:100%">
        <tr>
          <th>ID</th>
          <th>CONSOLE</th>
          <th>MANUFACTURER</th>
          <th>PRICE</th>
        </tr>
        <?php
          $query = "SELECT * FROM Consoles
                    WHERE item_id IN(SELECT cons_id FROM Customer_Console
                                WHERE cust_id='$_POST[id]')";
          $result = mysqli_query($connection, $query);

          if(mysqli_num_rows($result) > 0){
            while($console = mysqli_fetch_assoc($result)){
              echo  "<tr>".
                    "<td align=center>$console[item_id]</td>".
                    "<td>$console[name]</td>".
                    "<td>$console[manuf]</td>".
                    "<td align=center>$ $console[price]</td>".
                    "</tr>";
            }
          }
          else{
            echo  "<tr>
                  <td align=center>None</td><td>None</td>
                  <td>None</td><td align=center>None</td>
                  </tr>";
          }

          mysqli_close($connection);
        ?>
      </table>
      <fieldset>
        <legend>Return</legend>
      <form action="customer_list.php" align="right">
        <input type="submit" value="Return">
      </form>
    </fieldset>
    </section>
  </body>
</html>
