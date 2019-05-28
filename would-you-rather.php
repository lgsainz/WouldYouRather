<?php
  session_start();
?>

<html>
  <head>
    <title>Would You Rather?</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
  </head>
  <body>
    <?php
      include("config.php");
      if($_SESSION["questionIterator"]<(count($_SESSION["questionIdArray"])-1)) {
        $_SESSION["questionIterator"]++;
      } else {
        $_SESSION["questionIterator"] = 0;
      }
      $_SESSION["currentQuestion"] = $_SESSION["questionIdArray"][$_SESSION["questionIterator"]];
      $currentQuestionId = $_SESSION["currentQuestion"];
      $sql = "CALL retrieveOptionsByQuestionId($currentQuestionId)";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $optionA  = $row["optionA"];
            $optionB  = $row["optionB"];
          }
      }
      $conn->close();
    ?>
    <a id="home-button" href="index.php"><i class="fas fa-home"></i></a>
    <div class="container">
      <h2 class="content-block">Would you rather..?</h2>
      <form action="results.php" method="post">
        <input id="optA" type="radio" name="choice" value="1" required>
        <label for="optA" class="content-block optA"><?php echo $optionA ?></label>
        <input id="optB" type="radio" name="choice" value="0" required>
        <label for="optB" class="content-block optB"><?php echo $optionB ?></label>
        <input type="submit" class="content-block green" value="submit answer">
      </form>
    </div>
  </body>
</html>
