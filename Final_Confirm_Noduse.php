<?php
	 include 'dbconnection.php' ;
 date_default_timezone_set("Asia/Calcutta");
	 if(isset($_POST['Confirm']))
	 {
	 	$memberid=$_POST['memberid'];
	 	$date=$_POST['Noduse_date'];
	 	$last_month_status=$_POST['status'];

	 	$year = date("Y");
	 	$month_before_noduse=$_POST['mon'].$year;

	 	$amount=$_POST['amt'];

	 	$sq ="SELECT deposite_amount FROM deposite_table where id='1'";
                    $resu= $conn -> query($sq);
                if ($resu -> num_rows >0) 
                    {
                       $row= $resu -> fetch_assoc();
                       $deposite=$row['deposite_amount'];
                     //  echo "Deposite amt = $deposite";

                    }

         if($last_month_status=="Paid")
         {
         	 $deposte_return_amt =$deposite;
         }
         else
         {
         	$deposte_return_amt =$deposite-$amount;
         }
	 }

	 	


	 

	 echo "therefore deposite return amt =  $deposte_return_amt";


	 $sql="INSERT INTO no_dues(member_id,no_dues_date,last_month_payment_status,deposite_return_amt,last_month) VALUES('$memberid','$date','$last_month_status','$deposte_return_amt','$month_before_noduse') ";
	 $result= $conn -> query($sql);
	 if ($result= true) 
	 {
	 		
	 
			 $sql1= "UPDATE registration SET no_dues='yes' WHERE member_id='$memberid'";
			 $result1 = $conn -> query($sql1);
			 if($result1==true)
			 {
			 		echo "<script>alert('NoDuse Confirm for Student with memberid ".$memberid."'); window.location.href='http://localhost/projectII/Final_Year_Project/No_Duse.php';</script>";
			 }
	 }

?>