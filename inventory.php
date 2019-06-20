
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
    <section class="longlist">
      <table style="width:100%">
        <th style="align:center"> Item List</th>
      </table>
      <table style="width:100%">
        <tr>
          <th>ITEM ID</th>
          <th>ITEM NAME</th>
          <th>PRICE</th>
          <th>IN STOCK</th>
        </tr>
        <?php
          include "database_connection.php";

          $query = "SELECT I.item_id, C.name AS name, C.price, I.in_stock
                    FROM Inventory I, Consoles C
                    WHERE I.item_id=C.item_id
                    UNION
                    SELECT I.item_id, G.title, G.PRICE, I.in_stock
                    FROM Inventory I, Games G
                    WHERE I.item_id=G.item_id";
          $result = mysqli_query($connection, $query);

          if(mysqli_num_rows($result) > 0){
            while($item = mysqli_fetch_assoc($result)){
                echo  "<tr>
                      <td align=center>$item[item_id]</td>
                      <td>$item[name]</td>
                      <td align=center>$item[price]</td>
                      <td align=center>$item[in_stock]</td>
                      </tr>";
            }
          }
          else{
            echo "<tr>
                  <td> None </td><td> None </td>
                  <td> None </td><td> None </td>
                  </tr>";
          }

          mysqli_close($connection);
        ?>
      </table>
      <fieldset>
        <legend>Options</legend>
        <form action="inventory.php" method="post">
          Customer ID: <input type="text" name="cust_id" size="7" maxlength="5" required>
          Item ID: <input type="text" name="item_id" size="7" maxlength="6" required>
          <input type="submit" formaction="sell.php" value="Item Sell">
          <input type="submit" formaction="return.php" value="Item Return">
          <input type="reset" value="Clear">
        </form>
      </fieldset>
      <fieldset>
        <legend>Return</legend>
        <form action="index.php" align="right">
          <input type="submit" value="Return">
        </form>
      </fieldset>
    </section>
  </body>
</html>
