

<?php  
include "dbconnection.php";
$memberid=$_GET['memberid'];
$sql = "SELECT * FROM registration where member_id ='$memberid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
<p><strong>Receipt :</strong>
    <?php 
    $file = $row['hostel_admission_receipt']; 
   // echo "<img src='data:image/jpeg;base64,".base64_encode($file)."' width='800px' height='1200px'>"; 
   echo " <iframe src='data:application/pdf;base64,".base64_encode($file)."' width='800px' height='500px'></iframe'> ";
    ?>
</p>
<?php
}
?>
