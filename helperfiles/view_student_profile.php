<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

//php code to view profile starts here.
$customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'studentloan';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
$sql = "SELECT * FROM customers where id=".$customer_id;
$customers = mysqli_query($conn, $sql);

$sql1 = "SELECT * FROM payments where studentid=".$customer_id;
$payments = mysqli_query($conn, $sql1);


//php code to view profile ends here.


require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Student's Profile</h2>
        </div>
        
</div>
    <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">      
      <div class="form-group">
       <?php foreach ($customers as $customer) : ?>
      <?php 
          $url = '.\\uploads\photo\\'.$customer['photo'];
          $url1 = '.\\uploads\passport\\'.$customer['passportnews'];
          $url2 = '.\\uploads\passport\\'.$customer['passportolds'];
          $url3 = '.\\uploads\pan\\'.$customer['pannos'];
          $url4 = '.\\uploads\aadhar\\'.$customer['aadharnos'];
          $url5 = '.\\uploads\other0\\'.$customer['other0'];
          $url6 = '.\\uploads\other1\\'.$customer['other1'];
          $url7 = '.\\uploads\other2\\'.$customer['other2'];
          $url8 = '.\\uploads\other3\\'.$customer['other3'];
          $url9 = '.\\uploads\other4\\'.$customer['other4']; 
      ?>    
      <table>
    <tr>
        <td width="20%" style="padding-right: 10px">
        <img src='<?php echo $url; ?>' height=150 width=150/>        
        <td width="20%" style="padding-right: 10px"></td>
        <td width="20%" style="padding-right: 10px"></td>
        <td width="20%" style="padding-right: 10px"></td>
        <td width="20%" style="padding-right: 10px"></td>
        </tr>
    </table>
    
        
    </div>

    <div class="form-group">
        <label>Gender: </label>
        <label style="font-weight: normal;"><?php echo $customer['gender']; ?></label>
        
    </div>

    <div class="form-group">
    <table>
        <tr>
        <td style="padding-right: 10px"><label for="f_name">First Name: </label>
          <label style="font-weight: normal;"><?php echo $customer['f_name']; ?></label></td>
        <td style="padding-right: 10px"><label for="m_name">Middle Name: </label>
        <label style="font-weight: normal;"><?php echo $customer['m_name']; ?></label></td>
        <td style="padding-right: 10px"><label for="l_name">Last name: </label>
        <label style="font-weight: normal;"><?php echo $customer['l_name']; ?></label></td>
        </tr>
    </table>        
    </div> 
    
    <div class="form-group">
    <table>
        <tr>
            <td style="padding-right: 10px"><label for="address">Address: </label>
          <label style="font-weight: normal;"><?php echo $customer['address']; ?></label></td>
            <td style="padding-right: 10px"><label for="city">City: </label>
        <label style="font-weight: normal;"><?php echo $customer['city']; ?></label></td>
            <td style="padding-right: 10px"><label>State: </label>
            <label style="font-weight: normal;"><?php echo $customer['state']; ?></label></td>
            <td style="padding-right: 10px"><label for="pincode">Pincode: </label>
        <label style="font-weight: normal;"><?php echo $customer['pincode']; ?></label></td>
        </tr>
    </table>        
    </div> 
    
    <div class="form-group">
    <table>
        <tr>
            <td style="padding-right: 10px"><label for="email">Email: </label>
            <label style="font-weight: normal;"><?php echo $customer['email']; ?></label></td>
            <td style="padding-right: 10px"><label for="phone">Phone: </label>
            <label style="font-weight: normal;"><?php echo $customer['phone']; ?></label></td>
            <td style="padding-right: 10px"><label>Date of birth: </label>
        <label style="font-weight: normal;"><?php echo date("d-m-Y", strtotime($customer['date_of_birth'])); ?></label></td>
        </tr>
    </table>        
    </div>

    <div class="form-group">
    <table>
    <tr>
        <td style="padding-right: 10px"><label for="parentsname">Parents Name: </label>
          <label style="font-weight: normal;"><?php echo $customer['parentsname']; ?></label></td>
        <td style="padding-right: 10px"><label for="parentsphone">Phone: </label>
            <label style="font-weight: normal;"><?php echo $customer['parentsphone']; ?></label></td>
        <td><label for="parentsemail">Email: </label>
            <label style="font-weight: normal;"><?php echo $customer['parentsemail']; ?></label></td>
        </tr>
    </table>        
    </div>
    <br/>
