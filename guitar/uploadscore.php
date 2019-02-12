<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Guitar Wars - Add Your High Score</title>
  <link rel="stylesheet" type="text/css" href="style.css" />

  <style>

      body {
          max-width: 800px;
          min-width: 400px;
          margin: 50px;
      }
  
      form label {
          display: inline-block;
          width: 150px;
          font-weight: bold;
          margin: 5px 0px;
      }

    </style>

</head>

<body>

  <h2 class="lead">Guitar Wars - Add Your High Score</h2>

<?php

define('GW_UPLOADPATH', 'images/', TRUE);

  if (isset($_POST['submit'])) {
      // Grab the score data from the POST
      $name = $_POST['name'];
      $score = $_POST['score'];
      $screenshot = $_FILES['screenshot']['name'];

      if (!empty($name) && !empty($score) && is_numeric($score) && !empty($screenshot)) {
        //Move the file to the target upload folder
        $target = GW_UPLOADPATH . $screenshot;

        if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {  
        // Connect to the database
          $dbc = mysqli_connect('localhost', 'seybel', 'seyimarch001', 'gwars_db');
        
        // Write the data to the database
          $query = "INSERT INTO guitar_wars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
          mysqli_query($dbc, $query);

        // Confirm success with the user
          echo '<p>Thanks for adding your new high score!</p>';
          echo '<p><strong>Name:</strong> ' . $name . '<br />';
          echo '<strong>Score:</strong> ' . $score . '</p>';
          echo '<img src ="' . GW_UPLOADPATH . $screenshot . '" alt="Score Image"' . '<br/>' ;
          echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

        // Clear the score data to clear the form
          $name = "";
          $score = "";
          $screenshot = "";

          mysqli_close($dbc);
        } 
      }

      // if (!is_numeric($score)) {
      //   echo '<p class="error">Please enter a number as your score.</p>';
      // }

    else {
        echo '<p class="error">Please enter all of the information to add your high score.</p>';
    }
  }

?>

  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="score">Score:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" /><br />
    <label for="screenshot">Image:</label>
    <input type="file" name="screenshot" id="screenshot">
  <hr />
    <input type="submit" value="Add" name="submit" />
  </form>

</body> 
</html>

