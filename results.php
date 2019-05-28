<?php
  session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Results</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </head>
    <body>
        <?php
          include("config.php");
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $usersChoice = $_POST["choice"];

          $questionId = $_SESSION["currentQuestion"];
          if ($usersChoice){
              $optionA = 1;
              $optionB = 0;
          }
          else {
              $optionA = 0;
              $optionB = 1;
          }
          // Call DB
          $sql = "CALL recordAnswer($questionId,$optionA,$optionB)";
          if ($conn->query($sql) == TRUE) {
              echo "<script>console.log('Answer recorded in DB');</script>";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }

          $sql = "CALL retrieveAnswerStatistics($questionId)";
          $pctOptionA = 0;
          $pctOptionB = 0;
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $pctOptionA = $row["pctOptionA"];
                $pctOptionB = $row["pctOptionB"];
              }
          } else {
            echo "<script>console.log('No results found');</script>";
            // exit();
          }
          $conn->close();
        ?>
        <a id="home-button" href="index.php"><i class="fas fa-home"></i></a>
        <div class="container">
          <p class="content-block optA"><?php echo $pctOptionA ?>&percnt; of users chose this answer</p>
          <p class="content-block optB"><?php echo $pctOptionB ?>&percnt; of users chose this answer</p>
          <br>
          <a href="would-you-rather.php" class="content-block green">Thank u, next</a>
        </div>
    </body>
</html>
