<?php
include "dbconnection.php";
session_start();
$usernm = null;
$pass = null;

if(isset($_POST['login']))        
{
    $usernm = $_POST['username'];
    $pass = $_POST['password'];

    if (isset($_POST['login_group'])) 
    {
        if($_POST['login_group'] == "Mess Member Login")
        {
            $usernm = $_POST['username'];
            $pass = $_POST['password'];
            $password = null;
            $sql = "SELECT username,password FROM mess_member WHERE username='$usernm' and password='$pass'";
            $result = $conn->query($sql);

            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $password = $row['password'];
                setcookie("admin", $usernm, time() + 3600, "/");
                $_SESSION['usernm'] = $usernm;
                 setcookie("mess_member", $usernm, time() + 3600, "/");

                if ($password == $pass) {
                    header("Location: Mess_Member_View.php");
                    exit();
                }
                else {
                    echo "Incorrect Password";
                }
            }
            else {
                echo "<script> alert('Admin Not Found'); window.location.href='Index.php'; </script>";
            }
        }
        elseif($_POST['login_group'] == "Student Login")
        {
            $password = null;
            $sql = "SELECT member_id, password FROM registration WHERE member_id='$usernm' and password='$pass'";
            $result = $conn->query($sql);

            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $password = $row['password'];
                setcookie("memberid", $usernm, time() + 3600, "/");
                $_SESSION['usernm'] = $usernm;

                if ($password == $pass) {
                     echo "<script> alert('Login Successfully'); window.location.href='student_profile.php'; </script>";
                    exit();
                }
                else {
                    echo "Incorrect Password";
                }
            }
            else {
                echo "<script> alert('No Record Found'); window.location.href='Index.php'; </script>";
            }
        }
    }
    else{
         echo "<script> alert('Check for login as studen or Mess Member'); window.location.href='Index.php'; </script>";
    }

    // Logout functionality
    if(isset($_GET['logout'])) {
        setcookie("memberid", "", time() - 3600, "/"); // Delete the cookie
         setcookie("mess_member", $usernm, time() + 3600, "/");
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        echo "<script> window.location.href='login.php'; </script>"; // Redirect to login page using JavaScript
        exit();
    }
}
?>
