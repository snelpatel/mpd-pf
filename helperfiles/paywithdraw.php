<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
include_once 'includes/header.php';
//$student_id = filter_input(INPUT_GET, 'student_id', FILTER_VALIDATE_INT);
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'studentloan';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
//echo 'Connected successfully<br>';
//$student_id = $_POST['studentid'];
$student_id = filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT);
$sql = "SELECT * FROM customers where id=".$student_id;
$customers = mysqli_query($conn, $sql);
mysqli_close($conn);

//fill payment grid
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
$sql = "SELECT * FROM payments where studentid=".$student_id;
$payments = mysqli_query($conn, $sql);
mysqli_close($conn);

if(isset($_POST['btnpayment']))
{
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'studentloan';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
       
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }
    //echo 'Connected successfully<br>';
    $student_id = filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT);
    if (isset($_SESSION["loanusername"])) {
         $collectedby = $_SESSION['loanusername'];
         //echo "Found User: ", $loggenOnUser, "<br />"
     } else {
         $collectedby = "Staff";
     }
    
    $todayamt = $_POST['slamount'];
    $sparticulars = $_POST['slparticulars'];
    $sql = "INSERT INTO payments(studentid, amount, mode, chequeno, paiddate, particulars, collectedby) VALUES(". $student_id . "," . $_POST['slamount'] . ",'" . $_POST['slmode'] . "','" . $_POST['chequeno']. "','" . $_POST['todaydate']. "','" . $_POST['slparticulars']. "','" . $collectedby . "')";
    if (mysqli_query($conn, $sql)) {
        if($sparticulars==2 || $sparticulars==3){
            $db1 = new db();
            $pintbalance = $db1->getcurrentpendingint($student_id);
            $pibalvalue= $pintbalance - $todayamt;
            $db2 = new db();
            $done2 = $db2->minuspendingint($student_id, $pibalvalue);
        }
                
        $_POST = array();
        echo("<script>location.href = '"."/Loan/paywithdraw.php?sid=$student_id';</script>");
    } 
    else {
      echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    //$done = mysqli_query($conn, $sql);
    mysqli_close($conn);
    //check interest received by following code, against total interest
    //$db = new db();
    //$studbalance = $db->checkbalance($student_id);
    //$newbalance = $studbalance - $todayamt;
    //$done1 = $db->updatebalance($student_id, $newbalance);
    //header("Refresh:0");
}
//else if(isset($_POST['btnwithdraw']) && !is_null($_POST['triggered1']))
//{
    //$message = "Inside BTN Withdraw";
    //echo "<script type='text/javascript'>alert('$message');</script>";
    //$balvalue = $_POST['slwithdraw'];

    //echo "<script type='text/javascript'>alert('$balvalue');</script>";
    
    //$db = new db();
    //$done1 = $db->withdrawsaccount($student_id, $balvalue);
    //echo "<script type='text/javascript'>alert('$done1');</script>";
    //$_POST = array();
    //echo("<script>location.href = '"."/Loan/paywithdraw.php?sid=$student_id';</script>");

    //header("Refresh:0");
