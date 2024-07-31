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

  <form action="hector.php" method="post">
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
      <label for="name">PIVOT</label>
      <input type="number" name="pivot" placeholder="Pivot" required>
    </div>

    <div class="form-group fullname">
      <label for="name">SEMISOLID</label>
      <input type="number" name="semi" placeholder="insert semisolid value" required>
    </div>

    <div class="form-group fullname">
      <label for="name">OTHER IRRIGATION</label>
      <input type="number" name="other" placeholder="place your value" required>
    </div>

     <div class="form-group fullname">
      <label for="name">TOTAL IRRIGATED HECTORS</label>
      <input type="number" name="results"  required>
    </div>

    <div class="form-group textarea">
      <label for="name">Comment</label>
    <textarea name="comment" rows="100" cols="40"placeholder="comment here" required></textarea>
    </div>

    <div class="form-group submit-btn">
      <input type="submit" name="button" value="Submit">
    </div>
   
  </form>

   <?php
 if (isset($_POST["button"])){
 $section=$_POST["section"]; 
$pivot=$_POST["pivot"];
$semisolid=$_POST["semi"];
$other=$_POST["other"];
$total=$_POST["results"];
$comment=$_POST["comment"];
$d=date("Y-m-d");

$con=mysqli_connect("localhost","root","","irri");
$sql="INSERT into graph VALUES('$id','$section','$pivot','$semisolid','$other','$total','$comment','$d')";

$query=mysqli_query($con,$sql);

if($query){
echo" <div class='popup popup--icon -success js_success-popup popup--visible'>
          <div class='popup__background'></div>
          <div class='popup__content'>
            <h3 class='popup__content__title'>
              Success
            </h1>
            <p> HECTOR ADDED SUCESSFULLY </p>
            <p>
            <a href='hector2.php'><button class='button button--success' data-for='success'>Return to Home Page</button></a>
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
    <p> FAILED</p>
    <p>
    <a href='hector.php'><button class='button button--error' data-for='js_error-popup'>Close</button></a>
    </p>
  </div>
</div>";
}

}
?>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <div class="footer" style="margin-top: 70px;">
    <ul>
      <center>Copyright &copy; 2023 IRRI-SHED. All Rights Reserved</center>
    </ul>
  </div>
</body>
</html>