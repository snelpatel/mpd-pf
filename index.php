<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Get DB instance. function is defined in config.php
//$db = getDbInstance();

//Get Dashboard information
//$numCustomers = $db->getValue("customers", "count(*)");
$todaysdate = date('Y-m-d');
$olddate = strtotime('-1 week', strtotime($todaysdate));
$lastweekdate = date('Y-m-d', $olddate);
$olddate1 = strtotime('1 week', strtotime($todaysdate));
$nextweekdate = date('Y-m-d', $olddate1);

$db = new db();
$numTotalAmount = $db->sumamount($lastweekdate, $todaysdate);

$db = new db();
$numTotalIntrest = $db->sumintrest($lastweekdate, $todaysdate);

$db = new db();
$numTotalIntrestrec = $db->sumintrestrec($lastweekdate, $todaysdate);

$db = new db();
//$numTotalIntrestDue = $db->sumintrestdue($lastweekdate, $todaysdate);
$numTotalIntrestDue = $numTotalIntrest - $numTotalIntrestrec;

$db = new db();
$numTotalWithdrwan = $db->sumwithdrawn($lastweekdate, $todaysdate);

//Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');

//Get current page.
$page = filter_input(INPUT_GET, 'page');

//Per page limit for pagination.
$pagelimit = 20;

if (!$page) {
    $page = 1;
}

// If filter types are not selected we show latest created data first
if (!$filter_col) {
    $filter_col = "created_at";
}
if (!$order_by) {
    $order_by = "Desc";
}

//Get DB instance. i.e instance of MYSQLiDB Library
//$db = getDbInstance();
//$select = array('id', 'f_name', 'm_name', 'l_name', 'amount', 'roi', 'duedate', 'days', 'intrest', 'advancepaid', 'balanceduedate', 'balance', 'bankwithdrawdate', 'created_at','updated_at');

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'studentloan';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
//echo 'Connected successfully<br>';
$sql = "SELECT * FROM customers where created_at between '".$lastweekdate."' and '".$todaysdate."'";
$customers = mysqli_query($conn, $sql);

$sql1 = "SELECT * FROM customers where tobedepositdate between '".$todaysdate."' and '".$nextweekdate."'";
$customers1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * FROM customers where bankwithdrawdate between '".$todaysdate."' and '".$todaysdate."'";
$customers2 = mysqli_query($conn, $sql2);

mysqli_close($conn);
//Get result of the query.
//$customers = $db->arraybuilder()->paginate("customers", $page, $select);
//$total_pages = $db->totalPages;



include_once('includes/header.php');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Student Loan Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">                        
                        <div>
                            <div style="font-weight: bold;text-align: center;font-size: 15px;">Total Amount</div>                            
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <div style="font-weight: bold;text-align: center;font-size: 20px;">₹<?php echo $numTotalAmount; ?></div>
                        
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">                        
                        <div>
                            <div style="font-weight: bold;text-align: center;font-size: 15px;">Total Intrest</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <div style="font-weight: bold;text-align: center;font-size: 20px;">₹<?php echo $numTotalIntrest; ?></div>
                        
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
        <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">                        
                        <div>
                            <div style="font-weight: bold;text-align: center;font-size: 15px;">Intrest Received</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <div style="font-weight: bold;text-align: center;font-size: 20px;">₹<?php echo $numTotalIntrestrec; ?></div>
                        
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">                        
                        <div>
                            <div style="font-weight: bold;text-align: center;font-size: 15px;">Intrest Due</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <div style="font-weight: bold;text-align: center;font-size: 20px;">₹<?php echo $numTotalIntrestDue; ?></div>
                        
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">                        
                        <div>
                            <div style="font-weight: bold;text-align: center;font-size: 15px;">Bank Withdrawal</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <div style="font-weight: bold;text-align: center;font-size: 20px;">₹<?php echo $numTotalWithdrwan; ?></div>
                        
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
    
            <h2 class="page-header">Principle Due in Bank </h2>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">ID#</th>
                <th>Name</th>
                <th>Amount</th>
                <th>ROI(%)</th>
                <th>Bank Deposit Date</th>
                <th>Days</th>
                <th>Intrest</th>
                <th>Bank Withdraw Date</th>                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers1 as $row) : ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><a href="view_student_profile.php?customer_id=<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['f_name']." ".$row['m_name']." ".$row['l_name']); ?></a></td>
                    <td><?php echo htmlspecialchars($row['amount']) ?></td>
                    <td><?php echo htmlspecialchars($row['roi']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['tobedepositdate']))) ?> </td>
                    <td><?php echo htmlspecialchars($row['days']) ?> </td>
                    <td><?php echo htmlspecialchars($row['intrest']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['bankwithdrawdate']))) ?> </td>                    
                </tr>
            <?php endforeach; ?>      
        </tbody>
    </table>

    <h2 class="page-header">Withdrawals From Bank </h2>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">ID#</th>
                <th>Name</th>
                <th>Amount</th>
                <th>ROI(%)</th>
                <th>Bank Deposit Date</th>
                <th>Days</th>
                <th>Intrest</th>
                <th>Bank Withdraw Date</th>                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers2 as $row) : ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><a href="view_student_profile.php?customer_id=<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['f_name']." ".$row['m_name']." ".$row['l_name']); ?></a></td>
                    <td><?php echo htmlspecialchars($row['amount']) ?></td>
                    <td><?php echo htmlspecialchars($row['roi']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['tobedepositdate']))) ?> </td>
                    <td><?php echo htmlspecialchars($row['days']) ?> </td>
                    <td><?php echo htmlspecialchars($row['intrest']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['bankwithdrawdate']))) ?> </td>                    
                </tr>
            <?php endforeach; ?>      
        </tbody>
    </table>

    <h2 class="page-header">New Loans in Last Week</h2>

    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">ID#</th>
                <th>Name</th>
                <th>Amount</th>
                <th>ROI(%)</th>
                <th>Bank Deposit Date</th>
                <th>Days</th>
                <th>Intrest</th>
                <th>Bank Withdraw Date</th>                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $row) : ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><a href="view_student_profile.php?customer_id=<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['f_name']." ".$row['m_name']." ".$row['l_name']); ?></a></td>
                    <td><?php echo htmlspecialchars($row['amount']) ?></td>
                    <td><?php echo htmlspecialchars($row['roi']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['tobedepositdate']))) ?> </td>
                    <td><?php echo htmlspecialchars($row['days']) ?> </td>
                    <td><?php echo htmlspecialchars($row['intrest']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['bankwithdrawdate']))) ?> </td>                    
                </tr>
            <?php endforeach; ?>      
        </tbody>
    </table>

    


   
<!--    Pagination links-->
    <div class="text-center">

        
    </div>
    <!--    Pagination links end-->   

            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">

            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include_once('includes/footer.php'); ?>
