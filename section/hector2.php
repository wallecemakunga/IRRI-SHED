<?php require_once 'record.php'; ?>
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
<title>Irrigated Hector</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="form.css"/>
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
.sub1 {
    width: 90px;
    color: #f3f3f3;
    background: #148496;
    font-size: 15px;
    height: 35px;
    margin: 20px;
    /* padding: 10px; */
    width: 100px;
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

<!--navigation menu closed-->
<div class="row">
  <div class="col-lg-3 col-md-2 col-sm-2"></div>
<div class="col-lg-4 col-md-8 col-sm-6 panel">


        <div style="width:50%;hieght:40%;text-align:center">
            <h2 class="page-header" >Irrigated hector report </h2>
            <p style="align:center;"><canvas  id="chartjs_bar"></canvas></p>
        </div> 

<div class="form-group submit-btn">
    <a href="load.php">
        <input type="button" name="button" value="Load Report">
    </a>
</div>
 
    </body>
  <script src="../js/jquery.js"></script>
  <script src="../js/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969aa",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</html>