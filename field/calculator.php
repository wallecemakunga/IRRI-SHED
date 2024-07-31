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
  <style>
    form{
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
 <script>
  function getstate(val) {
  //alert(val);
  $.ajax({
  type: "POST",
  url: "get_state.php",
  data:'coutrycode='+val,
  success: function(data){
    $("#statelist").html(data);
  }
  });
}

function getcity(val) {
  //alert(val);
  $.ajax({
  type: "POST",
  url: "get_city.php",
  data:'statecode='+val,
  success: function(data){
    $("#city").html(data);
  }
  });
}

</script> 
</head>

<body>
  <?php include('dashboard.php')?>; 

  <form action="" method="post">
    <div class="form-group fullname">
      <label for="name">Irrigation Regime</label>
      <select  name="regime" id="regime" required>
        <option>Please select your Irrigation Regime</option>
        <option value="P">Pivot</option>
        <option value="F">Flood</option>
        <option value="R">Rhino $Jet Gun</option>
        <option value="S">Semisolid</option>
      </select>
    </div>

    <div class="form-group password">
      <label for="name">Irrigation Interval</label>
       <input type="number" name="interval" required>
    </div>
    <div class="form-group speed">
      <label for="name">Speed(Center Pivot)</label>
       <input type="number" name="speed" required>
    </div>

    <div class="form-group submit-btn">
      <input type="submit" name="button" value="Submit">
    </div>
    <br><br>

 <div class="form-group speed">
      <label for="name">Result</label>
       <input type="number" name="speed" required>
    </div>

  </form>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <div class="footer" style="margin-top: 70px;">
    <ul>
      <center>Copyright &copy; 2023 IRRI-SHED. All Rights Reserved</center>
    </ul>
  </div>
</body>
</html>