<?php
            include 'dbconnection.php';
            $month = $_GET['month_name'];
            $sql = "SELECT * FROM dem_month WHERE month_name='$month'";
            $result = $conn->query($sql);
            $i = 1;
            echo "$month";
            echo "<table>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Member ID</th>
                        <th>Payment Date</th>
                        <th>Transaction ID</th>
                    </tr>";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$i."</td>
                            <td><a href='stuent_detail_byMess.php?member_id=".$row['member_id']."'>".$row['member_id']."</a></td>
                            <td>".$row['transaction_date']."</td>
                            <td>".$row['transaction_id']."</td>
                        </tr>";
                    $i++;
                }
            }
            echo "</table>";
        ?>