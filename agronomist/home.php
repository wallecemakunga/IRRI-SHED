<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}
require_once("../config.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="form.css"/>
    <link rel="icon" type="image/jpg" href="../lg.png">
    <style>
      form {
        padding: 15px;
        background: #fff;
        max-width: 500px;
        width: 100%;
        border-radius: 17px;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
        margin-left: 600px;
        margin-top: -600px;
      }
    </style>
    
</head>

<body>
<?php include('dashboard3.php')?>;




  <div class="footer" style="margin-top: 70px;">
    <ul><center>Copyright &copy; 2023 IRRI-SHED. All Rights Reserved</center></ul>
  </div>
</body>
</html>