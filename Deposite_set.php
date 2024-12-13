<?php
        include "dbconnection.php";
        if (isset($_POST['set']))
        {
            $deposite=$_POST['deposite'];
            echo "$deposite";
            $id=1;
             $sq ="SELECT deposite_amount FROM deposite_table where id='1'";
                    $resu= $conn -> query($sq);
                if ($resu -> num_rows >0) 
                    {
                         echo"<script>alert('Allready set deposite'); window.location.href='http://localhost/projectII/Final_Year_Project/Mess_Member_View.php';</script>";
                    }
                else
                    {
                     $sql="INSERT INTO deposite_table(id,deposite_amount) VALUES('$id','$deposite')";
                    $result= $conn -> query($sql);
                    if($result==true)
                    {
                        echo "<script>alert('Deposite Set Successfully'); window.location.href='http://localhost/projectII/Final_Year_Project/Mess_Member_View.php';</script>";
                    }
        }
    }

        if (isset($_POST['update']))
        {
            $deposite=$_POST['deposite'];
            $id=1;
            $sql1="UPDATE deposite_table SET deposite_amount='$deposite' where id='$id'";
            $result1= $conn -> query($sql1);
            if($result1==true)
            {
                echo "<script>alert('Deposite Updated Successfully'); window.location.href='http://localhost/projectII/Final_Year_Project/Mess_Member_View.php';</script>";
            }
        }
?>

