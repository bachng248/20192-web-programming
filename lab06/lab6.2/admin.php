<html>
<head>
<?php
 require_once('db_login.php');
?>

<title>
<?php
 // print the window title and the topmost body heading
 $doc_title = 'Category Administration';
 echo "$doc_title\n";
?>
</title>
</head>
<body>
<h1>
<?php
 echo "$doc_title\n";
?>
</h1>

<?php
function getRequestData($index) {
    if ( isset($_REQUEST[$index]) ) {
        return $_REQUEST[$index];
    }
    return NULL; 
}

 $add_record = 0;
 $Cat_ID = '';
 $len_cat_id = 0;
 $Cat_Title = '';
 $len_cat_tl = 0;
 $Cat_Desc = '';
 $len_cat_de = 0;
 
 // add category record input section

 // extract values from $_REQUEST and their respective length
 if ( getRequestData('Cat_ID') ) {
    $Cat_ID = getRequestData('Cat_ID');
    $len_cat_id = strlen($Cat_ID);
}
if ( getRequestData('Cat_Title') ) {
    $Cat_Title = getRequestData('Cat_Title');
    $len_cat_tl = strlen($Cat_Title);
}
if ( getRequestData('Cat_Desc') ) {
    $Cat_Desc = getRequestData('Cat_Desc');
    $len_cat_de = strlen($Cat_Desc);
}
if ( getRequestData('add_record') ) {
    $add_record = getRequestData('add_record');
}

// print("$add_record - $Cat_ID - $Cat_Title - $Cat_Desc");
 // validate and insert if the form script has been
 // called by the Add Category button
 if ($add_record == 1) {
     if (($len_cat_id > 0) and ($len_cat_tl > 0) and ($len_cat_de > 0)){
         $sql  = "insert into categories (categoryid, title, description)";
         $sql .= " values ('$Cat_ID', '$Cat_Title', '$Cat_Desc')";
         $result = $db->query($sql);
         if (DB::isError($result)) {
             echo 'Error while inserting into categories';
         }
         $db->commit(  );
     } else {
     echo "<p>Please make sure all fields are filled in ";
     echo "and try again.</p>\n";
     }
 }

 // list categories reporting section

 // query all records in the table after any
 // insertion that may have occurred above
 $sql = "select * from categories";
 $result = $db->query($sql);
?>

<form method="post" action="">

<table>
<tr><th bgcolor="#eeeeee">Cat ID</th>
    <th bgcolor="#eeeeee">Title</th>
    <th bgcolor="#eeeeee">Description</th>
</tr>

<?php
 // display any records fetched from the database
 // plus an input line for a new category
 while ($row = $result->fetchRow(  )){
     echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>\n";
 }
?>
<tr><td><input type="text" name="Cat_ID"    size="15" maxlength="10" /></td>
    <td><input type="text" name="Cat_Title" size="40" maxlength="128" /></td>
    <td><input type="text" name="Cat_Desc"  size="45" maxlength="255" /></td>
</tr>
</table>
<input type="hidden" name="add_record" value="1" />
<input type="submit" name="submit" value="Add Category" />
</form>
</body>
</html>
