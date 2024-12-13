
<?php



include "dbconnection.php";

 date_default_timezone_set("Asia/Calcutta");

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // $year = date("Y");
    $month_name = $_POST['month_name'];
    $amount = $_POST['amount'];
    $due_date = $_POST['due_date'];
    $extra_charge = $_POST['extra_charge'];


    // Check if a record already exists for this month in the mess_amount table
    $sql1 = "UPDATE mess_amount SET amount='$amount',extra_charge='$extra_charge',due_date='$due_date' WHERE month_name='$month_name'";
    $result1 = $conn->query($sql1);
        if ($result1 == true)
         {
            $response['status'] = 'success';
            $response['message'] = 'Updated  Successfully';
        }
        
         else
          {
                $response['status'] = 'error';
                $response['message'] = 'Something went to wrong please check values. ';
         }
     }

    

echo json_encode($response);

?>
