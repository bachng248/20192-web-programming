<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Category Administration</title>
  </head>
  <body>
    <?php
      require('db.php');
      $connect = connect_db();
      $keys = array('id', 'title', 'desc');
      foreach ($keys as $key) {
        if (array_key_exists($key, $_POST)) {
          $$key = $_POST[$key];
        } else {
          $$key = NULL;
        }
      }
      if ($id && $title && $desc) {
        insert_category($connect, $id, $title, $desc);
      }
    ?>
    <h1>Category Administration</h1>
    <form action="cat_admin.php" method="post">
      <table border="1">
        <thead>
          <tr>
            <th>CatID</th>
            <th>Title</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $results_id = list_all($connect, 'categories');
          while ($row = mysqli_fetch_row($results_id)) {
            print '<tr>';
            foreach ($row as $field) {
              print "<td>$field</td> ";
            }
            print '</tr>';
          }
          ?>
          <tr>
            <td>
              <input type="text" name="id">
            </td>
            <td>
              <input type="text" name="title">
            </td>
            <td>
              <input type="text" name="desc">
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" value="Add Category" style="width: 100%">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </body>
</html>
