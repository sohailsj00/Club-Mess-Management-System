<?php
	include "dbconnection.php";
session_start();
 date_default_timezone_set("Asia/Calcutta");
$memberid = $_POST['memberid'];
$amt =$_POST['amt']; 
$charge =$_POST['charge'];

$mob=$_POST['mob'];
$status=$_POST['status'];
$paymentid=$_POST['paymentid'];
$month=$_POST['month'];
$dt=date('Y-m-d h:i:s');
	$sql="SELECT * FROM dem_month WHERE member_id='$memberid' and month_name='$month'";
	$result=$conn -> query($sql);
		if ($result -> num_rows >0)
			 {
				echo "memberid is present";
				//header("Location: .php");
			}
			else
			{
				$sql1="INSERT INTO dem_month (member_id,transaction_id,transaction_date,amount,mob,month_name,extra_charged) VALUES('$memberid','$paymentid','$dt','$amt','$mob','$month','$charge')";
				$result1= $conn -> query($sql1);
				if($result1==true)
				{
				 $finalresponse['status'] = 'success';
            $finalresponse['message'] = 'payment done Successfully and saved to server';
       			}	
       			
			}
				
		echo json_encode($response);

?>