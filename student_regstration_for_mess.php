<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Registration for Mess</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Additional CSS styles if needed */
        body {
            padding-top: 50px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="form-container" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobno">Mobile No.</label>
                        <input type="text" class="form-control" id="mobno" name="mobno">
                    </div>
                    <div class="form-group">
                        <label for="dept">Department</label>
                        <select class="form-control" id="dept" name="dept">
                            <option value="select">Select</option>
                            <option value="Computer Science">Department Computer Science</option>
                            <option value="Physics">Department of Physics</option>
                            <option value="Mathematics">Department of Mathematics</option>
                            <option value="Chemistry">Department of Chemistry</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course">Course Name</label>
                        <select class="form-control" id="course" name="course">
                            <option value="select">Select</option>
                            <option value="MCA">MCA</option>
                            <option value="BCA">BCA</option>
                            <option value="Physics">Physics</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Chemistry">Chemistry</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Present Course Year</label>
                        <select class="form-control" id="year" name="year">
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hostel_no">Hostel No.</label>
                        <select class="form-control" id="hostel_no" name="hostel_no">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room">Room No.</label>
                        <input type="number" class="form-control" id="room" name="room">
                    </div>
                    <div class="form-group">
                        <label for="admission">Hostel Admission Date</label>
                        <input type="date" class="form-control" id="admission" name="admission">
                    </div>
                    <div class="form-group">
                        <label for="Upload_File">Hostel Admission Receipt</label>
                        <input type="file" class="form-control-file" id="Upload_File" name="Upload_File">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" id="save" name="save">Save</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include "dbconnection.php";
try {
	

if(isset($_POST['save']))
{
  
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mob=$_POST['mobno'];
	$address=$_POST['address'];
	$dept=$_POST['dept'];
	$course=$_POST['course'];
	$year=$_POST['year'];
	$hostel=$_POST['hostel_no'];
	$room=$_POST['room'];
	$adm_date=$_POST['admission'];
	
	//$file=$_POST["Upload_File"];
	 $fileContent = file_get_contents($_FILES['Upload_File']['tmp_name']);
    $fileContent = addslashes($fileContent); // Escape special characters

	$pass=$_POST["password"];
	$gender='';
	$id=0;
		$sql1=" SELECT max(id) as max_id FROM registration ";

	$result1 = $conn->query($sql1);

if($result1-> num_rows > 0)
{

	$row=$result1-> fetch_assoc();
	$id=$row['max_id'];
//	echo("Max id is $id <br>");
	$id=$id+1;


}
else
{
	$id=1;

}

	$memberid="H".$hostel."R".$room.$id;
 
	if(isset($_POST['gender']))
	{
		if($_POST['gender']=="Male")
		{
			$gender="Male";
		}
		else
			$gender="Female";
		
	}


 $sql= "INSERT INTO registration (id,member_id, name, email, mob, address, dept, course, class, hostel_no, room_no, hostel_admission_date, hostel_admission_receipt, gender, password) VALUES ('$id','$memberid', '$name', '$email', '$mob', '$address', '$dept', '$course', '$year', '$hostel', '$room', '$adm_date', '$fileContent', '$gender', '$pass')";
 $result=$conn->query($sql);
 if($result==TRUE)
 {
 	echo "<script> alert('Student Registration Successfully ! Your User Name / Member Id is $memberid Note that .');
	window.location.href='http://localhost/projectII/Final_Year_Project/IndexFile.php'; </script>";

 }
 else 
 {
 	 		echo "Error".$sql."<br>".$conn -> error;
	
 }

 	
}

} catch (Exception $e) {
   echo "<script>alert('check Field Values Or User with this email is exist')</script>"	;
}
?>