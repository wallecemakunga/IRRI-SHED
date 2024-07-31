<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location:index.php");
  exit();
}
?> 

<!DOCTYPE html>
<html>
<head>
  <title> profile</title>
  <link rel="icon" type="image/jpg" href="../lg.png">
  <style>
    .row {
      margin-top: -550px;
    }
  </style>
</head>

<body>
  <?php include('dashboard3.php')?>;


  <?php
  $connection = mysqli_connect('localhost', 'root', '','irri');
  $query="SELECT * from users WHERE Email='".$_SESSION['username']."'";
  $result=mysqli_query($connection,$query);
  while($row=mysqli_fetch_array($result))
  {
    $id=$row[0];
    $fname=$row[1];
    $email=$row[2];
    $city=$row[3];
    $phone=$row[4];
    ?>

    <div class="container pt-1">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card px-3 shadow">
            <div class="card-header">PROFILE</div>

            <form class="form-group pt-3" action="" method="post">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text"  value="<?php echo $fname;  ?>"  class="form-control" required>
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="text" value="<?php echo $email;  ?>" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Phone</label>
                <input type="text" value="<?php echo $phone;  ?>" class="form-control" required>
              </div>

              <div class="form-group">
                <a href="update.php?id=<?php echo $id; ?>" class="btn btn-success mt-3">Edit  profile</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
<?php }
?>
<div class="footer" style="margin-top: 70px;">
  <ul>
    <center>Copyright &copy; 2023 IRRI-SHED. All Rights Reserved</center>
  </ul>
</div>
</body>
</html>