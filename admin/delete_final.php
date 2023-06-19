<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM final WHERE id = '".$_GET['delete_final']."'");
header("location:final.php");  

?>
