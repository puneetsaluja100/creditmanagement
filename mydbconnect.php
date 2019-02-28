<?php
//my server is localhost , user: root, password:root and database : creditmanagement
 $con=mysqli_connect('localhost','root','','creditmanagement');
//check for errors
if($con!=NULL)
  echo "";
else
    echo "Try again";
 ?>
