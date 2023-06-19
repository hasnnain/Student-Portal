<?php
include("connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM quiz WHERE id = '".$_GET['delete_quiz']."'");
header("location:quiz.php");  

?>
