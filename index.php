<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Javier's Videogame Store </title>
    <link rel="stylesheet" href="store_style.css">
  </head>
  <body>
    <header>
      <?php include "header.html" ?>
    </header>
    <section class="index">
      <fieldset>
        <legend> Register New Account </legend>
        <form action="new_account.php" method="post">
          ID: <input type="text" name="id" size="7" maxlength="5" required>
          Name: <input type="text" name="name" size="30" maxlength="25" required>
          Age: <input type="number" name="age" min="15" max="100" value="15" required>
          Sex: <input type="radio" name="sex" value="M"> Male
          <input type="radio" name="sex" value="F"> Female
          <input type="radio" name="sex" value="-" checked> Other <br>
          Address: <input type="text" name="address" size="85" maxlength="100" required><br>
          Phone: <input type="text" name="phone" size="15" maxlength="10" required>
          Email: <input type="email" name="email" size="30" maxlength="50" required>
          <input type="submit" value="Register">
          <input type="reset" value="Clear">
        </form>
      </fieldset>
      <fieldset>
        <legend> Options </legend>
        <form action="">
          <input type="submit" formaction="customer_list.php" value="Customers List">
          <input type="submit" formaction="inventory.php" value="Inventory List">
        </form>
      </fieldset>
    </section>
  </body>
</html>
