<html>
<body>
  <?php
  $servername = "localhost";
  $username = "rtoledo1";
  $password = "rtoledo1";
  $dbname = "rtoledo1";

  // Create connection
  $conn = new mysqli($servername,$username,$password,$dbname);

  // Check connection
  if($conn -> connect_error){
    die("Guess I'll go die then:" .$conn -> connect_error);
  }
  ?>

</body>
</html>
