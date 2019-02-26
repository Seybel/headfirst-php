<?php
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname']; 
$full_name = $_POST['firstname'] . ' ' . $_POST['lastname'];
$when_it_happened = $_POST['whenithappened'];
$how_long = $_POST['howlong'];
$how_many = $_POST['howmany'];
$alien_description = $_POST['description'];
$what_they_did = $_POST['whattheydid'];
$fang_spotted = $_POST['fangspotted'];
$email = $_POST['email'];
$other = $_POST['other'];

echo 'Thanks for submitting the form ' . $full_name . '.<br />';
echo 'You were abducted ' . $when_it_happened;
echo ' and were gone for ' . $how_long . '<br />';
echo 'How many did you see? ' . $how_many . '<br />';
echo 'Describe them: ' . $alien_description . '<br />';
echo 'What did they do to you? ' . $what_they_did . '<br />';
echo 'Was fang there? ' . $fang_spotted . '<br />';
echo 'Your email address is ' . $email . '<br />';
echo 'Anything else you want to add: ' . $other;

// $to = 'user@example.com';
// $subject = 'Aliens abducted me - Abduction report';
// $msg = "$full_name was abducted $when_it_happened amd was gone for $how_long.\n" .
// "Number of aliens: $how_many\n" .
// "Alien description: $alien_description\n" .
// "What they did: $what_they_did\n" .
// "Fang spotted: $fang_spotted\n" .
// "Other comments: $other";

// mail($to, $subject, $msg, 'From:' . $email);
require_once('db_connect.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
 or die('Error connecting to mySQL server.');

$query = "INSERT INTO aliens_abduction(first_name, last_name, when_it_happened, how_long, " . 
"how_many, alien_description, what_they_did, fang_spotted, other, email) " .
"VALUES ('$first_name', '$last_name', '$when_it_happened', '$how_long', '$how_many', '$alien_description', " .
"'$what_they_did', '$fang_spotted', '$other', " .
"'$email')";

$result = mysqli_query($dbc, $query)
 or die('Error querying database.');

 mysqli_close($dbc);
 
?>