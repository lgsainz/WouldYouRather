<?php
  session_start();
?>

<html>
  <head>
    <title>Donate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
  </head>
  <body>
    <a id="home-button" href="index.php"><i class="fas fa-home"></i></a>
    <?php
      include("config.php");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $donationAmount = $_POST['donation-amount'];
      $cardName = $_POST['card-name'];
      $cardNumber = $_POST['card-number'];
      $cardCvv = $_POST['card-cvv'];
      $cardExpMonth = $_POST['exp-month'];
      $cardExpYear = $_POST['exp-year'];
      $billName = $_POST['billing-name'];
      $billAddress = $_POST['billing-address'];
      $billApt = $_POST['billing apt'];
      $billCity = $_POST['billing-city'];
      $billState = $_POST['billing-state'];
      $billZip = $_POST['billing-zip'];

      $sql = "CALL recordTransaction($donationAmount,'$cardName', '$cardNumber', $cardCvv, $cardExpMonth, $cardExpYear, '$billName', '$billAddress', '$billApt', '$billCity', '$billState', $billZip)";
      if ($conn->query($sql) == TRUE) {
          echo "<div class='container'>";
          echo "<p class='content-block'>Thanks for your donation!</p>";
          echo "<a href='donate.html' class='content-block green'>Donate again?</a>";
          echo "<a href='would-you-rather.php' class='content-block optA'>return to game</a>";
          echo "</div>";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
          header('Location: donate.php');
      }
    ?>
  </body>
</html>
