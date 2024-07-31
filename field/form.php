<?php
session_start();
require_once("../config.php");


if(!isset($_SESSION["username"])){
  header("Location:index.php");
  exit();
}


?>

<!DOCTYPE html>
<html>
<head>
<title>ADMIN-FEEDBACK </title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../css/font.css">
<link rel="stylesheet" href="../css/main.css">

  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/popup_style.css">
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

<div class="row">
  <div class="col-lg-12">

<?php
$section=$_POST['section'];
$regime=$_POST['regime'];


$q=mysqli_query($con,"SELECT * FROM farm where section='$section' and regime='$regime' " )or die('Error223');
echo  '
<div class="panel title">
<div class="table-responsive table-responsive-data2">
<table class="table table-striped title1" >

<tr style="color:red">
<td><b>#</b></td>
<td><b>Farm ID</b></td>
<td><b>Farm Name</b><td>
<b>Section</b>
<td><b>Irrigation Regime</b></td>
<td><b>Irrigation Application</b></td>
<td><b>Rainfall</b></td>
<td><b>Age</b></td>
<td><b>Trigger Condition</b></td>
<td><b>Evaporation</b></td>
<td><b>Date</b></td>
<td><b>Action</b></td>
</tr>';
$c=0;
while($row=mysqli_fetch_array($q))
{
$n=$row['farmID'];
$e=$row['Farm_Name'];
$t=$row['section'];
$s=$row['regime'];
$r=$row['Application'];
$rainfall=$row['rainfall'];
$age=$row['age'];
$trigger1=$row['trigger_condition'];
$eva=$row['evaporation'];
$d=date('d M Y',strtotime($row['date']));
//$id = $row['id'];

$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$n.'</td><td>'.$e.'</td><td>'.$t.'</td><td>'.$s.'</td><td>'.$r.'</td><td>'.$rainfall.'</td><td>'.$age.'</td><td>'.$trigger1.'</td><td>'.$eva.'</td><td>'.$d.'</td>
<td><a title="update Farm" href="form2.php?id='.$n.'"><b><i class="bi bi-arrow-up-right-square" style="color:red;" aria-hidden="true"></i</b></a></td></tr>
</tr>
';
}
echo '</table></div></div>';
?>

</div>
</div>
</div>
  


</body>
</html>
