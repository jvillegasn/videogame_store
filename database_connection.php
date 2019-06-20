
<?php

  $username = "root";
  $password = "12345";
  $host = "127.0.0.1";
  $database = "store_records";

  $connection = mysqli_connect($host, $username, $password, $database);

  if(!$connection){
    die('Error connecting to database');
  }

?>
