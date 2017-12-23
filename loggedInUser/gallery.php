<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header("Location:../login/login.html");
    exit;
  }
  if (isset($_GET['Message'])) {
    print '<script type="text/javascript">alert("' . $_GET['Message'] . '");</script>';
  }
  require '../database.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>UserGallery</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../petomatic.css"/>
    <!-- <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/react-image/umd/index.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script> -->

</head>
<body>
  <!-- LOGGED IN USER HOME PAGE -->
  <div class="header">
    <a href="userHomepage.php">Feed</a>
    <a href="">Gallery</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="main-body">
    <p class="pageHeader">Welcome to your Photo Gallery, <?php echo $_SESSION['username']?>!</p><br>
  </div>

  <form enctype="multipart/form-data" action="uploader.php" method="POST">
	<p class="imageUpload">
		<input type="hidden" name="MAX_FILE_SIZE" value="50000000"/>
		<label for="uploadfile_input">Choose a new image to upload:</label>
    <input type="file" name="uploadedfile" id="uploadfile_input" accept=".jpg, .jpeg, .png, .tiff"/>
	</p>
	<p class="imageUpload">
		<input type="submit" value="Upload"/>
	</p>
</form>
<div class="imagesDisplay">
  <?php
  #GETS CURRENT USER ID
  $currentUserID = $_SESSION['user_id'];
  #CREATE STATEMENT
  $stmt = $mysqli->prepare("SELECT image FROM images where user_id=?");
  #BIND PARAMS
  $stmt->bind_param('i', $currentUserID);
  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();

  while($row = $result->fetch_assoc()){
    $path = '../images/' . htmlspecialchars($row["image"]);
    ?>

    <img src="<?php echo $path; ?>" height="300px"/>

    <?php
  }
  ?>
</div>
<!-- <div id="root">hi</div> -->
<!-- <button id="btn">Done</button> -->
</body>
<!-- <script type="text/babel">
  <Lightbox
    images={[
      { src: '/images/usmSunset.jpg' },
    ]}
    isOpen={this.state.lightboxIsOpen}
    onClickPrev={this.gotoPrevLightboxImage}
    onClickNext={this.gotoNextLightboxImage}
    onClose={this.closeLightbox}
  />
</script> -->
<!-- <script type="text/babel">
  ReactDOM.render(
    <h1>Sherlock Holmes</h1>,
    document.body
  );
</script> -->
<!-- <script type="text/jsx" src="../reactFile.js"></script> -->
</html>
