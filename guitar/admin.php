<?php require_once('adminHttpAuth.php')?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guitar wars | Admin</title>
</head>

<body>
    <h2>Guitar wars Highscores Administration</h2>
    <p>Below is a list of all Guitar Wars high scores. Use this page to remove scores as needed.</p>
    <hr />

    <?php
    require_once('app_vars.php');
    require_once('db_connect.php');

    //connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connecting to database');

    //Retrieve the score data from mysql
    $query = "SELECT * FROM guitar_wars ORDER BY score DESC, date ASC";
    $data = mysqli_query($dbc, $query)
        or die('Error querying database');

    // Loop through the array of score data, formatting it as HTML 
    echo '<table>';
    while ($row = mysqli_fetch_array($data)) {
        //display the score data
        echo '<tr><td><strong>' . $row['name'] . '<strong><td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['score'] . '</td>';
        echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
            '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] .
            '&amp;screenshot=' . $row['screenshot'] . '">Remove</a></td></tr>';
    }
    echo '</table>';

    mysqli_close($dbc);
    ?>

</body>

</html> 