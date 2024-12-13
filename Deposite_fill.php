<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pay Deposit Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 3px solid red;
            border-radius: 8px;
            background-color: #fff;
        }
        .inner-container {
            margin-top: 20px;
        }
        h3 {
            text-align: center;
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="email"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        #pay {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #pay:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
	<form  action="pay_process.php" method="post">
    <h3>Pay Deposit</h3>
    <div class="inner-container">
        <?php
        if (isset($_GET['value'])) {
            $value = $_GET['value'];
        } else {
            echo "<p>No value of Member id received</p>";
        }
        include "dbconnection.php";
        $sq ="SELECT deposite_amount FROM deposite_table where id='1'";
        $resu= $conn->query($sq);
        if ($resu->num_rows > 0) {
            $r = $resu->fetch_assoc();
            $dep = $r['deposite_amount'];
        }
        ?>
        <p>Member id: <?php echo $value; ?></p>
        <label for="Hostel_No">Hostel No.</label>
        <input type="text" id="Hostel_No" name="Hostel_No">
        <label for="mobile_No">Mobile No.</label>
        <input type="text" id="mobile_No" name="mobile_No">
        <label for="deposite">Deposit Amount</label>
        <input type="number" id="deposite" name="deposite" value="<?php echo $dep; ?>" readonly>
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <input type="hidden" id="Memberid" name="Memberid" value="<?php echo $value ?>">
        <button id="pay" name="pay">PAY NOW</button>
    </div>
    </form>
</div>

</body>
</html>
