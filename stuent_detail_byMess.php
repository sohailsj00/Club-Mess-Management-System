<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index File</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        #container {
            border: 3px solid red;
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
        }
        h3 {
            margin-top: 0;
            color: red;
        }
        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 800px;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: center;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
      
        <div class="card">
            <div class="card-header">
                <h3>Student Profile</h3>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <?php
                    include "dbconnection.php";

                    // Check if $var is set
                    if(isset($_GET['member_id'])) {
                      $var = $_GET['member_id'];;
                    } else {
                        // Handle the case where $var is not set
                        echo "<p>Error: User ID not set.</p>";
                        exit; // Stop execution if $var is not set
                    }

                    $sql = "SELECT * FROM registration where member_id ='$var'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    ?>
                    <input type="hidden" id="memberid" name="memberid" value="<?php echo $var; ?>">
                    <div class="row">
                        <div class="col-md-6">
                           <div class="row">
    <div class="col-md-6">
        <table>
            <tr>
                <td>Member Id:</td>
                <td><?php echo $row['member_id']; ?></td>
            </tr>
            <tr>
                <td><strong>Name:</strong></td>
                <td><?php echo $row['name']; ?></td>
            </tr>
            <tr>
                <td><strong>Address:</strong></td>
                <td><?php echo $row['address']; ?></td>
            </tr>
            <tr>
                <td><strong>Mobile No.:</strong></td>
                <td><?php echo $row['mob']; ?></td>
            </tr>
            <tr>
                <td><strong>Department Name:</strong></td>
                <td><?php echo $row['dept']; ?></td>
            </tr>
            <tr>
                <td><strong>Course Name:</strong></td>
                <td><?php echo $row['course']; ?></td>
            </tr>
            <tr>
                <td><strong>Present Year:</strong></td>
                <td><?php echo $row['class']." Year"; ?></td>
            </tr>
            <tr>
                <td><strong>Admission Date:</strong></td>
                <td><?php echo $row['hostel_admission_date']; ?></td>
            </tr>
            <tr>
                <td><strong>Receipt:</strong></td>
                <td><a href="view_file.php?memberid=<?php echo $row['member_id'] ?>" style="color: #dc3545;">View File</a></td>
            </tr>
        </table>
    </div>
</div>

                        </div>
                    </div>
                    <div class="card-header">
                    <?php
                    }

                    echo "<p><strong>Bank Details</strong></p>";
                    ?>
                </div>
                  <?php
$sql1 = "SELECT * FROM bank_detail where member_id='$var'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    echo "<table>";
    while ($row = $result1->fetch_assoc()) {
        echo "<tr>";
        echo "<td><strong>Bank Name:</strong></td><td>".$row['bank_name']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Account Number:</strong></td><td>".$row['account_no']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Account Holder Name:</strong></td><td>".$row['acc_holder_nm']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>IFSC Code:</strong></td><td>".$row['ifsc_code']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Branch:</strong></td><td>".$row['branch']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Adhar Card No. :</strong></td><td>".$row['adhar_no']."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
?>
<button id="bank_details" name="bank_detail">
    <a href="Fill_bank_details.php?value=<?php echo $var; ?>" style="color: white;">Bank Details</a>
</button>
<?php
}
                echo "<div class='card-header'>";
                     echo "<p><strong>Deposit Details</strong></p> </div>";
                   
                  $sql1 = "SELECT * FROM deposite_detail where member_id='$var'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    echo "<table>";
    while ($row = $result1->fetch_assoc()) {
        echo "<tr>";
        echo "<td><strong>Deposit Amount:</strong></td><td>".$row['deposite_amount']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Deposit Pay Date:</strong></td><td>".$row['deposite_pay_date']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Transaction Id:</strong></td><td>".$row['transaction_id']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Email:</strong></td><td>".$row['email']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>Mobile Number:</strong></td><td>".$row['mob']."</td>";
        echo "</tr>";
        echo "<tr><td><strong>Receipt:</strong></td><td> <a href='Dep_Receipt_view_mess.php?value=".$var."'> View File</td></tr>";
     
    }
    echo "</table>";
}
    else {
                    ?>
                    <button id="deposite" name="deposite">
                        <a href="Deposite_fill.php?value=<?php echo $var; ?>" style="color: white;">Pay Deposit Detail</a>
                    </button>
                    <?php
                    }
                       echo "<div class='card-header'>";
                    echo "<p><strong>Monthly Mess Payment</strong></p></div>";
                    echo "<form action='upload_month_receipt.php' method='post' enctype='multipart/form-data'> ";

                    echo "<table><tr><th>Month Name</th><th>Payment Status</th></tr>";

                    $sql = "SELECT * FROM mess_amount ORDER BY id ASC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $mahina = $row['month_name']; // Example date fetched from the database
                            $AMOUNT=$row['amount'];
                            $Due_Date=$row['due_date'];
                         


                            $date1 = "dateFromDatabase";
                            $date2 = "mahina"; // Corrected misspelling of January

                            // Extract year and month from the second date
                            $year2 = substr($date2, -4);
                            $month2 = substr($date2, 0, -4);

                            // Convert month name to its numeric representation
                            $monthMapping = [
                                'janvary' => 1, 'february' => 2, 'march' => 3, 'april' => 4, 'may' => 5, 'june' => 6,
                                'july' => 7, 'august' => 8, 'september' => 9, 'october' => 10, 'november' => 11, 'december' => 12
                            ];

                            // Ensure the month name is in lowercase for case-insensitive comparison
                            $month2LowerCase = strtolower($month2);

                            // Get the numeric representation of the month or set to 0 if not found
                            $month2Numeric = $monthMapping[$month2LowerCase] ?? 0;

                            // Construct a new date string in the same format as date1
                            $date2Formatted = sprintf("%04d-%02d-01", $year2, $month2Numeric); // Assuming day is not relevant

                            // Compare the dates
                            if ($date1 > $date2Formatted) 
                            {
                                echo "<input type='hidden' id='month' name='month' value='$mahina'>";
                                echo "<input type='hidden' id='memberid' name='memberid' value='$var'>";

                                $sqlquery = "SELECT * FROM dem_month where member_id='$var' and month_name='$mahina'";
                                $resul = $conn->query($sqlquery);
                                if ($resul->num_rows > 0) {
                                    $payment_status = "<img src='image/paid.jpeg' alt='Paid' width='35' height='35'>";
                                } else {
                                    $payment_status = "<img src='image/unpaid.png' alt='Unpaid' width='35' height='35'>";
                                }
                                $memberid = $var;
                                echo "<tr><td><a href='Mon_Receipt_view_Mess.php?value=".$var."&month=".$mahina."'>".$mahina."</a></td><td>".$payment_status."</td></tr>";
                            }
                        }
                   }
                        echo "</table>";
                   

                    ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

