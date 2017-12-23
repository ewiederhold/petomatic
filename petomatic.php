<?php
  session_start();
  if(!isset($_SESSION['username'])){
  }
  else{
    echo($_SESSION['username']);
    if (isset($_SESSION['username'])) {
      header("Location:loggedInUser/userHomepage.php");
      exit;
    }
  }
  require 'database.php';
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8"/>
  <title>Pet-O-Matic</title>
  <link rel="stylesheet" type="text/css" href="petomatic.css"/>
  <!-- <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
  <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script> -->
</head>
<body>
  <!-- NOT LOGGED IN USER HOME PAGE -->
  <div class="header">
    <a href="">Home</a>
    <a href="login/login.html">Login</a>
    <a href="register/register.html">Register</a>
  </div>

  <div class="main-body">
    <p class="pageHeader">Welcome to Pet-O-Matic!</p><br>
  </div>

  <div class="imagesDisplay">
  <?php
  $stmt = $mysqli->prepare("SELECT image FROM images");
  #BIND PARAMS
  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();

  while($row = $result->fetch_assoc()){
    $path = 'images/' . htmlspecialchars($row["image"]);
    ?>

    <img src="<?php echo $path; ?>" height="300px"/>

    <?php
  }
  ?>
  </div>

  <script src="petomatic.js"></script>
  <!-- <script src="reactFile.js" type="text/jsx"></script> -->
</body>
</html>
