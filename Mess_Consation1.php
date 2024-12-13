<?php
include 'dbconnection.php';
    $sql1 = "SELECT * FROM consation_table";
    $result1 = $conn->query($sql1);

    // Display table if data is available
    if ($result1->num_rows > 0) {
                echo "<table class='table table-striped mt-3'><thead><tr><th>Member Id</th><th>Day</th><th>Reason</th><th>Amount</th><th>Month</th><th>Date</th></tr></thead><tbody>";
                while ($row1 = $result1->fetch_assoc()) {
                    echo "<tr><td>".$row1['member_id']."</td><td>".$row1['day']."</td><td>".$row1['reason']."</td><td>".$row1['amount']."</td><td>".$row1['month']."</td><td>".$row1['dt']."</td></tr>";
                }
                echo "</tbody></table>";
    } else {
        echo "No data found";
    }

?>