<hr>    
    <div class="form-group">
        <label for="none0"><p style="color:green;font-size:20px;">Required Documents</p></label>
    </div> 
    
    <div class="form-group">
    <table>
    <tr>
        <td style="padding-right: 10px"><label for="passportno">Passport Number: </label>
        <label style="font-weight: normal;"><?php echo $customer['passportno']; ?></label></td>
        <td style="padding-right: 10px"><label for="ppexpirydate">Passport Expiry Date: </label>
        <label style="font-weight: normal;"><?php echo date("d-m-Y", strtotime($customer['ppexpirydate'])); ?></label></td>
        <td style="padding-right: 10px"><label for="passportnews">New Passport Copy: </label>   
        <label style="font-weight: normal;"><a href='<?php echo $url1; ?>' target='_blank'>View</a></label></td>
        <td style="padding-right: 10px"><label for="passportolds">Old Passport Copy: </label>  
        <label style="font-weight: normal;"><a href='<?php echo $url2; ?>' target='_blank'>View</a></label></td>
        </tr>
    </table>        
    </div>

    <div class="form-group">
    <table>
    <tr>
        <td style="padding-right: 10px"><label for="panno">PAN Number: </label>
        <label style="font-weight: normal;"><?php echo $customer['panno']; ?></label></td>
        <td style="padding-right: 10px"> <label for="pannos">PAN Card Copy: </label>  
        <label style="font-weight: normal;"><a href='<?php echo $url3; ?>' target='_blank'>View</a></label></td>        
    </table>
    </div>

    <div class="form-group">
    <table>
    <tr>
        <td style="padding-right: 10px"><label for="aadharno">Aadhar Number: </label>
        <label style="font-weight: normal;"><?php echo $customer['aadharno']; ?></label></td>
        <td style="padding-right: 10px"><label for="aadharnos">Aadhar Card Copy: </label>
        <label style="font-weight: normal;"><a href='<?php echo $url4; ?>' target='_blank'>View</a></label></td>       
        </tr>
    </table>
    </div>

    <div class="form-group">
        <table>
    <tr>
        <td><label for="Other0">Other Documents: </label>
        <label style="font-weight: normal;"><a href='<?php echo $url5; ?>' target='_blank'>View Doc 1</a></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight: normal;"><a href='<?php echo $url6; ?>' target='_blank'>View Doc 2</a></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight: normal;"><a href='<?php echo $url7; ?>' target='_blank'>View Doc 3</a></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight: normal;"><a href='<?php echo $url8; ?>' target='_blank'>View Doc 4</a></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight: normal;"><a href='<?php echo $url9; ?>' target='_blank'>View Doc 5</a></label></td>      
        </tr>
    </table>
    </div> 
<br/>
<hr>
     <div class="form-group">
        <label for="none1"><p style="color:green;font-size:20px;">Loan Details</p></label>
    </div> 
    

    <div class="form-group">
    <table>
    <tr>
        <td style="padding-right: 10px"><label for="amount">Amount: </label>
          <label style="font-weight: normal;">₹<?php echo $customer['amount']; ?></label></td>
        <td style="padding-right: 10px"><label for="roi">Rate of Intrest (%): </label>
        <label style="font-weight: normal;"><?php echo $customer['roi']; ?></label></td>
        <td style="padding-right: 10px"><label for="duedate">Bank Deposit Date: </label>
          <label style="font-weight: normal;"><?php echo date("d-m-Y", strtotime($customer['tobedepositdate'])); ?></label></td>
        <td style="padding-right: 10px"><label for="days">Days: </label>
        <label style="font-weight: normal;"><?php echo $customer['days']; ?></label></td>
        <td> <label for="intrest">Intrest: </label>
        <label style="font-weight: normal;">₹<?php echo $customer['intrest']; ?></label></td>
        </tr>
    </table>        
    </div>    

    <div class="form-group">
    <table>
    <tr>
        <td style="padding-right: 10px"><label for="advancepaid">Bank Name: </label>
            <label style="font-weight: normal;"><?php echo $customer['acbankname']; ?></label></td>
        <td style="padding-right: 10px"> <label for="balance">A/C #: </label>
            <label style="font-weight: normal;"><?php echo $customer['acbankacno']; ?></label></td>
        <td style="padding-right: 10px"><label>Total Amount In Bank: </label>
        <label style="font-weight: normal;"><?php echo $customer['totalinbank']; ?></label></td>
        <td style="padding-right: 10px"><label>Pending Interest: </label>
        <label style="font-weight: normal;"><?php echo $customer['intpending']; ?></label></td>
        
        
        </tr>
    </table>   
    </div>

    <div class="form-group">
    <table>
    <tr>
        <td style="padding-right: 10px"><label>Bank Withdraw Date: </label>
        <label style="font-weight: normal;"><?php echo date("d-m-Y", strtotime($customer['bankwithdrawdate'])); ?></label></td>
        <td style="padding-right: 10px"><label>Withdrawal Amount: </label>
           <label style="font-weight: normal;">₹<?php echo $customer['wdramount']; ?></label></td>
        <td style="padding-right: 10px"><label for="bankname">Cheque#: </label>
            <label style="font-weight: normal;"><?php echo $customer['wdrchqno']; ?></label></td>
        <td style="padding-right: 10px"><label for="chequeno">Date: </label>
            <label style="font-weight: normal;"><?php echo $customer['wdrdate']; ?></label></td>
        <td style="padding-right: 10px"></td>
        </tr>   
    </table>
    <?php endforeach; ?>
    </div>

    <div class="form-group">
        <label for="none1"><p style="color:green;font-size:20px;">Payment Details</p></label>
    </div> 
    
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
    
    <div class="form-group text-center">
        <label></label>        
    </div>

    </form>
</div>



<?php include_once 'includes/footer.php'; ?>