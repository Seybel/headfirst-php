<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Elmer | Newsletter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            max-width: 800px;
            min-width: 400px;
            margin: 50px;
        }
    
        #lead {
            margin-top: -30px;
            font-size: 16px;
            color: #333;
        }
    
        form label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

    </style>
    
</head>
<body>
    <p class="lead"><b>Private: </b>For Elmer's use ONLY</p>
    <p class="lead">Write and send an email to mailing list members</p>

<?php
require_once('db_connect.php');

if (isset($_POST['submit'])) {
$from = 'elmer@makemeelvis.com';
$subject = $_POST['subject'];
$msg_body = $_POST['body'];
$output_form = false;

if (empty($subject) && empty($msg_body)) {
    echo "The subject and message body cannot be empty.";
    $output_form = true;
}
if ((!empty($subject)) && empty($msg_body)) {
    echo "The message body cannot be empty.";
    $output_form = true;
}
if (empty($subject) && (!empty($msg_body))) {
    echo "The subject cannot be empty.";
    $output_form = true;
 } 
}
else {
    $output_form = true;
}

if ((!empty($subject)) && (!empty($msg_body))) {
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connecting to MySQL server.');

    $query = "SELECT * FROM mailing_list";

    $result = mysqli_query($dbc, $query)
        or die('Error querying database.');

    while ($row = mysqli_fetch_array($result)) {
        $to = $row['email'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $msg = "Dear $first_name $last_name,\n $msg_body";
        mail($to, $subject, $msg, 'From:' . $from);
        echo 'Email sent to: ' . $to . '<br />';
    }

    mysqli_close($dbc);    
}

if ($output_form) {
    
?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="subject">Subject of email: </label><br>
        <input type="text" id="subject" name="subject" value="<?php if (!empty($subject)) echo $subject; ?>" size="59"/><br><br>
        <label for="elvisemail">Body of email: </label><br>
        <textarea name="body" id="body" cols="60" rows="10"><?php if (!empty ($msg_body)) echo $msg_body; ?></textarea><br>
        <input type="submit" id="submit" name="submit" value="Submit">
    </form>
<?php
}
?>
</body>
</html>
