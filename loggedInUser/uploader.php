<?php
require '../database.php';
session_start();
if (!isset($_SESSION['username'])) {
  header("Location:../login/login.html");
  exit;
}

// ini_set('upload_max_filesize', '3M');
// ini_set('post_max_size', '3M');

$currentUserID = $_SESSION['user_id'];
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if(!preg_match('/^[\w_\.\-]+$/', $filename)){
  $Message = 'invalid filename';
  header("Location: gallery.php?Message=" . urlencode($Message));
	exit;
}

// Get the username and make sure it is valid
$username = $_SESSION['username'];
if(!preg_match('/^[\w_\-]+$/', $username)){
  $Message = 'invalid username';
  header("Location: gallery.php?Message=" . urlencode($Message));
	exit;
}

if(($_FILES['uploadedfile']['size'] >= 5000000) || ($_FILES['uploadedfile']['size'] == 0)){
  $Message = 'file must be less than 5MB /// ' . $_FILES['uploadedfile']['size'] . ' /// ' . ini_get('upload_max_filesize');;
  header("Location: gallery.php?Message=" . urlencode($Message));
  exit;
}

$full_path = sprintf("/home/ewiederhold/public_html/creativeProject/images/%s", $filename);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path)){
  // echo($_FILES['uploadedfile']['size']);
  $Message = 'upload was successful';
  header("Location: gallery.php?Message=" . urlencode($Message));
  //echo("upload was successful");
	//exit;
}else{
  // echo($_FILES['uploadedfile']['size']);
  $Message = 'upload failed';
  header("Location: gallery.php?Message=" . urlencode($Message));
	// echo("upload failed");
	//exit;
}

/*
*
* UNCOMMENT THE FOLLOWING ONCE A FILE IS SUCCESSFULLY BEING UPLOADED TO /SRV/IMAGES
*
*/

//echo("above statment");
#INSERT NEW IMAGE INTO THE DOGFEEDER DATABASE IN THE IMAGES TABLE
$stmt = $mysqli->prepare("insert into images(user_id, image) values (?, ?)");

// if(!$stmt){
//
// }
//echo("above binding");

$stmt->bind_param("ss", $currentUserID, $filename);
$stmt->execute();
$stmt->close();
//echo("below binding");
if (!$stmt) {
  printf("Query Prep Failed: %s\n", $mysqli->error);
  // exit;
  // printf("an error occurred when trying to upload your file");
  $Message = 'an error occurred when trying to upload your file';
  header("Location: gallery.php?Message=" . urlencode($Message));
  //exit;
}
else{
  // printf($currentUserID . " /// " . $filename);
  //$Message = 'file uploaded successful"';
  header("Location: gallery.php");
  // printf("file uploaded successful");
  //exit;
}
//echo("end of file");
?>
