<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location:index.php");
  exit();
}


$id=@$_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <style>
      .sidebar{
position: fixed;
left: 0;
width: 250px;
height: 100%;
background:#fff;
margin-top: -46px;
}
  </style>
</head>
<body>
 <?php include('dashboard.php')?>; 


<?php

$connection = mysqli_connect('localhost', 'root', '','irri');
if (!$connection){
    die("Connection Failed" . mysql_error());
}
  

  $select_db = mysqli_select_db($connection,'irri');
if (!$select_db){
    die("Database Selection Failed" . mysql_error());
}


    $query =mysqli_query($connection,"SELECT * FROM users WHERE Email = '$id' ");
    //mysqli_query($dbcon,"SELECT * FROM farm WHERE farmID='$email' " )or die('Error157');
    $result= mysqli_query($connection,$query);

    $row=mysqli_fetch_array($result);

  $fnameErr=$lnameErr=$cityErr=$mobilenoErr=$emailErr="";
    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(!preg_match("/[A-Za-z]/", $_POST['fname'])){
        $fnameErr = "Not a valid Name.";
    }
    if(!preg_match("/[A-Za-z]/", $_POST['lname'])){
        $lnameErr = "Not a valid Name.";
    }
     if(!preg_match("/[A-Za-z]/",$_POST['city'])){
        $cityErr="Not a valid city";
    }
     if(!preg_match("/[0-9]/",$_POST['phone']) && strlen($_POST['phone'])!=10){
        $mobilenoErr="Not a valid phone number and Phone Number must contain 10 characters";
    }


    if(preg_match("/.+@.+\..+/", $_POST['email'])=== 0){
        $emailErr = "Not a valid e-mail address.";
    }}


if (isset($_POST['submit'])) { 

if($fnameErr=="" && $lnameErr=="" && $cityErr=="" && $mobilenoErr=="" && $emailErr=="" ){
  $id=$_REQUEST['id'];

$query = "UPDATE register SET title='".$_POST['title']."', fname='".$_POST['fname']."', lname='".$_POST['lname']."', dob='".$_POST['dob']."',  city='".$_POST['city']."',
    username='".$_POST['username']."',phone='".$_POST['phone']."',email='".$_POST['email']."' where id='$id' ";

             $result = mysqli_query($connection,$query);
          if($result==true){

            echo" <div class='popup popup--icon -success js_success-popup popup--visible'>
          <div class='popup__background'></div>
          <div class='popup__content'>
            <h3 class='popup__content__title'>
              Success
            </h1>
            <p>  profile Successfully updated </p>
            <p>
            <a href='profile.php'><button class='button button--success' data-for='success'>Return to profile Page</button></a>
            </p>
          </div>
        </div>";
      }
}
}


?>

 <div class="container">
    <div class="jumbotron">
        <h1 style="text-align: center; color: gray"><strong><br></strong></h1>
                    <body class="bg-light">
        <div class="container pt-1">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card px-3 shadow">
                        <div class="card-header">EDIT PROFILE</div>
                        <form class="form-group pt-3" action="" id="form" method="post">
                            <div class="form-group">                 
                                <label>Title</label><br/>
                                    <select id="title" name="title" class="form-control">
                                    <option value= "<?php echo$row['Email']; ?>"><?php echo$row[1]; ?> </option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    </select><br/>
                            </div>
                            <div class="form-group">                
                                <label>First Name</label>
                                <input type="text" placeholder="Enter password" name="fname" class="form-control" required="required" id="name" value="<?php echo$row[2]; ?>">
                                      <?php echo "<h5>" .$fnameErr. "</h5>";  ?>
                            </div>
                             <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" id="name" value="<?php echo$row[3]; ?>">
                               <?php echo "<h5>" .$lnameErr. "</h5>";  ?>

                            <div class="form-group">                
                               <label>Date of Birth</label>
                               <input type="date"  name="dob" class="form-control" value="<?php echo$row[4]; ?>"><br/>

                            </div>
                            <div class="form-group">                
                               <label>City</label>
                               <input type="text"  name="city" class="form-control" value="<?php echo$row[5]; ?>"><br/>
                                <?php echo "<h5>" .$cityErr. "</h5>";  ?>

                            </div>
                            <div class="form-group">                
                               <label>Username</label>
                               <input type="text"  name="username" class="form-control" id="username"value="<?php echo$row[6]; ?>"><br/>

                            </div>
                            <div class="form-group">                
                               <br/><label>Phone</label><br/>
                               <input type="tel" class="form-control" name="phone"  id="phone" value="<?php echo$row[8]; ?>"><br/>
                                <?php echo "<h5>" .$mobilenoErr. "</h5>";  ?>

                            </div>
                            <div class="form-group">                
                               <br/><label>Email</label><br/>
                               <input type="email"  name="email"  id="email" class="form-control" value="<?php echo$row[9]; ?>"> <br/>
                                 <?php echo "<h5>" .$emailErr. "</h5>";  ?>
                            </div>


                            <div class="form-group">
                                <input type="submit"  id="registerbtn" name="submit" value="Update" class="btn btn-success mt-3">
                            </div>

                        </form>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>