<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Business Listings</title>
  </head>
  <body>
    <?php
      require('db.php');
      $connect = connect_db();
      $keys = array('category');
      foreach ($keys as $key) {
        if (array_key_exists($key, $_GET)) {
          $$key = $_GET[$key];
        } else {
          $$key = NULL;
        }
      }
    ?>
    <h1>Business Listings</h1>
    <form action="biz_listing.php" method="get" style="float: left; margin-right: 2rem;">
      <select size="5" name="category" onchange="this.form.submit()">
        <?php
          $results_id = list_all($connect, 'categories', 'categoryID', true);
          while ($row = mysqli_fetch_row($results_id)) {
            print '<option>';
            print $row[0];
            print '</option>';
          }
        ?>
      </select>
    </form>
    <br>
    <table border="1">
      <tbody>
        <?php
          $table = '((businesses
INNER JOIN biz_categories ON businesses.businessID = biz_categories.businessID)
INNER JOIN categories ON categories.categoryID = biz_categories.categoryID)';
          if ($category) {
            $condition = "categories.categoryID='$category'";
          } else {
            $condition = NULL;
          }
          $results_id = list_all($connect, $table, NULL, false, $condition);
          while ($row = mysqli_fetch_row($results_id)) {
            print '<tr>';
            foreach ($row as $field) {
              print "<td>$field</td> ";
            }
            print '</tr>';
          }
        ?>
      </tbody>
    </table>
  </body>
</html>
