<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Month Wise Student Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #fff;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e2e6ea;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Month Wise Student Report</h1>

        
        <?php
            include 'dbconnection.php';
            $month = $_GET['month_name'];
            echo" <a href='Export_to_excel.php?file=monthwise_studdetail_Excel.php&month_name=".$month."'>Export to Excel</a>";
            $sql = "SELECT * FROM dem_month WHERE month_name='$month'";
            $result = $conn->query($sql);
            $i = 1;
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
    </div>
</body>
</html>
