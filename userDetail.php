<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>User Detail</title>
  <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">

  <style>
    img {
      border-radius: 50%;
    }
  </style>
</head>
<body>


<?php
//set the connection
include "mydbconnect.php";
$email = $_GET['user_email'];
$query = "SELECT * FROM user WHERE email='$email'";
$user=mysqli_fetch_assoc(mysqli_query($con,$query));
?>
<style>
img {
  border-radius: 50%;
}
</style>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand" href="./index.php">Credit Management Website</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="./index.php">Home<span class="sr-only">(current)</span></a></li>
          <li> <a class="glyphicon glyphicon-play"></a></li>
          <li class="active"><a href="#">User Details<span class="sr-only">(current)</span></a></li>
        </ul>
      <!-- /.navbar-collapse -->

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Welcome <?php echo "{$user['name']}"?></a></li>
      </ul>
      </div>
    </div><!-- /.container-fluid -->
</nav>


<div  style="text-align: center;margin:auto;width:60%;height:200px;padding-top:50px;">
  <div style="width:50%;float:left">
    <img src="img_avatar.png" alt="Avatar" style="width:200px">
  </div>
  <div style="width:50%;float:left;margin-top:40px;">
    <table style='text-align:left;' align='center' class="table table-hover table-striped">
    <?php

      echo sprintf("<TR class="."active"."><TD class="."danger".">Name :</TD><TD>%s</TD></TR>",$user['name']);
      echo sprintf("<TR class="."active"."><TD>Email :</TD><TD class="."danger".">%s</TD></TR>",$user['email']);
      echo sprintf("<TR class="."active"."><TD class="."danger".">Current Credit :</TD><TD>%s</TD></TR>",$user['current_credit']);
    ?>
    </table>
  </div>
</div>


<div style='padding-top:150px;text-align:center;'>
<?php
echo "<button type='button' onclick=\"location.href='transferCredits.php?user_email={$user['email']}'\" class='btn btn-primary'>Transfer Credit to other user's account</button>";
?>
<div>



</body>
</html>
