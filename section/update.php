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
<title>Edit profile</title>
    <link rel="icon" type="image/jpg" href="../lg.png">
  <meta charset="utf-8">
  <style>
      .sidebar{
position: fixed;
left: 0;
width: 250px;
height: 100%;
background:#fff;

}
 .row {
      margin-top: -550px;
     
    }
  </style>
</head>
<body>
 <?php include('dashboard4.php')?>; 


<?php

$con = mysqli_connect('localhost', 'root', '','irri');
if (!$con){
    die("Connection Failed" . mysql_error());
}
  

$id=@$_GET['id'];
$q = mysqli_query($con, "SELECT * FROM users  where user_id='$id' ");



$row=mysqli_fetch_array($q);

if(isset($_POST['update'])){
$fname = $_POST["fname"];
$email = $_POST["email"];
$phone = $_POST["phone"];


$query = "UPDATE users SET `Full Name`='$fname', Email='$email', Phone_Number='$phone' WHERE user_id='$id'";

$result = mysqli_query($con,$query);
 
if($result==true){
  echo"
  <div class='popup popup--icon -success js_success-popup popup--visible'>
  <div class='popup__background'></div>
  <div class='popup__content'>
    <h3 class='popup__content__title'>
      Success 
    </h1>
    <p>Profile Updated Successfully</p>
    <p>
    
    <a href='section.php'><button class='button button--success' data-for='success'>Return to Profile</button></a>
    </p>
  </div>
</div>";
          }

          else{
            echo" <div class='popup popup--icon -error js_error-popup popup--visible'>
            <div class='popup__background'></div>
            <div class='popup__content'>
              <h3 class='popup__content__title'>
                Error 
              </h1>
              <p>Update Failed</p>
              <p>
              <a href=''><button class='button button--error' data-for='js_error-popup'>Close</button></a>
              </p>
            </div>
          </div>";
          }

}

?>

 <div class="container pt-1">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card px-3 shadow">
            <div class="card-header"> EDIT PROFILE</div>

            <form class="form-group pt-3" action="" method="post">
              <div class="form-group">
                <label>Full Name</label>
                 <input id="name" name="fname" placeholder="Fullname" class="form-control" type="text" value="<?php echo $row[1]; ?>"> 
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="text"  name="email" value="<?php echo $row['Email'];  ?>" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Phone</label>
                <input type="text"  name="phone" value="<?php echo $row['Phone_Number'];?>" class="form-control" required>
              </div>

              <div class="form-group">
                <input  type="submit"  name="update"  class="btn btn-success mt-3"value="Update"/>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>