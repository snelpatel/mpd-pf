<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';


//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = filter_input_array(INPUT_POST);
    //Insert timestamp
    $data_to_store['created_at'] = date('Y-m-d');
    //$db = getDbInstance();
    //$last_id = $db->insert('customers', $data_to_store);
    //new code start
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentloan";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    //scanned photo upload begins here        
    $name0= $_FILES['photo']['name'];
    $position0= strpos($name0, "."); 
    $fileextension0= substr($name0, $position0 + 1);
    $filename0 = time() . "." . $fileextension0; 
    $target0 = BASE_PATH.'\\uploads\\photo\\';     
    $fileTarget0 = $target0.$filename0;    
    $tempFileName0 = $_FILES["photo"]["tmp_name"];    
    $result0 = move_uploaded_file($tempFileName0,$fileTarget0);      
    if(!$result0)
    { 
      $error = "Could not save photo file as $filename0!";     
      exit(); 
    }
    //scanned photo upload ends here


    //scanned new passport copy upload begins here        
    $name= $_FILES['passportnews']['name'];
    $position= strpos($name, "."); 
    $fileextension= substr($name, $position + 1);
    $filename = time() . "." . $fileextension; 
    $target = BASE_PATH.'\\uploads\\passport\\';     
    $fileTarget = $target.$filename;    
    $tempFileName = $_FILES["passportnews"]["tmp_name"];    
    $result = move_uploaded_file($tempFileName,$fileTarget);      
    if(!$result)
    { 
      $error = "Could not save new passport file as $filename!";     
      exit(); 
    }
    //scanned new passport copy upload ends here

    //scanned old passport copy upload begins here        
    $name1= $_FILES['passportolds']['name'];
    $position1= strpos($name1, "."); 
    $fileextension1= substr($name1, $position1 + 1);
    $filename1 = time() . "." . $fileextension1; 
    $target1 = BASE_PATH.'\\uploads\\passport\\';     
    $fileTarget1 = $target1.$filename1;    
    $tempFileName1 = $_FILES["passportolds"]["tmp_name"];    
    $result1 = move_uploaded_file($tempFileName1,$fileTarget1);      
    if(!$result1)
    { 
      $error = "Could not  save old passport file as $filename1!";     
      exit(); 
    }
    //scanned old passport copy upload ends here
    
    //scanned pancard copy upload begins here        
    $name2= $_FILES['pannos']['name'];
    $position2= strpos($name2, "."); 
    $fileextension2= substr($name2, $position2 + 1);
    $filename2 = time() . "." . $fileextension2; 
    $target2 = BASE_PATH.'\\uploads\\pan\\';     
    $fileTarget2 = $target2.$filename2;    
    $tempFileName2 = $_FILES["pannos"]["tmp_name"];    
    $result2 = move_uploaded_file($tempFileName2,$fileTarget2);      
    if(!$result2)
    { 
      $error = "Could not  save pancard file as $filename2!";     
      exit(); 
    }
    //scanned pancard copy upload ends here

    //scanned aadhar card copy upload begins here        
    $name3= $_FILES['aadharnos']['name'];
    $position3= strpos($name3, "."); 
    $fileextension3= substr($name3, $position3 + 1);
    $filename3 = time() . "." . $fileextension3; 
    $target3 = BASE_PATH.'\\uploads\\aadhar\\';     
    $fileTarget3 = $target3.$filename3;    
    $tempFileName3 = $_FILES["aadharnos"]["tmp_name"];    
    $result3 = move_uploaded_file($tempFileName3,$fileTarget3);      
    if(!$result3)
    { 
      $error = "Could not save aadhar card file as $filename3!";     
      exit(); 
    }
    //scanned aadhar card copy upload ends here

    //scanned CV upload begins here        
    $name4= $_FILES['resumes']['name'];
    $position4= strpos($name4, "."); 
    $fileextension4= substr($name4, $position4 + 1);
    $filename4 = time() . "." . $fileextension4; 
    $target4 = BASE_PATH.'\\uploads\\cv\\';     
    $fileTarget4 = $target4.$filename4;    
    $tempFileName4 = $_FILES["resumes"]["tmp_name"];    
    $result4 = move_uploaded_file($tempFileName4,$fileTarget4);      
    if(!$result4)
    { 
      $error = "Could not save CV or Resume file as $filename4!";     
      exit(); 
    }
    //scanned CV upload ends here

    $createdatdate = date('Y-m-d');
    //main insert script begins here.
    $studphoneno = $_POST['phone'];
    $sql = "INSERT INTO customers(photo, f_name, m_name, l_name, gender, address, city, state, pincode, phone, email, date_of_birth, passportno, passportnews, passportolds, panno, pannos, aadharno, aadharnos, resumes, parentsname, parentsphone, parentsemail, amount, roi, duedate, days, intrest, advancepaid, balanceduedate, balance, bankwithdrawdate, bankdeposit, depositmode, bankname, chequeno, depositamount,created_at)
    VALUES('". $filename0 . "','" . $_POST['f_name'] . "','" . $_POST['m_name'] . "','". $_POST['l_name'] . "','". $_POST['gender'] . "','". $_POST['address'] . "','". $_POST['city'] . "','". $_POST['state'] . "','". $_POST['pincode'] . "','". $_POST['phone'] . "','". $_POST['email'] . "','". $_POST['date_of_birth'] . "','". $_POST['passportno'] . "','" . $filename . "','" . $filename1 . "','". $_POST['panno'] . "','" . $filename2 . "','". $_POST['aadharno']. "','" . $filename3. "','" . $filename4 ."','". $_POST['parentsname'] ."','". $_POST['parentsphone'] ."','". $_POST['parentsemail'] ."',". $_POST['amount'] .",". $_POST['roi'] .",'". $_POST['duedate'] ."',". $_POST['days'] .",". $_POST['intrest'] .",". $_POST['advancepaid'] .",'". $_POST['balanceduedate'] ."',". $_POST['balance'] .",'". $_POST['bankwithdrawdate'] ."','". $_POST['bankdeposit'] ."','". $_POST['depositmode'] ."','". $_POST['bankname'] ."','". $_POST['chequeno'] ."',". $_POST['depositamount'] . ",'". $createdatdate . "')";
    

    if ($conn->query($sql) === TRUE) 
    {
        //echo "New record created successfully";
        $_SESSION['success'] = "Student Details Added Successfully!";

        $student_lastid=mysqli_insert_id($conn);
        //echo $last_id;
        //Send sms to student with ID
        //Your authentication key
		$authKey = "244939AeCHSmoil05bd48b94";

		//Multiple mobiles numbers separated by comma
		$mobileNumber = $studphoneno;

		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "WOTPVL";

		//Your message to send, Add URL encoding here.
		$msgstud = "Your Student ID# is ". $student_lastid .". Do mention your uniuqe ID for any future correspondence with Worldwide Overseas Travel Pvt. Ltd. Thank You.";
		$message = urlencode($msgstud);

		//Define route 
		$route = 4;
		//Prepare you post parameters
		$postData = array(
		    'authkey' => $authKey,
		    'mobiles' => $mobileNumber,
		    'message' => $message,
		    'sender' => $senderId,
		    'route' => $route
		);

		//API URL
		$url="http://api.msg91.com/api/sendhttp.php";

		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $postData
		    //,CURLOPT_FOLLOWLOCATION => true
		));


		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


		//get response
		$output = curl_exec($ch);

		//Print error if any
		if(curl_errno($ch))
		{
		    echo 'error:' . curl_error($ch);
		}

		curl_close($ch);

		//echo $output;
        //end Send SMS

        header('location: customers.php');
        exit();
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    //main insert ends here.

    //Sending SMS with Student ID



    //new code ends 
    //if($last_id)
    //{
    //	$_SESSION['success'] = "Customer added successfully!";
    //	header('location: customers.php');
    //	exit();
    //}
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Add Student</h2>
        </div>
        
