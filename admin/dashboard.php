<?php session_start();
  if(!isset($_SESSION['id'])) {
    header("Location: ../index.php");
		exit();
  }
?>
<!DOCTYPE html>
<html>
<title>BR Blog</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" sizes="16x16">
<meta name="_base_url" content="<?php $url = $_SERVER['REQUEST_URI']; ?>">

<link rel="stylesheet" href="../assets/css/w3.css">
<link rel="stylesheet" href="../assets/css/post-form.css">
<link rel="stylesheet" href="../assets/css/style.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/validation.min.js"></script>

<style>
  html,body,h1,h2,h3,h4,h5 { font-family: "Raleway", sans-serif }
  .error{
        font-size: 13pt;
        color:darkred;
    }
</style>
<body class="w3-light-grey">
  <?php include('navbar.php'); ?>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:250px;margin-top:43px;">
  <!-- !Main CONTENT! -->
    <?php include('placeholder.php'); ?>
    <!-- Footer -->
    <?php //include('footer.php'); ?>
    <!-- End page content -->
  </div>
  <script>
  // Get the Sidebar
  var mySidebar = document.getElementById("mySidebar");
  // Get the DIV with overlay effect
  var overlayBg = document.getElementById("myOverlay");
  // Toggle between showing and hiding the sidebar, and add overlay effect
  function w3_open() {
      if (mySidebar.style.display === 'block') {
          mySidebar.style.display = 'none';
          overlayBg.style.display = "none";
      } else {
          mySidebar.style.display = 'block';
          overlayBg.style.display = "block";
      }
  }
  // Close the sidebar with the close button
  function w3_close() {
      mySidebar.style.display = "none";
      overlayBg.style.display = "none";
  }
  </script>

</body>
</html>
