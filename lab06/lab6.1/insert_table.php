<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inser Results</title>
  </head>
  <body>
    <?php
      $Item = $_POST['Item'];
      $Cost = $_POST['Cost'];
      $Weight = $_POST['Weight'];
      $Quantity = $_POST['Quantity'];

      $host = '127.0.0.1';
      $user = 'test';
      $passwd = 'test';
      $database = 'test';
      $connect = mysqli_connect($host, $user, $passwd);
      $table_name = 'Products';
      $query = "INSERT INTO $table_name VALUES ('0','$Item','$Cost','$Weight','$Quantity')";
       print "The Query is <i>$query</i><br>";
       mysqli_select_db($connect, $database);
       print '<br><font size="4" color="blue">';
       if (mysqli_query($connect, $query)) {
         print "Insert into $database was successful!</font>";
       } else {
         print "Insert into $database failed!</font>";
       }
       mysqli_close($connect);
     ?>
  </body>
</html>
