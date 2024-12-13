<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Successful Deposit</title>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin-top: 20px;
        }
        #back {
            margin-bottom: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 3px solid red;
            border-radius: 8px;
            background-color: #fff;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
        }
        .btn-primary {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="student_profile.php">
            <button id="back" name="back" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back </button>
        </form>
        <h3><b>Thank You...! Deposit Filled Successfully</b></h3>
        <table class="table table-bordered">
            <?php
            include 'dbconnection.php';
            if (isset($_GET['value'])) {
                $value = $_GET['value'];
                $sql1 = "SELECT name FROM registration where member_id='$value'";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    $row1 = $result1->fetch_assoc();
                    $name = $row1['name'];
                }

                $sql = "SELECT * FROM deposite_detail where member_id='$value'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<tr><td>Receipt No</td><td>" . $row['deposite_id'] . "</td></tr>";
                    echo "<tr><td>Member Id</td><td>" . $row['member_id'] . "</td></tr>";
                    echo "<tr><td>Name</td><td>$name</td></tr>";
                    echo "<tr><td>Amount</td><td>" . $row['deposite_amount'] . "</td></tr>";
                    echo "<tr><td>Date</td><td>" . $row['deposite_pay_date'] . "</td></tr>";
                    echo "<tr><td>Transaction Id</td><td>" . $row['transaction_id'] . "</td></tr>";
                }
            }
            ?>
        </table>
        <div class="text-center">
            <button onclick="window.print();" class="btn btn-primary" id="print-btn"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</body>
</html>
