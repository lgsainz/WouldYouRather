<?php
    session_start();
?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Submit a Question</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </head>
    <body>
      <a id="home-button" href="index.php"><i class="fas fa-home"></i></a>
        <?php
            include("config.php");
            $optionA = $_POST["optionA"];
            $optionB = $_POST["optionB"];

            $sql = "CALL userSubmitQuestion('$optionA', '$optionB')";
            // CALL userSubmitQuestion('play soccer','be lazy all day');
            if ($conn -> query($sql) === TRUE) {
                echo "<div class='container'>";
                echo "<p class='content-block'>lit submission fam</p>";
                echo "<a href='submit-question.html' class='content-block green'>Submit another question?</a>";
                echo "<a href='logout.php' class='content-block optB'>Log out</a>";
                echo "</div>";
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn -> error;
            }
            $conn -> close();
        ?>
    </body>
</html>
