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
 
</head>

<body>
  <?php include('dashboard3.php')?>; 

  <form action="evaporation.php" method="post">
   
    <div class="form-group password">
      <label for="name">Evaporation</label>
       <input type="number" name="evaporation"  placeholder="Enter New Evaporation" required>
    </div>
  
    <div class="form-group submit-btn">
      <input type="submit" name="button" value="Submit">
    </div>
    <br><br>
  </form>
  <?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}

require_once("../config.php");

if (isset($_POST["button"])) {
    $eva = $_POST["evaporation"];

    // Select the farms with IDs between 101 and 104
    $select_query = "SELECT * FROM farm WHERE farmID BETWEEN 101 AND 104";
    $select_result = mysqli_query($con, $select_query);

    if ($select_result) {
        while ($row = mysqli_fetch_assoc($select_result)) {
            $trigger1 = $row['trigger_condition'];
            $rainfall = $row['rainfall'];
            $age = $row['age'];
            $application = $row['Application'];

            // Your calculations for trigger, crop factor, etc.
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
$trigger =(($part1)-($eva * $cropfactor));



            // Update the data for each farm in the loop
            $update_query = "UPDATE farm SET evaporation='$eva', Application='$application', rainfall='$rainfall', age='$age', trigger_condition='$trigger' WHERE farmID = " . $row['farmID'];
            $update_result = mysqli_query($con, $update_query);

            if ($update_result) {
                // Success message or any other action upon successful update
                echo "
    <div class='popup popup--icon -success js_success-popup popup--visible'>
      <div class='popup__background'></div>
      <div class='popup__content'>
        <h3 class='popup__content__title'>
          Success
        </h3>
        <p>New evaporation set Successfully</p>
        <p>
          <a href='home.php'><button class='button button--success' data-for='success'>Return to Profile</button></a>
        </p>
      </div>
    </div>";
            } else {
                echo " 
    <div class='popup popup--icon -error js_error-popup popup--visible'>
      <div class='popup__background'></div>
      <div class='popup__content'>
        <h3 class='popup__content__title'>
          Error
        </h3>
        <p>Update Failed</p>
        <p>
          <a href=''><button class='button button--error' data-for='js_error-popup'>Close</button></a>
        </p>
      </div>
    </div>";
            }
        }
    } else {
        echo "Error in selection: " . mysqli_error($con);
    }
}
?>




  <div class="footer" style="margin-top: 70px;">
    <ul>
      <center>Copyright &copy; 2023 IRRI-SHED. All Rights Reserved</center>
    </ul>
  </div>
</body>
</html>