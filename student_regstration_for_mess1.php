<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Registration for mess </title>
</head>	
<body>
	<form style="padding-left:100px;line-height: 2" method="post" action="">
		<div style="padding-left:100px;border: 3px solid red; width: 1000px;">
			<div style="padding-left:300px; width: 700px;">
	Name 		<input type="text" id="name" name="name" > <br>
	PRN No 		<input type="text" id="prn" name="prn" placeholder="Enter PRN No. if you have "> <br>
	Email		<input type="text" id="email" name="email" ><br>
	Address 	<input type="text" id="address" name="address"><br>
	Gender 		<input type="radio" name="gender" value="Male">Male 
				<input type="radio" name="gender" value="Female">Female 
	Mobile NO.	<input type="text" id="mobno" name="mobno"><br>
	Department	<select name="dept" id="dept">
							<option value="select">Select</option>
						   	<option value="Computer Science">Department Computer Science</option>
						   	<option value="Physics">Department of Physics</option>
						   	<option value="Mathematics">Departmen of Mathemaics</option>
						   	<option value="Chemistry">Department of Chemistry</option>
				</select><br>

	Course Name <select name="course" id="course">
							<option value="select">Select</option>
						   	<option value="MCA">MCA</option>
						   	<option value="BCA">BCA</option>
						   	<option value="Physics">Physics</option>
						   	<option value="Mathematics">Mathemaics</option>
						   	<option value="Chemistry">Chemistry</option>
				</select><br>
	Present Course Year	<select name="year" id="year">
							<option value="I">I</option>
							<option value="II">II</option>
							<option value="III">III</option>
						</select><br>

	Hostel No.			<select name="hostel_no" id="hostel_no">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select><br>	

	Room No.	<input type="number" id="room" name="room"><br>

	Hostel Admission Date <input type="date" id="admission" name="admission"><br>

	Hostel Admission Receipt <input type=file id="Upload_File" name="Upload_File"/><br>

	Password <input type="password" id="password" name="password"><br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

	<button id="save" name="save">SAVE</button>

</form>
</body>
</html>
<?php
include "dbconnection.php";

date_default_timezone_set("Asia/Calcutta");

if(isset($_POST['save'])) {
    try {
        // Form submission handling
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mob = $_POST['mobno'];
        $address = $_POST['address'];
        $dept = $_POST['dept'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $hostel = $_POST['hostel_no'];
        $room = $_POST['room'];
        $adm_date = $_POST['admission'];
        $pass = $_POST['password'];
        $prn = isset($_POST['prn']) ? $_POST['prn'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

        // Create directory for the current year
        $yearDirectory = date('Y');
        $path = "./$yearDirectory";

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // File upload handling
        if (isset($_FILES['Upload_File'])) {
            $file_name = $_FILES['Upload_File']['name'];
            $file_size = $_FILES['Upload_File']['size'];
            $file_temp = $_FILES['Upload_File']['tmp_name'];
            $file_type = $_FILES['Upload_File']['type'];

            $validExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
            $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Validate file extension and size
            if (!in_array($fileExtension, $validExtensions)) {
                echo "<script>alert('Invalid File Extension')</script>";
            } elseif ($file_size > 1000000) {
                echo "<script>alert('File is too large')</script>";
            } else {
                // Generate unique filename
                $newFilename = uniqid() . '.' . $fileExtension;
                // Move uploaded file to destination folder
                move_uploaded_file($file_temp, "$path/$newFilename");

                // Insert data into database
                $sql = "INSERT INTO registration (name, email, mob, address, dept, course, class, hostel_no, room_no, hostel_admission_date, prn, gender, password, receipt) VALUES ('$name', '$email', '$mob', '$address', '$dept', '$course', '$year', '$hostel', '$room', '$adm_date', '$prn', '$gender', '$pass', '$newFilename')";

                if ($conn->query($sql) === TRUE) {
                    $memberid = "H" . $hostel . "R" . $room . $conn->insert_id;
                    echo "<script>alert('Student Registration Successful! Your User Name / Member Id is $memberid.'); window.location.href='http://localhost/projectII/Final_Year_Project/IndexFile.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    } catch (Exception $e) {
        echo "<script>alert('Check Field Values Or User with this email already exists')</script>";
    }
}
?>
