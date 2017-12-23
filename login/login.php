<?php
  require '../database.php';

  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $mysqli->prepare("SELECT id, password FROM users where username=?");

  $stmt->bind_param('s', $username);
  $stmt->execute();

  $stmt->bind_result($user_id, $pwd_hash);
  $stmt->fetch();

  #COMPARE INPUTTED PASSWORD WITH PASSWORD IN DATABASE
  if(password_verify($password, $pwd_hash)){
    #SUCCESSFUL LOGIN
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id;

    header("Location:../loggedInUser/userHomepage.php");
    exit;
  }else{
    #UNSUCCESSFUL LOGIN
    echo("The combination of username and password was not valid.");
    exit;
  }
?>
