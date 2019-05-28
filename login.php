<?php
  session_start();
?>

<html>
<head>
  <title>Log In</title>
  <script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</head>
<body>
  <?php
  include("config.php");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "CALL verifyLogin('$username','$password');";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $_SESSION["userId"] = $row["userId"];
          $_SESSION["userName"] = $row["username"];
      }
      header("Location: http://codd.cs.gsu.edu/~lgarciasainz1/Project3/submit-question.html"); /* Redirect browser */
      exit();
  } else {
    header("Location: http://codd.cs.gsu.edu/~lgarciasainz1/Project3/login.html"); /* Redirect browser */
    exit();
  }
  $conn->close();
  ?>

</body>
</html>
