<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Only super admin is allowed to access this page
if ($_SESSION['admin_type'] !== 'Administrator') {
    // show permission denied message
    header('HTTP/1.1 401 Unauthorized', true, 401);
    
    exit("401 Unauthorized");
}
/*
$result = $db->selectrptdate();
$result = mysql_query("SELECT * FROM mktnews where security = '$sec' and eventdate    between '$mysqldate' and '$mysqldate1'");
echo '<a href="main.html"><b>BACK</b></a>';
echo "<br>";
echo "<table border='2' BORDERCOLOR=GREEN align='center' >
<tr>
<th>Firm</th>
<th>Name</th>
<th>NIC</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['eventdate'] . "</td>";
  echo "<td>" . $row['news'] . "</td>";
  echo "<td>" . $row['security'] . "</td>";
   echo "</tr>";
  }
echo "</table>";

mysql_close($con);

*/







include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Student Financial Details</h1>
        </div>        
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="reports.php" method="POST">
            <label for="input_search">Search From</label>
            <input type="date" class="form-control" id="fromdate" name="fromdate" value="2018-01-23">
            <label for="input_search">To</label>
            <input type="date" class="form-control" id="todate" name="todate" value="2018-10-24">            
            <input type="submit" value="Generate Report" class="btn btn-primary">

        </form>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Student Documents</h1>
        </div>        
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="reportsdoc.php" method="POST">
            <label for="input_search">Student ID #</label>
            <input type="text" name="studentid" value="" placeholder="Student ID Number" class="form-control" id = "studentid" >            
            <input type="submit" value="Search Documents" class="btn btn-primary">

        </form>
    </div>


    


   
<!--    Pagination links-->
    

</div>
<!--Main container end-->


<?php include_once './includes/footer.php'; ?>

