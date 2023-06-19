<?php
//main connection file for both admin & front end

// session_start();
   define('SITEURL','http://localhost/examination/');
$servername = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "portal";  //database

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$db) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}

?>