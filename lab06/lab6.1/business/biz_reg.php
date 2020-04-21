<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Business Registration</title>
  </head>
  <body>
    <?php
      require('db.php');
      $connect = connect_db();
      $keys = array('name', 'address', 'city', 'tel', 'url', 'categories');
      $is_ready = true;
      foreach ($keys as $key) {
        if (array_key_exists($key, $_POST)) {
          $$key = $_POST[$key];
        } else {
          $$key = NULL;
          $is_ready = false;
        }
      }
      if ($is_ready) {
        insert_business($connect, $name, $address, $city, $tel, $url, $categories);
        echo '<br>New bussiness created!';
      }
    ?>
    <br>
    <a href="biz_listing.php">Go to listing</a>
    <h1>Business Registration</h1>
    <form action="biz_reg.php" method="post">
      <table>
        <tr>
          <td>Name:</td>
          <td>
            <input type="text" name="name">
          </td>
        </tr>
        <tr>
          <td>Adress:</td>
          <td>
            <input type="text" name="address">
          </td>
        </tr>
        <tr>
          <td>City:</td>
          <td>
            <input type="text" name="city">
          </td>
        </tr>
        <tr>
          <td>Telephone:</td>
          <td>
            <input type="text" name="tel">
          </td>
        </tr>
        <tr>
          <td>URL:</td>
          <td>
            <input type="text" name="url">
          </td>
        </tr>
        <tr>
          <td>Category:</td>
          <td>
            <select size="5" multiple name="categories[]">
              <?php
                $results_id = list_all($connect, 'categories', 'categoryID', true);
                while ($row = mysqli_fetch_row($results_id)) {
                  print '<option>';
                  print $row[0];
                  print '</option>';
                }
              ?>
            </select>
          </td>
        </tr>
      </table>
      <input type="submit" value="SUBMIT">
      <input type="reset" value="RESET">
    </form>
  </body>
</html>
