<!-- create session variable array that stores questionIds -->
<!-- CALL listQuestionIds(); -->
<?php
    session_start();
?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Would You Rather?</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </head>
    <body>
        <?php
            include("config.php");
            $_SESSION["currentQuestion"] = -1;
            $sql = "CALL listQuestionIds()";
            $result = $conn->query($sql);
            $_SESSION["questionIdArray"] = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  array_push($_SESSION["questionIdArray"],$row["questionId"]);
                }
            }
            $conn->close();
        ?>
        <div class="container">
          <h2>Would you rather..?</h2>
          <a href="would-you-rather.php" class="content-block green">Start game</a>
          <a href="login.html" class="content-block optA">submit question</a>
          <a href="donate.html" class="content-block optB">donate</a>
        </div>
    </body>
</html>
