<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>No Dues</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }

        .container {
            max-width: 1500px;
            margin: auto;
        }

        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .table-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }

        .table-container th {
            background-color: #e9ecef;
        }

        a {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form method="post">
                <div class="form-group">
                    <label for="memberid">Enter Member Id:</label>
                    <input type="text" class="form-control" name="memberid" id="memberid">
                </div>
                <button type="submit" class="btn btn-primary" id="show" name="show">SHOW</button>
            </form>
        </div>
        
        <?php
        if(isset($_POST['show'])) {
            include 'dbconnection.php';
            $memberid = $_POST['memberid'];
            $query = "SELECT member_id FROM registration WHERE member_id='$memberid'";
            $query_result= $conn -> query($query);
            if($query_result->num_rows > 0)
            {
            echo "List of Payment Completed months for Member ID: ".$memberid."<br>";
            
            $sql = "SELECT hostel_admission_date FROM registration WHERE member_id ='$memberid'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $dt = $row['hostel_admission_date'];
                echo "Admission Date (Format: YYYY-dd-mm): ".$dt."<br>";
            }
            
            echo "<br><table>";
            $sql = "SELECT month_name FROM dem_month WHERE member_id='$memberid'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row['month_name']."</td></tr>";
                }
            }
            echo "</table>";
        }
        else
        {
            echo"<script> alert('Member Id Not Exit'); </script>";
        }

            echo "<br><br><a href='confirm_Noduse.php?value=".$memberid."'>Confirm No Dues</a>";
        }
  
        ?>
    </div>

    <div class="container">
        <div class="table-container">
            <form action="No_Duse.php" method="post">
                <p>See list of No Dues students:</p>
                <button type="submit" class="btn btn-primary" id="all" name="all">Show All List</button>
            </form>

           
       <?php
        if (isset($_POST['all'])) {
            echo "<form action='No_Duse.php' method='post'>";
            echo "<input type='text' name='member' id='member'>";
            echo "<button type='submit' id='see' name='see'>Show List with this Member Id</button>";
            echo "</form>";
            include 'NoDuse_Student_detail.php';
        } elseif(isset($_POST['see'])) {
            $memberid=$_POST['member'];
            include 'NoDuse_Student_detail_byMemberID.php';
        }
        ?>
        
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
