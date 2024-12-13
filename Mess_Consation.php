<?php
include 'dbconnection.php';
date_default_timezone_set("Asia/Calcutta");

// Handling form submission to insert consation data
if(isset($_POST['Consation'])) {
    $memberid = $_POST['memberid'];
    $day = $_POST['day'];
    $reason = $_POST['Reason'];
    $amt = $_POST['amt'];

    $year = date("Y");
    $month = $_POST['month'].$year;

$dt=date('Y-m-d h:i:s');

    // Corrected variable name in the SQL query
    $sql = "INSERT INTO consation_table(member_id, day, reason, amount, month,dt) VALUES('$memberid','$day','$reason','$amt','$month','$dt')";
    $result = $conn->query($sql);

    if($result === TRUE) {
        echo "<script>alert('Consation Applied Successfully'); window.location.href='Mess_Consation.php';</script>";
    } else {
        echo "Error: ".$conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mess Consation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            padding-top: 30px;
            padding-bottom: 20px;
        }
        .container {
            max-width: 1000px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
         hr {
            position: relative;
            top: 20px;
            border: none;
            height: 8px;
            background: black;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Mess Consation</h2>
    <!-- Consation Form -->
    <form action="Mess_Consation.php" method="post">
        <div class="form-group">
            <label for="memberid">Member Id</label>
            <input type="text" class="form-control" id="memberid" name="memberid" required>
        </div>
        <div class="form-group">
            <label for="day">Days</label>
            <input type="text" class="form-control" id="day" name="day" required>
        </div>
        <div class="form-group">
            <label for="Reason">Reason</label>
            <input type="text" class="form-control" id="Reason" name="Reason" required>
        </div>
        <div class="form-group">
            <label for="amt">Consation amount</label>
            <input type="text" class="form-control" id="amt" name="amt" required>
        </div>
        <div class="form-group">
            <label for="month">Month</label>
            <select class="form-control" id="month" name="month">
                <option value='January'>January</option>
                <option value='February'>February</option>
                <option value='March'>March</option>
                <option value='April'>April</option>
                <option value='May'>May</option>
                <option value='June'>June</option>
                <option value='July'>July</option>
                <option value='August'>August</option>
                <option value='September'>September</option>
                <option value='October'>October</option>
                <option value='November'>November</option>
                <option value='December'>December</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="Consation">Apply Consation</button>
    </form>
<hr>
    <!-- Show Consation Table -->
    <form action="Mess_Consation.php" method="post">
        <div class="form-group mt-3">
            <label for="mess">Member Id</label>
            <input type="text" class="form-control" id="mess" name="mess" >
        </div>
        <button type="submit" class="btn btn-info" id="show" name="show">Show</button>
        &nbsp<a href="Export_to_excel.php?file=Mess_Consation1.php">Export to Excel</a>
    </form>
   
    <!-- Consation Table -->
    <?php
    if (isset($_POST['show'])) {
        $memberid = $_POST['mess'];

        if ($memberid != null) 
        {
            $sql1 = "SELECT * FROM consation_table WHERE member_id='$memberid'";
            $result1 = $conn->query($sql1);
        }
        else
        {
            $sql1 = "SELECT * FROM consation_table ORDER BY consation_id DESC LIMIT 20";

            $result1 = $conn->query($sql1);
        }
            if ($result1->num_rows > 0) {
                echo "<table class='table table-striped mt-3'><thead><tr><th>Member Id</th><th>Day</th><th>Reason</th><th>Amount</th><th>Month</th><th>Date</th></tr></thead><tbody>";
                while ($row1 = $result1->fetch_assoc()) {
                    echo "<tr><td>".$row1['member_id']."</td><td>".$row1['day']."</td><td>".$row1['reason']."</td><td>".$row1['amount']."</td><td>".$row1['month']."</td><td>".$row1['dt']."</td></tr>";
                }
                echo "</tbody></table>";
            }
        }

    ?>
</div>
</body>
</html>
