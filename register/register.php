<?php
  require '../database.php';
  #GETS PREFERRED USERNAME AND PASSWORD
  $username = $_POST['username'];
  $password = $_POST['password'];
  #ENCRYPT PASSWORD
  $encrypted_password = password_hash($password, PASSWORD_BCRYPT);
  #INSERT NEW USER INTO THE DOGFEEDER DATABASE IN THE USERS TABLE
  $stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");

  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }

  $stmt->bind_param('ss', $username, $encrypted_password);
  $stmt->execute();
  $stmt->close();

  if ($stmt) {
    $stmt = $mysqli->prepare("SELECT id FROM users where username=?");

    $stmt->bind_param('s', $username);
    $stmt->execute();

    $stmt->bind_result($user_id);
    $stmt->fetch();
    // create session
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id;
    header("Location:../loggedInUser/userHomepage.php");
    exit;
  }
  else { // failure
    echo("failure");
    exit;
  }
?>
