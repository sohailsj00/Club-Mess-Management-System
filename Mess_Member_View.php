<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Mess Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
        }
        th, td {
            text-align: center;
        }
        .editBtn, .saveBtn, .updateBtn{
            margin: 5px;
        }
    </style>
</head>
<body> 
    <div class="container">
    
            <a href="IndexFile_code.php?logout=1" class="btn btn-danger">Logout</a>
        </div>
    <div class="container">
        <h2 class="text-center mt-4 mb-3">Manage Mess Payment</h2>
       

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Extra Charge After Due Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                    // Include database connection file
                    include('dbconnection.php');

                    // Fetch data from database
                    $sql = "SELECT month_name, amount, extra_charge, due_date FROM mess_amount";
                    $result = $conn->query($sql);

                    // Check if any data exists
                    if ($result->num_rows > 0) {
                        // Loop through each row of the result set
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><a href='monthwise_studdetail.php?month_name=".$row['month_name']."'>" . $row['month_name'] . "</a></td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            echo "<td>" . $row['due_date'] . "</td>";
                            echo "<td>" . $row['extra_charge'] . "</td>";
                            echo "<td><button class='editBtn btn btn-primary'>Edit</button><button class='saveBtn btn btn-success'>Save</button><button class='updateBtn btn btn-success'>Update</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No data found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <button id="addRowBtn" class="btn btn-info">Add Row</button>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add row button click event
            $("#addRowBtn").click(function() {
                 $("#myTable").append("<tr><td contenteditable='true'><select class='form-control'><option value='January'>January</option><option value='February'>February</option><option value='March'>March</option><option value='April'>April</option><option value='May'>May</option><option value='June'>June</option><option value='July'>July</option><option value='August'>August</option><option value='September'>September</option><option value='October'>October</option><option value='November'>November</option><option value='December'>December</option></select></td><td contenteditable='true'></td><td contenteditable='true'><input type='date' class='form-control'></td><td contenteditable='true'></td><td><button class='editBtn btn btn-primary'>Edit</button><button class='saveBtn btn btn-success'>Save</button></td></tr>");
});

            // Save button click event
            $("#myTable").on("click", ".saveBtn", function() {
                var currentRow = $(this).closest("tr");
                var month_name = currentRow.find("td:eq(0) select").val();
                var amount = parseFloat(currentRow.find("td:eq(1)").text());
                var due_date = currentRow.find("td:eq(2) input[type=date]").val();
                var extra_charge = parseFloat(currentRow.find("td:eq(3)").text());

                console.log(month_name, amount, due_date, extra_charge);
                // AJAX call to save data
                $.ajax({
                    url: "add_month_pay.php",
                    type: "POST",
                    data: { month_name: month_name, amount: amount, due_date: due_date, extra_charge: extra_charge },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            alert(response.message); // Display success message
                        } else if(response.status == 'error') {
                            alert(response.message); // Display error message
                        }
                    }
                });
            });

            // Edit button click event (optional)
           // Edit button click event
$("#myTable").on("click", ".editBtn", function() {
    var currentRow = $(this).closest("tr");
    currentRow.find("td:eq(0) select").attr("contenteditable", "false");
    //currentRow.find("td:eq(0)").attr("contenteditable", "false");
    currentRow.find("td:eq(1)").attr("contenteditable", "true");
    currentRow.find("td:eq(2)").attr("contenteditable", "true");
    currentRow.find("td:eq(3)").attr("contenteditable", "true");
    currentRow.find(".editBtn").hide();
    currentRow.find(".saveBtn").show();
    currentRow.find(".updateBtn").show(); // Show the Update button
});

// Update button click event
$("#myTable").on("click", ".updateBtn", function() {
    var currentRow = $(this).closest("tr");
    var month_name = currentRow.find("td:eq(0)").text();
    var amount = parseFloat(currentRow.find("td:eq(1)").text());
    var due_date = currentRow.find("td:eq(2)").text();
    var extra_charge = parseFloat(currentRow.find("td:eq(3)").text());

    console.log(month_name, amount, due_date, extra_charge);

    $.ajax({
        url: "update_month.php",
        type: "POST",
        data: { month_name: month_name, amount: amount, due_date: due_date, extra_charge: extra_charge },
        dataType: 'json',
        success: function(response) {
            if (response.status == 'success') {
                alert(response.message); // Display success message
            } else if(response.status == 'error') {
                alert(response.message); // Display error message
            }
        }
    });
});

        });
    </script>

    <br><br>
    <div class="container" >
        <form action="Deposite_set.php" method="post">
          
            Set Deposite For These Year = &nbsp 
            <?php  
            include "dbconnection.php";
                $sq ="SELECT deposite_amount FROM deposite_table where id='1'";
                    $resu= $conn -> query($sq);
                if ($resu -> num_rows >0) 
                    {
                        $r = $resu -> fetch_assoc();
                        echo $r['deposite_amount'];
                    } 
                    else
                    {
                        echo "<button id='set' name='set'> SET </button>";
                    }
            ?> <input type='text' name='deposite' id='deposite'>
            &nbsp <button id="update" name="update">Update</button>
        </form>
    </div><br>

    <div class="container">
        <a href="No_Duse.php" class="btn btn-primary">No Duse</a>
    </div>
   
    <div class="container">
        <a href="Mess_Consation.php" class="btn btn-primary">Mess Bill Consatation</a>
    </div>
</body>
</html>
