<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Users</title>
  <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
</head>
<body>


<?php
//set the connection
include "mydbconnect.php";
$query = "SELECT name,email FROM user";
$users=mysqli_query($con,$query);
?>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand" href="./index.php">Credit Management Website</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="./index.php">Home<span class="sr-only">(current)</span></a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<table  align='center' class="table table-hover table-striped" style="width:30%">
<?php
echo "<TR class="."danger"."><TH>List Of Users</TH></TR>";
while($r=mysqli_fetch_assoc($users))
{
  //print as table rows and cells
  echo sprintf("<TR class="."active"."><TD><a href=\"userDetail.php?user_email={$r['email']}\">%s</TD></TR>",$r['name']);
}
?>
</table>


</body>
</html>
