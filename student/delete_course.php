<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM registered WHERE id = '".$_GET['delete_course']."'");
header("location:courses.php");  

?>
