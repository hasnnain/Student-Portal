<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM faculty WHERE id = '".$_GET['delete_faculty']."'");
header("location:faculty.php");  

?>
