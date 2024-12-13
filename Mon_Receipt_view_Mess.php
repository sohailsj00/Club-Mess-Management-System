<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Successful Deposit</title>
   
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="print.css" media="print">
</head>
<body>
    <div>
        
    </div>
    <div>
    <form method="post">
        
        <?php
            include 'dbconnection.php';

        if(isset($_GET['value']) && isset($_GET['month']))
        {
            $memberid=$_GET['value'];
            $month = $_GET['month'];
             $sql1 = "SELECT name FROM registration where member_id='$memberid'";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                $row1 = $result1->fetch_assoc();
                $name = $row1['name'];
            }


            $sql = "SELECT * FROM dem_month where member_id='$memberid' and month_name='$month'";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
        ?>
           <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h3 class="text-center">Thank You...! Deposit Filled Successfully</h3>
                        <br>
                        <table class="table table-bordered print">
                            <?php           
                                echo "<tr><td>Receipt No</td><td>".$row['id']."</td></tr>";
                                echo "<tr><td>Member Id</td><td>".$row['member_id']."</td></tr>";
                                echo "<tr><td>Name</td><td>".$name."</td></tr>";
                                echo "<tr><td>Payment for Month</td><td>".$month."</td></tr>";
                                echo "<tr><td>Amount</td><td>".$row['amount']."</td></tr>";
                                echo "<tr><td>Extra charged for Late</td><td>".$row['extra_charged']."</td></tr>"; 
                                echo "<tr><td>Payment Date</td><td>".$row['transaction_date']."</td></tr>";
                                echo "<tr><td>Transaction Id</td><td>".$row['transaction_id']."</td></tr>";
                            ?>
                        </table>       
                        <div class="text-center">
                            <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
                        </div>        
                    </div>
                </div>
            </div>
        <?php
            }
        }
        ?>
    </form>
</div>
</body>
</html>
