<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monthly Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
        #paynow {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #paynow:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Monthly Payment</h3>
            </div>
        </div>
        <div class="inner-container">
            <?php
            include "dbconnection.php"; 
            date_default_timezone_set("Asia/Calcutta");

            if(isset($_GET['month']) && isset($_GET['memberid'])) {
                $month = $_GET['month'];
                $memberid = $_GET['memberid'];

                $sql="SELECT * FROM dem_month WHERE member_id='$memberid' and month_name='$month'";
                $result=$conn->query($sql);
                if ($result->num_rows > 0) {   
                    echo "<script> alert('You have paid already for this month please download Receipt');</script>";
                    echo "<script> window.location.href='http://localhost/projectII/Final_Year_Project/Month_pay_successfull.php?value=".$memberid."&month=".$month."'</script>";
                } else {    
                    $sql = "SELECT amount, extra_charge, due_date FROM mess_amount WHERE month_name='$month'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $amt = (int)$row['amount'];
                        $charge = (int)$row['extra_charge'];
                        $dt = $row['due_date'];
                    }

                    $sql1="SELECT mob,email FROM registration WHERE member_id='$memberid'";
                    $result1=$conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_assoc()) {
                            $mob = (int) $row1['mob'];
                            $email = $row1['email'];
                        }
                    }


                    $dt1 = date('Y-m-d');
                    $date1 = new DateTime($dt);
                    $date2 = new DateTime($dt1);

                    if($date2 > $date1) {
                        $interval = $date1->diff($date2);
                        $day = (int) $interval->format('%R%a days');
                        $amt = $amt + $day * $charge;
                        $chargeamt = $day * $charge;
                        echo "<script> alert('Due Date is passed out you have to pay extra charge Rs. $chargeamt'); </script>";
                    }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <label for="memberid">Member ID</label>
                    <input type="text" id="memberid" value="<?php echo $memberid; ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="amt">Amount to Pay</label>
                    <input type="text" id="amt" value="<?php echo $amt; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="dueDate">Due Date</label>
                    <input type="text" id="dueDate" value="<?php echo $dt; ?> " readonly>
                </div>
                <div class="col-md-6">
                    <label for="month">Month</label>
                    <input type="text" id="month" value="<?php echo $month; ?> " readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="mobileNumber">Mobile Number</label>
                    <input type="text" id="mobileNumber" value="<?php echo $mob; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="javascript:void(0)" month="<?php echo $month; ?>" memberid="<?php echo $memberid; ?>" amt="<?php echo $amt; ?>" charge="<?php echo $chargeamt; ?>" mob="<?php echo $mob;?>" class="btn btn-primary paynow">Pay Now</a>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(".paynow").click(function() {
            var memberid = $(this).attr('memberid');
            var amt = $(this).attr('amt');
            var charge = $(this).attr('charge');
            var mob=$(this).attr('mob');
            var month=$(this).attr('month');
            var options = {
                "key": "rzp_test_8iQ4jXqUtGvoHQ", // Enter the Key ID generated from the Dashboard
                "amount": amt*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "name": "Shivaji University Mess Deposite",
                "description": "Monthly Payment",
                "handler": function (response){
                    var paymentid=response.razorpay_payment_id;
                    var staus=response.razorpay_status;

                    $.ajax({
                        url:"save_monthly_payment_student.php",
                        type:"POST",
                        data:{memberid:memberid,paymentid:paymentid,amt:amt,mob:mob,status:status,month:month,charge:charge},
                        success:function(finalresponse) {
                            alert('Payment Done Successfully ');
                            window.location.href="http://localhost/projectII/Final_Year_Project/Month_pay_successfull.php?value=<?php echo $memberid;?>&month=<?php echo $month; ?>";                    
                        }
                    })
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
    </script>
</body>
</html>
