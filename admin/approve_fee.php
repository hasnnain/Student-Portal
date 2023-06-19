<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"UPDATE fee SET status = '1' WHERE id = '".$_GET['app_fee']."'");
header("location:pending_dues.php");  

?>
