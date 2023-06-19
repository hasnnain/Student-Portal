<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM assignment WHERE id = '".$_GET['delete_assign']."'");
header("location:assignment.php");  

?>
