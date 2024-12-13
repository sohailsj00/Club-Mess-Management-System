
<?php



include "dbconnection.php";

 date_default_timezone_set("Asia/Calcutta");

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = date("Y");
    $month_name = $_POST['month_name'] . $year;
    $amount = $_POST['amount'];
    $due_date = $_POST['due_date'];
    $extra_charge = $_POST['extra_charge'];


    // Check if a record already exists for this month in the mess_amount table
    $sql1 = "SELECT * FROM mess_amount WHERE month_name='$month_name'";
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) 
    {
        $response['status'] = 'error';
        $response['message'] = 'Record already exists for this month';
    }
     else 
     {
        // Insert data into mess_amount table
       
        
        $sql = "INSERT INTO mess_amount(month_name, amount, extra_charge, due_date) VALUES ('$month_name', '$amount', '$extra_charge', '$due_date')";
        $result = $conn->query($sql);

        if ($result == true)
         {
            $response['status'] = 'success';
            $response['message'] = 'Insertion Done Successfully';
        }
        
         else
          {
                $response['status'] = 'error';
                $response['message'] = 'Something went to wrong please check values. ';
         }
     }
}
    

echo json_encode($response);

?>
