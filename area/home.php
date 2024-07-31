<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:index.php");
}else
?>
<!DOCTYPE html>
<html>
<head>
  <title> Home</title>
  <link rel="stylesheet" href="dash.css"/>
  <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/popup_style.css">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link rel="icon" type="image/jpg" href="../lg.png">
  <style>
    img {
      border-radius: 5px 5px 0 0;
    }
    .containers {
      padding: 2px 16px;
    }
  </style>
</head>

<body>
  <?php include('dashboard.php')?>;


  <div class="footer" style="margin-top: 70px;">
    <ul>
      <center>Copyright &copy; 2023 IRRI-SHED. All Rights Reserved</center>
    </ul>
  </div>
</body>
</html>
   