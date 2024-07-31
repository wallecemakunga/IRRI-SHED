<?php
$con  = mysqli_connect("localhost","root","","irri");
 if (!$con) {
     # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         $sql ="SELECT * FROM graph";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $productname[]  = $row['date']  ;
            $sales[] = $row['total_hectors'];
        }
 
 
 }
 
 
?>