</div>
    <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">      
      <div class="form-group">
        <label for="photo">Photo *</label>
       <!-- <input type="hidden" name="MAX_FILE_SIZE" value="102410244"/> -->
        <input type="file" name="photo" value="<?php echo $edit ? $customer['photo'] : ''; ?>" class="form-control" id="photo">
    </div>     
    <div class="form-group">
        <label for="f_name">First Name *</label>
          <input type="text" name="f_name" value="<?php echo $edit ? $customer['f_name'] : ''; ?>" placeholder="First Name" class="form-control" required="required" id = "f_name" >
    </div> 

    <div class="form-group">
        <label for="m_name">Middle Name *</label>
          <input type="text" name="m_name" value="<?php echo $edit ? $customer['m_name'] : ''; ?>" placeholder="Middle Name" class="form-control" required="required" id = "m_name" >
    </div> 

    <div class="form-group">
        <label for="l_name">Last name *</label>
        <input type="text" name="l_name" value="<?php echo $edit ? $customer['l_name'] : ''; ?>" placeholder="Last Name" class="form-control" required="required" id="l_name">
    </div> 

    <div class="form-group">
        <label>Gender *</label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="male" <?php echo ($edit &&$customer['gender'] =='male') ? "checked": "" ; ?> required="required"/> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="female" <?php echo ($edit && $customer['gender'] =='female')? "checked": "" ; ?> required="required" id="female"/> Female
        </label>
    </div>

    <div class="form-group">
        <label for="address">Address *</label>
          <textarea name="address" placeholder="Address" class="form-control" id="address"><?php echo ($edit)? $customer['address'] : ''; ?></textarea>
    </div> 
    
    <div class="form-group">
        <label for="city">City *</label>
        <input type="text" name="city" value="<?php echo $edit ? $customer['city'] : ''; ?>" placeholder="City" class="form-control" required="required" id="city">
    </div> 


    <div class="form-group">
        <label>State </label>
           <?php $opt_arr = array("Gujarat","Maharashtra", "Rajasthan", "Madhya pradesh"); 
                            ?>
            <select name="state" class="form-control selectpicker" required>
                <option value=" " >Please select your state</option>
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt == $customer['state']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt.'"' . $sel . '>' . $opt . '</option>';
                }

                ?>
            </select>
    </div>

    <div class="form-group">
        <label for="pincode">Pincode *</label>
        <input type="text" name="pincode" value="<?php echo $edit ? $customer['pincode'] : ''; ?>" placeholder="Pincode" class="form-control" required="required" id="pincode">
    </div> 

    <div class="form-group">
        <label for="email">Email *</label>
            <input  type="email" name="email" value="<?php echo $edit ? $customer['email'] : ''; ?>" placeholder="E-Mail Address" class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="phone">Phone *</label>
            <input name="phone" value="<?php echo $edit ? $customer['phone'] : ''; ?>" placeholder="987654321" class="form-control"  type="text" id="phone">
    </div> 

    <div class="form-group">
        <label>Date of birth *</label>
        <input name="date_of_birth" value="<?php echo $edit ? $customer['date_of_birth'] : ''; ?>"  placeholder="Birth date" class="form-control"  type="date" id="date_of_birth" required="required">
    </div>

    <div class="form-group">
        <label for="passportno">Passport Number *</label>
        <input type="text" name="passportno" value="<?php echo $edit ? $customer['passportno'] : ''; ?>" placeholder="Passport Number" class="form-control" required="required" id="passportno">
    </div>

    <div class="form-group">
        <label for="passportnews">New Passport Copy *</label>
   <!--     <input type="hidden" name="MAX_FILE_SIZE" value="102410244"/>   -->
        <input type="file" name="passportnews" value="<?php echo $edit ? $customer['passportnews'] : ''; ?>" class="form-control" id="passportnews">
    </div>

    <div class="form-group">
        <label for="passportolds">Old Passport Copy </label>
   <!--     <input type="hidden" name="MAX_FILE_SIZE" value="102410244"/> -->
        <input type="file" name="passportolds" value="<?php echo $edit ? $customer['passportolds'] : ''; ?>" class="form-control" id="passportolds">
    </div>


    <div class="form-group">
        <label for="panno">PAN Number *</label>
        <input type="text" name="panno" value="<?php echo $edit ? $customer['panno'] : ''; ?>" placeholder="PAN Number" class="form-control" required="required" id="panno">
    </div>

    <div class="form-group">
        <label for="pannos">PAN Card Copy *</label>
  <!--      <input type="hidden" name="MAX_FILE_SIZE" value="102410244"/> -->
        <input type="file" name="pannos" value="<?php echo $edit ? $customer['pannos'] : ''; ?>" class="form-control" id="pannos">
    </div>  

    <div class="form-group">
        <label for="aadharno">Aadhar Number *</label>
        <input type="text" name="aadharno" value="<?php echo $edit ? $customer['aadharno'] : ''; ?>" placeholder="Aadhar Card Number" class="form-control" required="required" id="aadharno">
    </div>

    <div class="form-group">
        <label for="aadharnos">Aadhar Card Copy *</label>
   <!--     <input type="hidden" name="MAX_FILE_SIZE" value="102410244"/> -->
        <input type="file" name="aadharnos" value="<?php echo $edit ? $customer['aadharnos'] : ''; ?>" class="form-control" id="aadharnos">
    </div> 

    <div class="form-group">
        <label for="resumes">Resume/CV *</label>
    <!--    <input type="hidden" name="MAX_FILE_SIZE" value="102410244"/> -->
        <input type="file" name="resumes" value="<?php echo $edit ? $customer['resumes'] : ''; ?>" class="form-control" id="resumes">
    </div> 

    <div class="form-group">
        <label for="parentsname">Parents Name *</label>
          <input type="text" name="parentsname" value="<?php echo $edit ? $customer['parentsname'] : ''; ?>" placeholder="Parents Name" class="form-control" required="required" id = "parentsname" >
    </div>

    <div class="form-group">
        <label for="parentsphone">Phone *</label>
            <input name="parentsphone" value="<?php echo $edit ? $customer['parentsphone'] : ''; ?>" placeholder="9876543210" class="form-control"  type="text" required="required" id="parentsphone">
    </div>

    <div class="form-group">
        <label for="parentsemail">Email </label>
            <input  type="email" name="parentsemail" value="<?php echo $edit ? $customer['parentsemail'] : ''; ?>" placeholder="E-Mail Address" class="form-control" id="parentsemail">
    </div> 

    <div class="form-group">
        <label for="amount">Amount *</label>
          <input type="text" name="amount" value="<?php echo $edit ? $customer['amount'] : ''; ?>" placeholder="Amount" class="form-control" required="required" id = "amount" >
    </div> 

    <div class="form-group">
        <label for="roi">Rate of Intrest (%) *</label>
        <input type="text" name="roi" value="<?php echo $edit ? $customer['roi'] : ''; ?>" placeholder="Rate of Intrest (%)" class="form-control" required="required" id="roi">
    </div>     

    <div class="form-group">
        <label for="duedate">Due Date *</label>
          <input name="duedate" value="<?php echo $edit ? $customer['duedate'] : ''; ?>"  placeholder="Due date" class="form-control"  type="date" id="duedate" required="required">
    </div> 
    
    <div class="form-group">
        <label for="days">Days *</label>
        <input type="text" name="days" value="<?php echo $edit ? $customer['days'] : ''; ?>" placeholder="Days" class="form-control" required="required" id="days">
    </div> 


    <div class="form-group">
        <label for="intrest">Intrest *</label>
        <input type="text" name="intrest" value="<?php echo $edit ? $customer['intrest'] : ''; ?>" placeholder="Intrest" class="form-control" required="required" id="intrest">
    </div> 

    <div class="form-group">
        <label for="advancepaid">Advance Paid *</label>
            <input  type="text" name="advancepaid" value="<?php echo $edit ? $customer['advancepaid'] : ''; ?>" placeholder="Advance Paid" class="form-control" id="advancepaid">
    </div>

    <div class="form-group">
        <label for="balanceduedate">Balance Due Date *</label>
          <input name="balanceduedate" value="<?php echo $edit ? $customer['balanceduedate'] : ''; ?>"  placeholder="Balance Due date" class="form-control" id="balanceduedate" type="date" required="required">
    </div> 

    <div class="form-group">
        <label for="balance">Balance *</label>
            <input name="balance" value="<?php echo $edit ? $customer['balance'] : ''; ?>" placeholder="Balance" class="form-control"  type="text" id="balance">
    </div> 

    <div class="form-group">
        <label>Bank Withdraw Date *</label>
        <input name="bankwithdrawdate" value="<?php echo $edit ? $customer['bankwithdrawdate'] : ''; ?>"  placeholder="Bank Withdraw Date" class="form-control" id="bankwithdrawdate"  type="date" required="required">
    </div>

    <div class="form-group">
        <label>Bank Deposit By </label>
           <?php $opt_arr = array("Self","Student"); 
                            ?>
            <select name="bankdeposit" class="form-control selectpicker" required>
                <option value=" " >Who Paid For Bank Deposit</option>
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt == $customer['bankdeposit']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt.'"' . $sel . '>' . $opt . '</option>';
                }

                ?>
            </select>
    </div>

    <div class="form-group">
        <label>Mode of Deposit</label>
           <?php $opt_arr = array("Cash","Cheque"); 
                            ?>
            <select name="depositmode" class="form-control selectpicker" required>
                
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt == $customer['depositmode']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                    echo '<option value="'.$opt.'"' . $sel . '>' . $opt . '</option>';
                }

                ?>
            </select>            
    </div>

    <div class="form-group">
        <label for="bankname">Bank Name</label>
            <input  type="text" name="bankname" value="<?php echo $edit ? $customer['bankname'] : ''; ?>" placeholder="Bank Name" class="form-control" id="bankname">
    </div>

    <div class="form-group">
        <label for="chequeno">Cheque Number</label>
            <input  type="text" name="chequeno" value="<?php echo $edit ? $customer['chequeno'] : ''; ?>" placeholder="Cheque Number" class="form-control" id="chequeno">
    </div>

    <div class="form-group">
        <label for="depositamount">Deposit Amount *</label>
        <input type="text" name="depositamount" value="<?php echo $edit ? $customer['depositamount'] : ''; ?>" placeholder="Deposit Amount" class="form-control" required="required" id="depositamount">
    </div> 

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>

    </form>
