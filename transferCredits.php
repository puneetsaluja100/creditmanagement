<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>User Detail</title>
  <link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
</head>
<body>


<?php
//set the connection
include "mydbconnect.php";
$email = $_GET['user_email'];
$query = "SELECT * FROM user WHERE email='$email'";
$user=mysqli_query($con,$query);
$from=$user->fetch_assoc();

$query_users = "SELECT name,email FROM user";
$users=mysqli_query($con,$query_users);



if((isset($_POST["transfer"])))
  {
    //store email and password
    $transferTO_name=$_POST["username"];
    $transfer_amount=$_POST["amount"];//use md5 encryption
    //store query
    $to="SELECT * FROM user WHERE name='$transferTO_name'";

    $res = mysqli_query($con, $to);
    $to = $res->fetch_assoc();
    $current_credit_to = $to['email'];

    #echo "$current_credit_from";

    if($from['current_credit'] < $transfer_amount)
    {
      ?>
        <script type='text/javascript'>
         /*show alert box for invalidity*/
         alert('Can not transfer. Insuffiecient amount.');
         </script>
      <?php
    }
    else {
      $date = date("Y/m/d");

      $credit = "UPDATE user SET current_credit =".($to['current_credit'] + $transfer_amount)." WHERE email='".$to['email']."'";
      $debit = "UPDATE user SET current_credit =".($from['current_credit'] - $transfer_amount)." WHERE email='".$from['email']."'";
      $transaction = "INSERT INTO transfers (transfer_from, transfer_to, transfer_time, amount) VALUES('".$from['name']."', '".$to['name']."', '".$date."',".$transfer_amount.")";

      #echo "$transaction";

      $run = mysqli_query($con, $credit);
      $run = mysqli_query($con, $debit);
      $run = mysqli_query($con, $transaction);

      $query = "SELECT * FROM user WHERE email='$email'";
      $user=mysqli_query($con,$query);
      $from=$user->fetch_assoc();


      #header("Location : transferCredits.php?user_email={$from['email']}");

      #echo "$transaction";
      #echo "$credit";
      #echo "$debit";
    }



  }


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
            <li><a href="./index.php">Home<span class="sr-only">(current)</span></a></li>
            <li> <a class="glyphicon glyphicon-play"></a></li>
            <li><a href="./userDetail.php<?php echo "?user_email=".$from['email']." " ?>">User Details<span class="sr-only">(current)</span></a></li>
            <li> <a class="glyphicon glyphicon-play"></a></li>
            <li class="active"><a href="#">Transfer Credits<span class="sr-only">(current)</span></a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="./userDetail.php<?php echo "?user_email=".$from['email']." " ?>">Welcome <?php echo "{$from['name']}"?></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
  </nav>



<div style="text-align: center;margin:auto;width:50%;height:300px;padding-top:50px;">
<form method=post>
    <table style="text-align:left;" align="center" class="table table-hover table-striped">
      <?php
      echo sprintf("<TR class="."active"."><TD>Current Credit :</TD><TD>%s</TD></TR>",$from['current_credit']);
      ?>
      <tr><td>Transfer Amount</td>
      <td><input type=text name=amount placeholder="Enter Amount" required></input></td></tr>
      <tr><td>Select User</td>
      <td>
      <?php
      echo "<select name='username'";
      while($r=mysqli_fetch_assoc($users))
      {
        //print as table rows and cells
        echo '<option value="'.$r['name'].'">'.$r['name'].'</option>';
      }
      echo "</select";
      ?>
      </td>
    </tr>
    <tr>
      <td align="center" colspan="2">
        <button class='btn btn-primary' type="submit" value="transfer" name="transfer">Transfer Amount</button>
      </td>
    </tr>
    </table>

</form>
</div>
<br>






<table align='center' class="table table-hover table-striped" style="width:80%">
<?php
$transfer_query = "SELECT * FROM transfers WHERE transfer_from = '".$from['name']."' or transfer_to = '".$from['name']."'";
$transfers=mysqli_query($con,$transfer_query);


echo "<TR class="."danger"."><TH>transfer id</TH><TH>transferred to</TH><TH>transferred from</TH><TH>Amount</TH><TH>Time</TH></TR>";
while($r=mysqli_fetch_assoc($transfers))
{
  //print as table rows and cells
  echo sprintf("<TR class="."active"."><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD></TR>",$r['transfer_id'],$r['transfer_to'],$r['transfer_from'],$r['amount'],$r['transfer_time']);
}
?>
</table>
