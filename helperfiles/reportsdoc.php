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
//$db = new db();


//$rptfromdate = date('Y-m-d H:i:s', $_POST['fromdate']);
//$rpttodate = date('Y-m-d H:i:s', $_POST['todate']);

//echo $_POST['fromdate'];
//echo $_POST['todate'];
//echo $rptfromdate;
//echo $rpttodate;

//$result = $db->selectrptdate($_POST['fromdate'],$_POST['todate']);


//$query2="SELECT * FROM customers where created_at between '".$_POST['fromdate']."' and '".$_POST['todate']."'";
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'studentloan';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
//echo 'Connected successfully<br>';
$sql = "SELECT * FROM customers where id=".$_POST['studentid'];
$result = mysqli_query($conn, $sql);

//if (mysqli_num_rows($result) > 0) {
//while($row = mysqli_fetch_assoc($result)) {
 //     echo "Name: " . $row["id"]. "<br>";
//}
//} else {
//   echo "0 results";
//}
//mysqli_close($conn);
//$createdatdate = date('Y-m-d+ H:i:s');
include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Scanned Documents</h1>
        </div>
        <div class="col-lg-6" style="">
          
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <hr>

            <div id="tblfinreport1">
            <table id="tblfinreport" width="100%" style="font-size:13px;" class="table table-striped">
                <colgroup>
                    <col width="5%">
                        <col width="20%">
                            <col width="10%">
                                <col width="10%">
                                    <col width="10%">
                                        <col width="10%">
                                            <col width="12%">
                                                <col width="9%">
                                                    

                </colgroup>
                <thead>
                    <tr class='warning'>
                        <th>ID#</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>New Passport</th>
                        <th>Old Passport</th>
                        <th>PAN Card</th>
                        <th>Aadhar Card</th>
                        <th>Resume</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                <?php 
                $url = '.\\uploads\photo\\'.$row['photo'];
                $url1 = '.\\uploads\passport\\'.$row['passportnews'];
                $url2 = '.\\uploads\passport\\'.$row['passportolds'];
                $url3 = '.\\uploads\pan\\'.$row['pannos'];
                $url4 = '.\\uploads\aadhar\\'.$row['aadharnos'];
                $url5 = '.\\uploads\cv\\'.$row['resumes'];
                ?>
                  <td><?php echo $row['id'] ?></td>
                  <td><?php echo htmlspecialchars($row['f_name']." ".$row['m_name']." ".$row['l_name']); ?></td>
                  <td><a href='<?php echo $url; ?>' target='_blank'>View</a></td>
                  <td><a href='<?php echo $url1; ?>' target='_blank'>View</a></td>
                  <td><a href='<?php echo $url2; ?>' target='_blank'>View</a></td>
                  <td><a href='<?php echo $url3; ?>' target='_blank'>View</a></td>
                  <td><a href='<?php echo $url4; ?>' target='_blank'>View</a></td>
                  <td><a href='<?php echo $url5; ?>' target='_blank'>View</a></td>

                  </tr>
            <?php }
                  } else {
                        echo "No Records Found!";
                          }
            mysqli_close($conn); ?>
                </tbody>
            </table>
            </div>


</div>
<!--Main container end-->
<?php include_once './includes/footer.php'; ?>

