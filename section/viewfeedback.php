
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
<title>REPORT </title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../css/font.css">
<link rel="stylesheet" href="../css/main.css">
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
<a href="section.php" style="border-radius:0%" class="pull-right btn sub1 title3"><i class="bi bi-house"aria-hidden="true"></i>&nbsp;Home</a>&nbsp;
</div>
</div>

<div class="row">
  <div class="col-lg-12">

<?php
$section=$_POST['section'];
$q=mysqli_query($con,"SELECT * FROM graph where section='$section'" )or die('Error223');
echo  '
<div class="panel title">
<div class="table-responsive table-responsive-data2">
<table class="table table-striped title1" >

<tr style="color:red">
<td><b>#</b></td>
<td><b>id</b></td>
<td><b>Section</b>
<td><b>Pivot</b>
<td><b>Semisolid</b>
<td><b>Other Irrigations</b>
<td><b>Total hectors Irrigated</b>
<td><b>comment</b></td>
<td><b>Date</b></td>
<td><b>Action</b></td>
</tr>';
$c=0;
while($row=mysqli_fetch_array($q))
{
$n=$row['graph_id'];
$section=$row['section'];
$e=$row['pivot'];
$s=$row['semi_solid'];
$o=$row['other_irrigation'];
$t=$row['total_hectors'];
$co=$row['comment'];
$d=date('d M Y',strtotime($row['date']));
$id = $row['graph_id'];

$c++;
echo '<tr>
    <td style="color:#99cc32"><b>'.$c.'</b></td>
    <td>'.$n.'</td>
    <td>'.$section.'</td>
    <td>'.$e.'</td>
    <td>'.$s.'</td>
    <td>'.$o.'</td>
    <td>'.$t.'</td>
    <td>'.$co.'</td>
    <td>'.$d.'</td>
    <td>
        <a title="Delete Feedback" href="delete.php?id='.$n.'">
            <b><i class="bi bi-trash" style="color:red; margin-right: 5px;"></i></b>
        </a>
        <a title="update Feedback" href="">
            <b><i class="bi bi-arrow-up-right-square" style="color:red; margin-left: 5px; border-radius: 0%;"></i></b>
        </a>
    </td>
</tr>';


}
echo '</table></div></div>';
?>
</div>
</div>
</div>
  
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/bootstrap.min.js"  type="text/javascript"></script>

</body>
</html>
