<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Remove Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <p>Pls select the email address to delete from the mailing-list and click remove</p>
  <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  
<?php
require_once('db_connect.php');

$dbc = mysqli_connect('DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_NAME')
  or die('Error connecting to MySQL server.');

  //Delete rows only if the form was submitted
if (isset($_POST['submit'])) {
  foreach ($_POST['todelete'] as $delete_id) {
    $query = "DELETE FROM mailing_list WHERE id=$delete_id";
      mysqli_query($dbc, $query)
        or die ('Error querying database'); 
  }
  echo 'Customer removed' . '<br/><br/>';
}

//Display the customer rows with checkboxes for deleting
$query = "SELECT * FROM mailing_list";

$result = mysqli_query($dbc, $query)
    or die('Error querying database.');
  
while ($row = mysqli_fetch_array($result)) {
  echo '<input type="checkbox" value="' .$row['id']. '" name="todelete[]" />';
  echo $row['first_name'];
  echo ' ' . $row['last_name'];
  echo ' ' . $row['email'];
  echo '<br />';   
  }
  
mysqli_close($dbc);

?>
    <input type="submit" name="submit" value="Remove" />
  </form>
</body>
</html>