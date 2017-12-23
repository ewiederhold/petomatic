<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header("Location:../login/login.html");
    exit;
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>UserPage</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../petomatic.css"/>
</head>
<body>
  <!-- LOGGED IN USER HOME PAGE -->
  <div class="header">
    <a href="">Feed</a>
    <a href="gallery.php">Gallery</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="main-body">
    <p class="pageHeader">Welcome to Pet-O-Matic, <?php echo $_SESSION['username']?>!</p><br>
    <input type="button" id="feedButton" value="feed me!"/>
    <input type="button" id="treatButton" value="treat me!"/>
  </div>

  <script type="text/javascript" src="http://cdn.jsdelivr.net/particle-api-js/5/particle.min.js"></script>
  <script src="../petomatic.js"></script>
</body>
</html>
