


<?php 

include('dbconnection.php');
session_start();
 date_default_timezone_set("Asia/Calcutta");

$paymentid=$_POST['payment_id'];
$memberid=$_POST['member_id'];
$hostel = $_POST['hostel_no'];
$deposite = $_POST['Deposite'];
$email=$_POST['Email'];
$mob=$_POST['mobile'];
$status=$_POST['Status'];

$dt=date('Y-m-d h:i:s');

$sql="INSERT INTO deposite_detail(member_id, deposite_amount, deposite_pay_date, transaction_id, deposite_status,email,mob,hostel_no) 
VALUES ('$memberid','$deposite','$dt','$paymentid','$status','$email','$mob','$hostel')";

$result=$conn -> query($sql);

if($result==true)
{
	echo 'done';
	$_SESSION['paymentid']=$paymentid;
}
else 
{
	echo "Error: " . $sql . "<br>" .  $mysqli -> error;
}




?>