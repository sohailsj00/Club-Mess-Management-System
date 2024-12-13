<?php
    $servernm="localhost";
    $usernm="root";
    $password="";
    $dbnm="mess project";
    $conn= new mysqli($servernm,$usernm,$password,$dbnm);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);

    }
    else
    {
       //echo"Connection done sucessfully";
    }
?>