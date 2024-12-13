<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm No Dues</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
        }
        table td {
            padding: 10px;
        }
        select, input[type="date"], input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div>
        <form action="Final_Confirm_Noduse.php" method="post">
            <h2>Confirm No Dues</h2>
            <table>
                <?php
                if(isset($_GET['value'])) {
                    $memberid = $_GET['value'];
                    if($memberid == "") {
                        echo "<script> alert('Check memberid '); window.location.href='http://localhost/projectII/Final_Year_Project/No_Duse.php';</script>";
                    } else {
                        include 'dbconnection.php';
                        $sql = "SELECT member_id FROM no_dues WHERE member_id='$memberid'";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0) {
                            echo "<script> alert('No Dues Already Done'); window.location.href='http://localhost/projectII/Final_Year_Project/No_Duse.php';</script>";
                        } ?>
                        <input type="hidden" name="memberid" id="memberid" value="<?php echo $memberid; ?>">
                        <tr>
                            <td>Member Id</td>
                            <td><?php echo $memberid; ?></td>
                        </tr>
                        <tr>
                            <td>No Dues Date</td>
                            <td><input type="date" id="Noduse_date" name="Noduse_date"></td>
                        </tr>
                        <tr>
                            <td>Last Month Payment Paid or Unpaid</td>
                            <td>
                                <select name="status" id="status">
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="Paid">Paid</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Select Month before No Dues month</td>
                            <td>
                                <select name="mon" id="mon">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Enter Last Month Amount</td>
                            <td><input type="text" id="amt" name="amt"></td>
                        </tr>
                <?php }
                } ?>
            </table>
            <button id="Confirm" name="Confirm">Confirm No Dues</button>
        </form>
    </div>
</div>
</body>
</html>
