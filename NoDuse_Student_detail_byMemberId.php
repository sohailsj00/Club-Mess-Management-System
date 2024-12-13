<?php
include "dbconnection.php";


$myquery = "SELECT reg.member_id, reg.name, reg.mob, reg.dept, reg.hostel_admission_date, no.no_dues_date, no.deposite_return_amt FROM registration AS reg INNER JOIN no_dues AS no ON reg.member_id = no.member_id WHERE reg.member_id='$memberid'";
$result = $conn->query($myquery);

 $sql1 = "SELECT * FROM bank_detail where member_id='$memberid'";
                $result1 = $conn->query($sql1);
                   

if ($result == TRUE and $result1 == TRUE ) {
    if ($result -> num_rows > 0 and $result1 -> num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Member ID</th><th>Name</th><th>Mobile</th><th>Department</th><th>Hostel Admission Date</th><th>No Dues Date</th><th>Deposit Return Amount</th>  <th>Bank Name</th><th>Account No</th><th>Account Holder Name </th><th>IFSC Code</th><th>Branch</th></tr></thead>";
         $row1 = $result1->fetch_assoc();
        while ($row = $result->fetch_assoc()) {

            echo "<tr>";
            echo "<td>" . $row['member_id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['mob'] . "</td>";
            echo "<td>" . $row['dept'] . "</td>";
            echo "<td>" . $row['hostel_admission_date'] . "</td>";
            echo "<td>" . $row['no_dues_date'] . "</td>";
            echo "<td>" . $row['deposite_return_amt'] . "</td>";
            echo "<td>" . $row1['bank_name'] . "</td>";
            echo "<td>" . $row1['account_no'] . "</td>";
            echo "<td>" . $row1['acc_holder_nm'] . "</td>";
            echo "<td>" . $row1['ifsc_code'] . "</td>";
            echo "<td>" . $row1['branch'] . "</td>";

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
