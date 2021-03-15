<?php
require_once './config/config.php';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'studentloan';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}

$studentid = $_POST['studentid'];
$amount =  = $_POST['amount'];
$id = $_POST['dataentryid'];
$sql = "UPDATE payments SET passedtobank=1 WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
    //$_POST = array();
    //echo("<script>location.href = '"."/Loan/paywithdraw.php?sid=$student_id';</script>");
    header("Location: paywithdraw.php?sid=".$studentid);
    } 
    else {
      echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    //$done = mysqli_query($conn, $sql);
    mysqli_close($conn);


header("Location: view.php"); 
?>