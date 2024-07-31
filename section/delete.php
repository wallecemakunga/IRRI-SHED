<?php 
 $connection = mysqli_connect('localhost', 'root','', 'irri');
 

$delete_id=$_GET['id'];
        $result = mysqli_query($connection,"DELETE FROM graph WHERE graph_id=$delete_id"); 
        header("Location: load.php");

?>
