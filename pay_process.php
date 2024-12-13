<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Button</title>
   
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center mt-5">
        <div class="col-xl-4 mx-auto">
            <?php
            if(isset($_POST['pay']))
            {
                $memberid=$_POST['Memberid'];
                $hostel_no=$_POST['Hostel_No'];
                $mob=$_POST['mobile_No'];
                $deposite=intval($_POST['deposite']);
                $email=$_POST['email'];
            ?>
            <a href="#" class="btn btn-primary buynow"
               data-memberid="<?php echo $memberid; ?>"
               data-hostelno="<?php echo $hostel_no; ?>"
               data-deposite="<?php echo $deposite; ?>"
               data-email="<?php echo $email; ?>"
               data-mob="<?php echo $mob; ?>">PAY NOW</a>
            <?php } ?>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(".buynow").click(function(e) {
        var memberid = $(this).data('memberid');
        var hostel = $(this).data('hostelno');
        var deposite = $(this).data('deposite');
        var email = $(this).data('email');
        var mob = $(this).data('mob');
        var options = {
            "key": "rzp_test_8iQ4jXqUtGvoHQ",
            "amount": deposite * 100,
            "name": "Shivaji University Mess Deposite",
            "description": memberid,
            "handler": function (response) {
                var paymentid = response.razorpay_payment_id;
                var staus = response.razorpay_status;
                $.ajax({
                    url: "payment_process1.php",
                    type: "POST",
                    data: {
                        member_id: memberid,
                        payment_id: paymentid,
                        hostel_no: hostel,
                        Deposite: deposite,
                        Email: email,
                        mobile: mob,
                        Status: staus
                    },
                    success: function(finalresponse) {
                        alert('Payment Done Successfully');
                        window.location.href = "http://localhost/projectII/Final_Year_Project/Deposite_Sucessfull.php?value=<?php echo $memberid; ?>";
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
