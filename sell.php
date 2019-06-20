
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

        $query = "SELECT * FROM Inventory
                  WHERE item_id='$_POST[item_id]' AND in_stock <> 0";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result)==0){
          echo 'ITEM IS NOT IN STOCK!';
        }
        else{
          if($_POST['item_id'] >= 100000 && $_POST['item_id'] < 200000){
            $query = "INSERT INTO Customer_Game(cust_id, game_id)
                      VALUES('$_POST[cust_id]', '$_POST[item_id]') ";
          }
          else if($_POST['item_id'] >= 200000 && $_POST['item_id'] < 300000){
            $query = "INSERT INTO Customer_Console(cust_id, cons_id)
                      VALUES('$_POST[cust_id]', '$_POST[item_id]') ";
          }
          $result = mysqli_query($connection, $query);

          echo 'SALE COMPLETED';
        }

        mysqli_close($connection);
      ?>
      <fieldset>
        <legend>Return</legen>
        <form action="inventory.php" align="right">
          <input type="submit" value="Return">
        </form>
      </fieldset>
    </section>
  </body>
</html>
