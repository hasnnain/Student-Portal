<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM mids WHERE id = '".$_GET['delete_mids']."'");
header("location:mids.php");  

?>
