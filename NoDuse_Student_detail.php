<?php
include "dbconnection.php";


$myquery = "SELECT reg.member_id, reg.name, reg.mob, reg.dept, reg.hostel_admission_date, no.no_dues_date, no.deposite_return_amt FROM registration AS reg INNER JOIN no_dues AS no ON reg.member_id = no.member_id";
$result = $conn->query($myquery);


if ($result == TRUE) {
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Member ID</th><th>Name</th><th>Mobile</th><th>Department</th><th>Hostel Admission Date</th><th>No Dues Date</th><th>Deposit Return Amount</th></tr></thead>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['member_id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['mob'] . "</td>";
            echo "<td>" . $row['dept'] . "</td>";
            echo "<td>" . $row['hostel_admission_date'] . "</td>";
            echo "<td>" . $row['no_dues_date'] . "</td>";
            echo "<td>" . $row['deposite_return_amt'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }
} else {
    echo "Error: " . $conn->error;
}
?>
