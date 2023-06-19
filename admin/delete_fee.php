<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM fee WHERE id = '".$_GET['delete_fee']."'");
header("location:pending_dues.php");  

?>
