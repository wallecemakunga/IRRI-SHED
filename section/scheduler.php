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
  <?php include('dashboard4.php')?>; 

  <form action="form.php" method="post">
    <div class="form-group">
      <label for="name">ZONE</label>
      <select onChange="getstate(this.value);"  name="zone" id="country" class="form-control" required >
        <option value="">Select zone</option>
        <?php $query =mysqli_query($con,"SELECT * FROM country ");
        while($row=mysqli_fetch_array($query))
          {
          ?>
          <option value="<?php echo $row['id'];?>"><?php echo $row['countryname'];?></option>
          <?php
        }
        ?>
      </select>
    </div>

    <div class="form-group ">
      <label for="name">AREA</label>
      <select   name="area" id="statelist" onChange="getcity(this.value);" class="form-control" required >
        <option value="">Select Area</option>
      </select>
    </div>

    <div class="form-group">
      <label for="name">SECTION</label>
      <select  name="section" id="city" required>
        <option value="">Select Section</option>
      </select>
    </div>

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

    <div class="form-group submit-btn">
      <input type="submit" name="button" value="Submit">
    </div>
  </form>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <div class="footer" style="margin-top: 70px;">
    <ul>
      <center>Copyright &copy; 2023 IRRI-SHED. All Rights Reserved</center>
    </ul>
  </div>
</body>
</html>