</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#customer_form").validate({
       rules: {
            f_name: {
                required: true,
                minlength: 3
            },
            m_name: {
                required: true,
                minlength: 3
            },
            l_name: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>
<script>
$('#days').keyup(function(){
    var textone;
    var texttwo;
    var textthree;
    textone = parseFloat($('#amount').val());
    texttwo = parseFloat($('#roi').val());
    
    var day_end1 = new Date($('#duedate').val());
    var day1 = day_end1.getDate();
    var month1 = day_end1.getMonth() + 1;
    var year1 = day_end1.getFullYear();
    var day_end = (month1)+"/"+(day1)+"/"+ (year1);
    
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = (month)+"/"+(month)+"/"+ now.getFullYear();

    var dateFirst = new Date(day_end);
    var dateSecond = new Date(today);
    
    var one_day=1000*60*60*24
    
    var difference = Math.ceil((dateFirst.getTime()-dateSecond.getTime())/(one_day))

    $('#days').val(difference-14);
    textthree = parseFloat($('#days').val());
    var result = textthree * (textone * texttwo)/3000;    
    $('#intrest').val(result);
    var balduedate = (year1)+"-"+(month1)+"-"+ (day1);
    $('#balanceduedate').val(balduedate);

});
</script>

<script>
$('#advancepaid').keyup(function(){
    var ap1;
    var int1;
    var textthree;
    ap1 = parseFloat($('#advancepaid').val());
    int1 = parseFloat($('#intrest').val());
    var baldue1 = int1 - ap1;    
    $('#balance').val(baldue1);

});
</script>
<script>
    //function updatebanktb() {
        //var selectedText1 = $('#depositmode: selected').text();
        //var selectedText = ex.options[ex.selectedIndex].text;
        //$('#bankname').val(selectedText);
   //if (selectedText.equals("Cash")){
        //document.getElementById('bankname').disabled = false;
        //document.getElementById('chequeno').disabled = false;
  //  }
   // else{
        //document.getElementById('bankname').disabled = false;
       // document.getElementById('chequeno').disabled = false;
   // }
}
</script>
<?php include_once 'includes/footer.php'; ?>