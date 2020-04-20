<?php
  $db = 'business_service';

  function connect_db() {
    $server = '127.0.0.1';
    $user = 'test';
    $pass = 'test';
    $connect = mysqli_connect($server, $user, $pass);
    if (!$connect) {
      die ("Cannot connect to $server using $user");
    }
    return $connect;
  }

  function list_all($connect, $table_name, $columns = NULL, $is_distinct = false, $condition = NULL) {
    global $db;
    $query = "SELECT ";
    if ($is_distinct) {
      $query .= ' DISTINCT ';
    }
    if ($columns) {
      $query .= $columns;
    } else {
      $query .= '*';
    }
    $query .= " FROM $table_name";
    if ($condition) {
      $query .= " WHERE $condition;";
    } else {
      $query .= ';';
    }
    if (!mysqli_select_db($connect, $db)) {
      echo mysqli_error($connect) . '<br>';
    }
    $results_id = mysqli_query($connect, $query);
    if ($results_id) {
      return $results_id;
    } else {
      echo $query;
      echo mysqli_error($connect);
    }
  }

  function insert_category($connect, $id, $title, $desc) {
    global $db;
    $query = "INSERT INTO categories (categoryID, title, description) VALUES ('$id','$title','$desc');";
    if (!mysqli_select_db($connect, $db)) {
      echo mysqli_error($connect) . '<br>';
    }
    if (!mysqli_query($connect, $query)) {
      echo mysqli_error($connect);
    }
  }

  function insert_business($connect, $name, $address, $city, $telephone, $url, $categories) {
    global $db;
    $query = "INSERT INTO businesses (name, address, city, telephone, url) VALUES ('$name','$address','$city','$telephone','$url');";
    if (!mysqli_select_db($connect, $db)) {
      echo mysqli_error($connect) . '<br>';
    }
    if (!mysqli_query($connect, $query)) {
      echo mysqli_error($connect);
    }
    $last_id = $connect->insert_id;
    insert_biz_categories($connect, $last_id, $categories);
  }

  function insert_biz_categories($connect, $biz_id, $categories) {
    global $db;
    if (!mysqli_select_db($connect, $db)) {
      echo mysqli_error($connect) . '<br>';
    }
    foreach ($categories as $cat) {
      $query = "INSERT INTO biz_categories (businessID, categoryID) VALUES ('$biz_id','$cat');";
      if (!mysqli_query($connect, $query)) {
        echo mysqli_error($connect);
      }
    }
  }
?>
