<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location:index.php");
  exit();
}
require_once("../config.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>USER PROFILE</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../css/font.css">
<link rel="stylesheet" href="../css/main.css">
<link href="../css/popup_style.css" rel="stylesheet">
<link rel="icon" type="image/jpg" href="../lg.png">

<style>
  .container{
    width: 100%;
  }
     /*---------------------
  Responsiveness
-----------------------*/
 @media only screen and (min-width: 4000px)  {
  .container{
    width: 75%;
  }
   
   }
   .form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: left;
}

   
</style>



</head>

<body>

<div class="container">

<div class="row header">
    <div class="col-lg-8 col-md-6 col-sm-6">
    <span class="logo">IRRI-SHED</span>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
<a href="home.php" style="border-radius:0%" class="pull-right btn sub1 title3"><i class="bi bi-house"aria-hidden="true"></i>&nbsp;Home</a>&nbsp;
</div>
</div>

<!--navigation menu closed-->
<div class="row">
  <div class="col-lg-3 col-md-2 col-sm-2"></div>
<div class="col-lg-4 col-md-8 col-sm-6 panel">

<?php
$email=@$_GET['id'];


$q=mysqli_query($con,"SELECT * FROM farm WHERE farmID='$email' " )or die('Error157');
$row=mysqli_fetch_array($q);
$cropfactor = 0;
$trigger=0;

if(isset($_POST['update'])){
$application=$_POST["application"];
$rainfall=$_POST["rainfall"];
$age=$_POST["age"];
$trigger1=$row['trigger_condition'];


if ($rainfall<=5) {
  // code...
  $rainfall=0;
}
if ($age<=1) {
  // code...
  $cropfactor=0.2;
}elseif ($age>=1.1 && $age<=2) {
  // code...
  $cropfactor=0.4;
}
elseif ($age>=2.1 && $age<=3) {
  // code...
  $cropfactor=0.6;
}
elseif ($age>=4.1 && $age<=5) {
  // code...
  $cropfactor=0.9;
}
elseif ($age>=5.1) {
  // code...
  $cropfactor=1;
}

$part1=($trigger1 + $application + $rainfall);

if ($part1>90) {
  // code...
  $part1=90;
}
$trigger =(($part1)-(10 * $cropfactor));


$query ="UPDATE farm set Application='$application',rainfall='$rainfall',age='$age',trigger_condition='$trigger' where farmID='$email' ";
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
    
    <a href='Area3.php'><button class='button button--success' data-for='success'>Return to Profile</button></a>
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


<form class="form-horizontal" name="form" action="" onSubmit="return validateForm()" method="POST">
<fieldset>

<p class="text-center"><b>Update Farm Details</b></p>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="name">Farm Name</label>  
  <div class="col-md-8 col-lg-12 ">
  <input id="name" name="name" placeholder="Farm name" class="form-control input-md" type="text" value="<?php echo $row['Farm_Name']; ?> " disabled> 
  </div>
</div>

<div class="form-group">
  <label class="col-md-12 control-label" for="name">Evaporation</label>  
  <div class="col-md-8 col-lg-12 ">
  <input id="name" name="evaporation" placeholder="Farm name" class="form-control input-md" type="text" value="<?php echo $row['evaporation']; ?> " disabled> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label title1" for="email">Irrigation Application</label>
  <div class="col-md-8 col-lg-12">
    <input id="text" name="application" placeholder="Application" class="form-control input-md" type="number" value="<?php echo $row['Application']; ?>">
    
  </div>
</div>
<div class="form-group">
  <label class="col-md-12 control-label " for="email">Rainfall</label>
  <div class="col-md-8 col-lg-12">
    <input id="text" name="rainfall" placeholder="Rainfall" class="form-control input-md" type="number" value="<?php echo $row['rainfall']; ?>">
    
  </div>
</div>




<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label title1" for="email">Age</label>
  <div class="col-md-8 col-lg-12">
    <input id="text" name="age" placeholder="SugarCane Age" class="form-control input-md" type="number" value="<?php echo $row['age']; ?>">
    
  </div>
</div>

<!-- Text input-->


<!-- Button -->
<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-8 col-lg-12"> 
    <input  type="submit" class="sub btn btn-danger" name="update" value="Update"/>
  </div>
</div>

</fieldset>
</form>

</div>
</div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"  type="text/javascript"></script>
 
</body>
</html>
