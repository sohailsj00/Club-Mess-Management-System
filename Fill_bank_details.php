<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bank Details Form</title>
    <style>
        /* Style for form container */
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        /* Style for form inputs */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Style for form button */
        #btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <form method="post">
        Bank Name: <input type="text" id="bname" name="bname"><br>
        Account Number: <input type="text" id="acc_no" name="acc_no"><br>
        Account Holder Name: <input type="text" id="acc_hol_nm" name="acc_hol_nm"><br>
        IFSC Code: <input type="text" id="ifsc" name="ifsc"><br>
        Branch: <input type="text" id="branch" name="branch"><br>
        Adharcard No: <input type="text" id="adhar" name="adhar" maxlength="12" minlength="12"><br>
        <button id="btn" name="btn">SAVE</button><br>
    </form>

<?php
		if (isset($_GET['value'])) {
			$memberid=$_GET['value'];
			
		}
			if(isset($_POST['btn']))
			{
				
					$banknm=$_POST['bname'];
					$acc_no=$_POST['acc_no'];
					$acc_hol_nm=$_POST['acc_hol_nm'];
					$ifsc=$_POST['ifsc'];
					$branch=$_POST['branch'];
					$adhar=$_POST['adhar'];


				include "dbconnection.php";

				 $sql1 = "SELECT * FROM bank_detail where account_no='$acc_no' or adhar_no='$adhar'";
                $result1 = $conn->query($sql1);

                if ($result1->num_rows > 0 ) {

                	  echo "<script> alert('Bank Account or Adhar Car No Allready Exist Please check Account No !');</script>";
                 }

else
{
				$sql="INSERT INTO bank_detail (member_id,bank_name,account_no,acc_holder_nm,ifsc_code,branch,adhar_no) VALUES('$memberid','$banknm','$acc_no','$acc_hol_nm','$ifsc','$branch','$adhar')";
				$result=$conn -> query($sql);
				if ($result==true)
				 {
						  echo "<script> alert('Bank Details saved successfully !');
						  		window.location.href='http://localhost/projectII/Final_Year_Project/student_profile.php'; </script>";	
						
   				}
			}
		}
	

?>

</body>
</html>