//}
else if(isset($_POST['btnpassedtobank']) && !is_null($_POST['triggered']))
{
    //$balvalue = $_POST['slwithdraw'];
    //$db = new db();
    //$done1 = $db->withdrawsaccount($student_id, $balvalue);
    //header("Refresh:0");
    //header("Location: addpayment.php");
    //$message = "wrong answer";
    //echo "<script type='text/javascript'>alert('$message');</script>";
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'studentloan';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
       
    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $studentid = $_POST['studentid'];
    $amount = $_POST['amount'];
    $id = $_POST['dataentryid'];
    $sql = "UPDATE payments SET passedtobank=1 WHERE id=".$id;
        if (mysqli_query($conn, $sql)) {
            $db = new db();
            $cbankbalance = $db->getcurrentbankbalance($studentid);
            $balvalue= $cbankbalance + $amount;
            $db = new db();
            $done1 = $db->addbalancetobank($studentid, $balvalue);
            $_POST = array();
            echo("<script>location.href = '"."/Loan/paywithdraw.php?sid=$student_id';</script>");
            //header("Location: paywithdraw.php?sid=".$studentid);
        } 
        else {
          echo "Error: " . $sql . "" . mysqli_error($conn);
        }
        //$done = mysqli_query($conn, $sql);
        mysqli_close($conn);

    }
    else
    {

    }
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div>
            <h1 class="page-header">Student's Bank Details</h1>
        </div>
        <div style="">
        <table><?php foreach ($customers as $row) : ?>
            <tr>
            <td style="padding-right: 10px"><label style="font-weight: bold; font-size: 18px; color: #f44274;"><?php echo $row['acbankname']; ?></label></td>
            <td style="padding-right: 10px"><label style="font-weight: bold; font-size: 18px; color: #f44274;">AC#: <?php echo $row['acbankacno']; ?></label></td> 
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="padding-right: 10px"><label style="font-weight: bold; font-size: 18px; color: #2d4682;">Total in Bank: ₹<?php echo $row['totalinbank']; ?></label></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="padding-right: 10px"><label style="font-weight: bold; font-size: 18px; color: #e0320f;">Interest Pending: ₹<?php echo $row['intpending']; ?></label></td>
            <?php $wdrintpending = $row['intpending']; ?> 
            <td style="padding-left: 260px">
                <div class="text-center">
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalContactForm3">Add/Update Bank Details</a>
                    <br>
                    <div class="modal-body">
                        <div id="result3"></div>
                    </div>
                    </div>
            </td>
            </tr><?php endforeach; ?>
    </table>     
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <hr>
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
                <th>Account Status</th>                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $row) : ?>
                <?php 
                if($row['status'] == 1)
                    $stat="Principle Due";
                else if($row['status'] == 2)
                    $stat="Balance Done and In Process";
                else if($row['status'] == 3)
                    $stat="Withdrawn and Account Closed";
                else
                    $stat="Profile Created";
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><a href="view_student_profile.php?customer_id=<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['f_name']." ".$row['m_name']." ".$row['l_name']); ?></a></td>
                    <td><?php echo htmlspecialchars($row['amount']) ?></td>
                    <?php $amtforbank = $row['amount']; ?>
                    <td><?php echo htmlspecialchars($row['roi']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['tobedepositdate']))) ?> </td>
                    <td><?php echo htmlspecialchars($row['days']) ?> </td>
                    <td><?php echo htmlspecialchars($row['intrest']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['bankwithdrawdate']))) ?> </td>
                    <td><?php echo htmlspecialchars($stat) ?> </td>                    
                </tr>
            <?php endforeach; ?>      
        </tbody>
    </table>
    <form class="form" action="" method="post"  id="paywithdraw_form" enctype="multipart/form-data">
    <div class="form-group">
    <table>
    <hr>    
    <div class="form-group">
        <label for="none0"><p style="color:green;font-size:20px;">Financial Transactions - Initial Bank Deposit / Advance Interest / Interest Received</p></label>
    </div> 

    <tr>
        <td width="20%" style="padding-right: 10px"><label for="slamount">Amount </label>
          <input type="text" name="slamount" value="" placeholder="Amount" class="form-control" id="slamount"></td>
        <td width="20%" style="padding-right: 10px"><label for="mode">Mode of Payment </label>
          <select name="slmode" class="form-control selectpicker">
          <option value="0">Select</option>
          <option value="Cash">Cash</option>
          <option value="Cheque">Cheque</option>
        </select></td>
        <td width="20%" style="padding-right: 10px"><label for="chequeno">Cheque# </label>
        <input type="text" name="chequeno" value="N/A" placeholder="Cheque No." class="form-control" id="chequeno"></td>
          <td width="20%" style="padding-right: 10px"><label for="todaydate">Date </label>
          <input name="todaydate" value=""  placeholder="Today's date" class="form-control"  type="date" id="todaydate"></td>
        <td width="20%" style="padding-right: 10px"><label for="particulars">Particulars </label>
        <select name="slparticulars" class="form-control selectpicker">
          <option value="0">Select</option>
          <option value="1">Initial Bank Deposit</option>
          <option value="2">Advance Interest Paid</option>
          <option value="3">Interest Received</option>
        </select></td>
        <input type="hidden" name="studentid" value="<?php echo $student_id ?>" />

        <td width="20%" style="padding-right: 10px"><br/><button type="submit" name="btnpayment" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
        </td>
    </tr>
    </table>          
    </div>
    <hr>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">ID#</th>
                <th>Amount</th>
                <th>Mode</th>
                <th>Cheque#</th>
                <th>Paid on Date</th>
                <th>Particulars</th>
                <th>Collected By</th>
                <th>Passed to Bank</th>
                <th>Log Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $row) : ?>
                <?php 
                if($row['passedtobank'] == 1)
                    $ptb="Yes";
                else
                    $ptb="No";

                if($row['particulars'] == 1)
                    $part="Initial Bank Deposit";
                else if($row['particulars'] == 2)
                    $part="Advance Interest Paid";
                else if($row['particulars'] == 3)
                    $part="Interest Received";
                else
                    $part="Not Applicable";

                
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo htmlspecialchars($row['amount']) ?></td>
                    <td><?php echo htmlspecialchars($row['mode']) ?></td>
                    <td><?php echo htmlspecialchars($row['chequeno']) ?> </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($row['paiddate']))) ?> </td>
                    <td><?php echo htmlspecialchars($part) ?> </td>
                    <td><?php echo htmlspecialchars($row['collectedby']) ?> </td>
                    <td><?php echo htmlspecialchars($ptb) ?> &nbsp;&nbsp;
                    <?php if ($row['passedtobank'] == 0): ?>
                        <input type="hidden" name="dataentryid" value="<?php echo htmlspecialchars($row['id']) ?>" />
                        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($row['amount']) ?>" />
                        <input type="hidden" name="triggered" value="" />
                        <input type="hidden" name="studentid" value="<?php echo htmlspecialchars(filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT)) ?>" />
                        <button type="submit" name="btnpassedtobank" onclick="setTrig()" class="btn btn-warning" >Passed to Bank <span class="glyphicon glyphicon-chevron-right"></span></button>
                    
                    <?php endif; ?>                                           
                    </td>
                    <td><?php echo htmlspecialchars(date("d-m-Y H:i:s", strtotime($row['logtime']))) ?> </td>  
                                      
                </tr>
            <?php endforeach; ?>      
        </tbody>
    </table>

    <!--   Status Section starts -->
    <div class="form-group">
    <table>
    <hr>    
    <div class="form-group">
        <label for="none0"><p style="color:green;font-size:20px;">Status</p></label>
    </div>

    <!-- Modal Principle Due Section starts -->
    <div class="modal fade" id="modalContactForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title font-weight-bold">Update Account Status - Principle Due</h2>
            </div>
            
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="pduesid">Student ID:</label>
                    <input type="text" id="pduesid" class="form-control" readonly="true" value="<?php echo htmlspecialchars(filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT)) ?>">
                </div>
                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="pduedate">Date:</label>
                    <input type="date" id="pduedate" class="form-control">
                 </div>


            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button id="pduesend" class="btn btn-info">Submit <i class="fa fa-paper-plane-o ml-1"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    
    <!-- Principle Due Section ends -->

    <!-- Modal Balance Done Section starts -->
    <div class="modal fade" id="modalContactForm1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title font-weight-bold">Update Account Status - Balance Done and In Process</h2>
            </div>
            
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="baldonesid">Student ID:</label>
                    <input type="text" id="baldonesid" class="form-control" readonly="true" value="<?php echo htmlspecialchars(filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT)) ?>">
                </div>
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="baldoneamt">Principle Amount:</label>
                    <input type="text" id="baldoneamt" class="form-control" readonly="true" value="<?php echo htmlspecialchars($amtforbank) ?>">
                </div>
                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="baldonedate">Date:</label>
                    <input type="date" id="baldonedate" class="form-control">
                 </div>


            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button id="baldonesend" class="btn btn-info">Submit <i class="fa fa-paper-plane-o ml-1"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    
    <!-- Balance Done Section ends -->

     
    <!-- Modal Withdrawal DIV code starts -->
    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title font-weight-bold">Withdraw and Close Account</h2>
            </div>
            
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="wdrsid">Student ID:</label>
                    <input type="text" id="wdrsid" class="form-control" readonly="true" value="<?php echo htmlspecialchars(filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT)) ?>">
                </div>
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="wdrintpending">Interest Pending:</label>
                    <input type="text" id="wdrintpending" class="form-control" readonly="true" value="<?php echo htmlspecialchars($wdrintpending) ?>">
                </div>
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="wdramount">Amount:</label>
                    <input type="text" id="wdramount" class="form-control">
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="wdrchequeno">Cheque Number:</label>
                    <input type="text" id="wdrchequeno" class="form-control">
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="wdrdate">Date:</label>
                    <input type="date" id="wdrdate" class="form-control">
                 </div>


            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button id="send" class="btn btn-info">Submit <i class="fa fa-paper-plane-o ml-1"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    
    <!--   Withdrawal Section Ends -->

    <!-- Update Bank ac no modal popup Starts Here -->
    <div class="modal fade" id="modalContactForm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title font-weight-bold">Add/Update Bank Details</h2>
            </div>
            
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="banksid">Student ID:</label>
                    <input type="text" id="banksid" class="form-control" readonly="true" value="<?php echo htmlspecialchars(filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT)) ?>">
                </div>
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="bankname">Bank Name:</label>
                    <input type="text" id="bankname" class="form-control">
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-user prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="bankacno">Account Number:</label>
                    <input type="text" id="bankacno" class="form-control">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button id="banksend" class="btn btn-info">Submit <i class="fa fa-paper-plane-o ml-1"></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    
    <!--   Update Bank ac no Section Ends -->

    <tr>
        <td width="33%" style="padding-right: 10px">
            <div class="text-center">
            <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalContactForm2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principle Due&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <br>
            <div class="modal-body">
                <div id="result2"></div>
            </div>
            </div>
        </td>

        <td width="33%" style="padding-right: 10px">
            <div class="text-center">
            <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalContactForm1">Balance Done and In Process</a>
            <br>
            <div class="modal-body">
                <div id="result1"></div>
            </div>
            </div>
        </td>
        <td width="33%" style="padding-right: 10px">
            <div class="text-center">
            <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalContactForm">Withdraw & Close Account</a>
            <br>
            <div class="modal-body">
                <div id="result"></div>
            </div>
            </div>
        </td>
    </tr>
    </table>          
    </div>
    
    </form>
    
</div>
<script type="text/javascript">
     function setTrig()
     {
        document.getElementById('triggered').value = 1; 
     }

     function setTrig1()
     {
        document.getElementById('triggered1').value = 1; 
     }
 </script>


<!--Main container end-->
<?php include_once './includes/footer.php'; ?>

