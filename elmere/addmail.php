<?php
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$full_name = $_POST['firstname'] . " " . $_POST['lastname'];
$email = $_POST['email'];

echo 'Hello ' . $full_name . ', thanks for subscribing to our mailing list, ' .
'we would update you with offers that suit your needs on a daily basis.';

require_once('db_connect.php');

$database = mysqli_connect('DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_NAME')
or die('Error connecting to mySql');

$query = "INSERT INTO mailing_list(first_name, last_name, email)" . 
"VALUES ('$first_name', '$last_name', '$email')";

$result = mysqli_query($database, $query)
or die('Error querying database');

mysqli_close($database);

?>