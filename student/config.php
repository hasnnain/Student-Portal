<?php

   $con = mysqli_connect("localhost", "root", "", "portal");

   if (mysqli_connect_errno()) {
     echo "Failed to Connect". mysqli_connect_errno();
   }

 ?>
