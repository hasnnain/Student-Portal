<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM student WHERE id = '".$_GET['delete_st']."'");
header("location:students.php");  

?>
