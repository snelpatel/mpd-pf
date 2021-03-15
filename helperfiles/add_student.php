<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';
include './includes/ChromePhp.php';
?>
<?php 

    $db = new db();
    $NextID = $db->nextstudentid();
    $NextID = $NextID + 1;
//serve POST method, After successful insert, redirect to customers.php page.
// if(isset($_POST['btnsave']))


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
    if($_FILES["photo"]["error"] != 0) {
        $filename0="NoFile";
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
    if($_FILES["passportnews"]["error"] != 0) {
        $filename="NoFile";
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
    //if(!$result1)
    //{ 
      //$error = "Could not  save old passport file as $filename1!";     
      //exit(); 
    //}
    if($_FILES["passportolds"]["error"] != 0) {
        $filename1="NoFile";
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
    if($_FILES["pannos"]["error"] != 0) {
        $filename1="NoFile";
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
    if($_FILES["aadharnos"]["error"] != 0) {
        $filename1="NoFile";
    }
    //scanned aadhar card copy upload ends here

    //scanned CV upload begins here now changed to other documents        
    $name4= $_FILES['other0']['name'];
    $position4= strpos($name4, "."); 
    $fileextension4= substr($name4, $position4 + 1);
    $filename4 = time() . "." . $fileextension4; 
    $target4 = BASE_PATH.'\\uploads\\other0\\';     
    $fileTarget4 = $target4.$filename4;    
    $tempFileName4 = $_FILES["other0"]["tmp_name"];    
    $result4 = move_uploaded_file($tempFileName4,$fileTarget4);      
    if($_FILES["other0"]["error"] != 0) {
        $filename1="NoFile";
    }

    $name41= $_FILES['other1']['name'];
    $position41= strpos($name41, "."); 
    $fileextension41= substr($name41, $position41 + 1);
    $filename41 = time() . "." . $fileextension41; 
    $target41 = BASE_PATH.'\\uploads\\other1\\';     
    $fileTarget41 = $target41.$filename41;    
    $tempFileName41 = $_FILES["other1"]["tmp_name"];    
    $result41 = move_uploaded_file($tempFileName41,$fileTarget41);      
    if($_FILES["other1"]["error"] != 0) {
        $filename1="NoFile";
    }

    $name42= $_FILES['other2']['name'];
    $position42= strpos($name42, "."); 
    $fileextension42= substr($name42, $position42 + 1);
    $filename42 = time() . "." . $fileextension42; 
    $target42 = BASE_PATH.'\\uploads\\other2\\';     
    $fileTarget42 = $target42.$filename42;    
    $tempFileName42 = $_FILES["other2"]["tmp_name"];    
    $result42 = move_uploaded_file($tempFileName42,$fileTarget42);      
    if($_FILES["other2"]["error"] != 0) {
        $filename1="NoFile";
    }


    $name43= $_FILES['other3']['name'];
    $position43= strpos($name43, "."); 
    $fileextension43= substr($name43, $position43 + 1);
    $filename43 = time() . "." . $fileextension43; 
    $target43= BASE_PATH.'\\uploads\\other3\\';     
    $fileTarget43 = $target43.$filename43;    
    $tempFileName43 = $_FILES["other3"]["tmp_name"];    
    $result43 = move_uploaded_file($tempFileName43,$fileTarget43);      
    if($_FILES["other3"]["error"] != 0) {
        $filename1="NoFile";
    }

    $name44= $_FILES['other4']['name'];
    $position44= strpos($name44, "."); 
    $fileextension44= substr($name44, $position44 + 1);
    $filename44 = time() . "." . $fileextension44; 
    $target44 = BASE_PATH.'\\uploads\\other4\\';     
    $fileTarget44 = $target44.$filename44;    
    $tempFileName44 = $_FILES["other4"]["tmp_name"];    
    $result44 = move_uploaded_file($tempFileName44,$fileTarget44);      
    if($_FILES["other4"]["error"] != 0) {
        $filename1="NoFile";
    }
    //scanned CV upload ends here
    
    $createdatdate = date('Y-m-d');
    //main insert script begins here.
    $studphoneno = $_POST['phone'];
    $sql = "INSERT INTO customers(photo, f_name, m_name, l_name, gender, address, city, state, pincode, phone, email, date_of_birth, passportno, ppexpirydate, passportnews, passportolds, panno, pannos, aadharno, aadharnos, other0, other1, other2, other3, other4, parentsname, parentsphone, parentsemail, amount, roi, days, intrest, bankwithdrawdate, tobedepositdate, created_at, intpending)
    VALUES('". $filename0 . "','" . $_POST['f_name'] . "','" . $_POST['m_name'] . "','". $_POST['l_name'] . "','". $_POST['gender'] . "','". $_POST['address'] . "','". $_POST['city'] . "','". $_POST['state'] . "','". $_POST['pincode'] . "','". $_POST['phone'] . "','". $_POST['email'] . "','". $_POST['date_of_birth'] . "','". $_POST['passportno']. "','". $_POST['ppexpirydate'] . "','" . $filename . "','" . $filename1 . "','". $_POST['panno'] . "','" . $filename2 . "','". $_POST['aadharno']. "','" . $filename3. "','" . $filename4 ."','" . $filename41 . "','"  . $filename42 . "','"  . $filename43 . "','"  . $filename44 . "','" . $_POST['parentsname'] ."','". $_POST['parentsphone'] ."','". $_POST['parentsemail'] ."',". $_POST['amount'] .",". $_POST['roi'] .",". $_POST['days'] .",". $_POST['intrest'] .",'". $_POST['bankwithdrawdate']."','". $_POST['tobedepositdate'] . "','". $createdatdate . "',". $_POST['intrest'].")";
    

    

    //ChromePhp::log($sql);
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
?>
<?php require_once 'includes/header.php'; ?>
<div id="page-wrapper">
    <div class="row">
         <div class="col-lg-12">
                <h2 class="page-header">Add Student</h2>
         </div>        
    </div>
    <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">      
        <div class="form-group">
            <table>
            <tr>
                <td><label style="font-weight: bolder; font-size: 30px;">Student ID#&nbsp;&nbsp;</label><label style="font-weight: bold; font-size: 30px; color: red;"><?php echo $NextID ?></label></td>
            </tr>
            <tr>
            <td width="20%" style="padding-right: 10px"><label for="photo">Photo *</label>
            <input type="file" name="photo" value="<?php echo $edit ? $customer['photo'] : ''; ?>" class="form-control" id="photo"></td>
            <td width="20%" style="padding-right: 10px"><br/></td>
            <td width="20%" style="padding-right: 10px"></td>
            <td width="20%" style="padding-right: 10px"></td>
            <td width="20%" style="padding-right: 10px"></td>
            </tr>
            </table>
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
            <table>
                <tr>
                <td width="40%" style="padding-right: 10px"><label for="f_name">First Name *</label>
                  <input type="text" name="f_name" value="<?php echo $edit ? $customer['f_name'] : ''; ?>" placeholder="First Name" class="form-control" required="required" id = "f_name" > </td>
                <td width="40%" style="padding-right: 10px"><label for="m_name">Middle Name *</label>
                  <input type="text" name="m_name" value="<?php echo $edit ? $customer['m_name'] : ''; ?>" placeholder="Middle Name" class="form-control" required="required" id = "m_name" > </td>
                <td width="20%" style="padding-right: 10px"><label for="l_name">Last name *</label>
                <input type="text" name="l_name" value="<?php echo $edit ? $customer['l_name'] : ''; ?>" placeholder="Last Name" class="form-control" required="required" id="l_name"> </td>
                </tr>
            </table>        
        </div> 
    
        <div class="form-group">
            <table>
                <tr>
                    <td width="40%" style="padding-right: 10px"><label for="address">Address *</label>
                  <textarea name="address" placeholder="Address" class="form-control" id="address"><?php echo ($edit)? $customer['address'] : ''; ?></textarea></td>
                    <td width="20%" style="padding-right: 10px"><label for="city">City *</label>
                <input type="text" name="city" value="<?php echo $edit ? $customer['city'] : ''; ?>" placeholder="City" class="form-control" required="required" id="city"></td>
                    <td width="20%" style="padding-right: 10px"><label>State </label>
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
                    </select></td>
                    <td width="20%" style="padding-right: 10px"><label for="pincode">Pincode *</label>
                <input type="text" name="pincode" value="<?php echo $edit ? $customer['pincode'] : ''; ?>" placeholder="Pincode" class="form-control" required="required" id="pincode"></td>
                </tr>
            </table>        
        </div> 
    
        <div class="form-group">
            <table>
                <tr>
                    <td width="70%" style="padding-right: 10px"><label for="email">Email *</label>
                    <input  type="email" name="email" value="<?php echo $edit ? $customer['email'] : ''; ?>" placeholder="E-Mail Address" class="form-control" id="email"></td>
                    <td width="15%" style="padding-right: 10px"><label for="phone">Phone *</label>
                    <input name="phone" value="<?php echo $edit ? $customer['phone'] : ''; ?>" placeholder="987654321" class="form-control"  type="text" id="phone"></td>
                    <td width="15%" style="padding-right: 10px"><label>Date of birth *</label>
                <input name="date_of_birth" value="<?php echo $edit ? $customer['date_of_birth'] : ''; ?>"  placeholder="Birth date" class="form-control"  type="date" id="date_of_birth" required="required"></td>
                </tr>
            </table>        
        </div>

        <div class="form-group">
            <table>
            <tr>
                <td width="50%" style="padding-right: 10px"><label for="parentsname">Parents Name *</label>
                  <input type="text" name="parentsname" value="<?php echo $edit ? $customer['parentsname'] : ''; ?>" placeholder="Parents Name" class="form-control" required="required" id = "parentsname" ></td>
                <td width="20%" style="padding-right: 10px"><label for="parentsphone">Phone *</label>
                    <input name="parentsphone" value="<?php echo $edit ? $customer['parentsphone'] : ''; ?>" placeholder="9876543210" class="form-control"  type="text" required="required" id="parentsphone"></td>
                <td width="30%"><label for="parentsemail">Email </label>
                    <input  type="email" name="parentsemail" value="<?php echo $edit ? $customer['parentsemail'] : ''; ?>" placeholder="E-Mail Address" class="form-control" id="parentsemail"></td>
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
                <td width="20%" style="padding-right: 10px"><label for="passportno">Passport Number *</label>
                <input type="text" name="passportno" value="<?php echo $edit ? $customer['passportno'] : ''; ?>" placeholder="Passport Number" class="form-control" required="required" id="passportno"></td>
                <td width="20%" style="padding-right: 10px"><label>Expriry Date *</label>
                <input name="ppexpirydate" value="<?php echo $edit ? $customer['ppexpirydate'] : ''; ?>"  placeholder="Expiry date" class="form-control"  type="date" id="ppexpirydate" required="required"></td>
                <td width="30%" style="padding-right: 10px"><label for="passportnews">New Passport Copy *</label>   
                <input type="file" name="passportnews" value="<?php echo $edit ? $customer['passportnews'] : ''; ?>" class="form-control" id="passportnews"></td>
                <td width="30%" style="padding-right: 10px"><label for="passportolds">Old Passport Copy </label>  
                <input type="file" name="passportolds" value="<?php echo $edit ? $customer['passportolds'] : ''; ?>" class="form-control" id="passportolds"></td>
                </tr>
            </table>        
        </div>

        <div class="form-group">
            <table>
            <tr>
                <td width="40%" style="padding-right: 10px"><label for="panno">PAN Number *</label>
                <input type="text" name="panno" value="<?php echo $edit ? $customer['panno'] : ''; ?>" placeholder="PAN Number" class="form-control" required="required" id="panno"></td>
                <td width="30%" style="padding-right: 10px"> <label for="pannos">PAN Card Copy *</label>  
                <input type="file" name="pannos" value="<?php echo $edit ? $customer['pannos'] : ''; ?>" class="form-control" id="pannos"></td>        
            </table>
        </div>

        <div class="form-group">
            <table>
            <tr>
                <td width="40%" style="padding-right: 10px"><label for="aadharno">Aadhar Number *</label>
                <input type="text" name="aadharno" value="<?php echo $edit ? $customer['aadharno'] : ''; ?>" placeholder="Aadhar Card Number" class="form-control" required="required" id="aadharno"></td>
                <td width="30%" style="padding-right: 10px"><label for="aadharnos">Aadhar Card Copy *</label>
                <input type="file" name="aadharnos" value="<?php echo $edit ? $customer['aadharnos'] : ''; ?>" class="form-control" id="aadharnos"></td>       
                </tr>
            </table>
        </div>

        <div class="form-group">
            <table>
            <tr>
            <td><label>Other File 1 </label>
            <input type="file" name="other0" value="<?php echo $edit ? $customer['other0'] : ''; ?>" class="form-control" id="other0"></td>
            <td><label>Other File 2 </label><input type="file" name="other1" value="<?php echo $edit ? $customer['other1'] : ''; ?>" class="form-control" id="other1"></td>
            <td><label>Other File 3 </label><input type="file" name="other2" value="<?php echo $edit ? $customer['other2'] : ''; ?>" class="form-control" id="other2"></td>
            <td><label>Other File 4 </label><input type="file" name="other3" value="<?php echo $edit ? $customer['other3'] : ''; ?>" class="form-control" id="other3"></td>
            <td><label>Other File 5 </label><input type="file" name="other4" value="<?php echo $edit ? $customer['other4'] : ''; ?>" class="form-control" id="other4"></td>      
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
                <td width="20%" style="padding-right: 10px"><label for="amount">Princple Amount *</label>
                  <input type="text" name="amount" value="<?php echo $edit ? $customer['amount'] : ''; ?>" placeholder="Amount" class="form-control" required="required" id = "amount" ></td>
                <td width="20%" style="padding-right: 10px"><label for="roi">Rate of Intrest (%) *</label>
                <input type="text" name="roi" value="<?php echo $edit ? $customer['roi'] : ''; ?>" placeholder="Rate of Intrest (%)" class="form-control" required="required" id="roi"></td>
                <td width="20%" style="padding-right: 10px"><label for="tobedepositdate">Principle Due in Bank *</label>
                  <input name="tobedepositdate" value="<?php echo $edit ? $customer['tobedepositdate'] : ''; ?>"  placeholder="Due date" class="form-control"  type="date" id="tobedepositdate" required="required"></td>
                <td width="20%" style="padding-right: 10px"><label for="days">Loan Period *</label>
                <input type="text" name="days" value="<?php echo $edit ? $customer['days'] : ''; ?>" placeholder="Days" class="form-control" required="required" id="days"></td>
                <td width="20%"> <label for="intrest">Total Intrest Receivable *</label>
                <input type="text" name="intrest" value="<?php echo $edit ? $customer['intrest'] : ''; ?>" placeholder="Intrest" class="form-control" required="required" id="intrest"></td>
                </tr>
            </table>        
        </div>    

        <div class="form-group">
            <table>
            <tr>
                <td width="20%" style="padding-right: 10px"><label>Withdrawal Date *</label>
                <input name="bankwithdrawdate" value="<?php echo $edit ? $customer['bankwithdrawdate'] : ''; ?>"  placeholder="Bank Withdraw Date" class="form-control" id="bankwithdrawdate"  type="date" required="required"></td>
                <td width="20%" style="padding-right: 10px"></td>
                <td width="20%" style="padding-right: 10px"></td>
                <td width="20%" style="padding-right: 10px"></td>
                <td width="20%" style="padding-right: 10px"></td>
                </tr>
            </table>   
        </div>

        <div class="form-group">
            <table>
            <tr>
                <td width="20%" style="padding-right: 10px"></td>
                <td width="20%" style="padding-right: 10px"></td>
                <td width="20%" style="padding-right: 10px"></td>
                <td width="20%" style="padding-right: 10px"></td>
                <td width="20%" style="padding-right: 10px"></td>
                </tr>
            </table>
        </div>
        <div class="form-group text-center">
            <label></label>
            <button type="submit" class="btn btn-warning"> Save <span class="glyphicon glyphicon-send"></span></button>
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
$('#intrest').keyup(function(){
    var textone;
    var texttwo;
    var textthree;
    textone = parseFloat($('#amount').val());
    texttwo = parseFloat($('#roi').val());
    textthree = parseFloat($('#days').val());
    var result = textthree * (textone * texttwo)/3000;    
    $('#intrest').val(result);
    var day_start = new Date($('#tobedepositdate').val());
    var wdate = new Date(day_start);
    wdate.setDate(wdate.getDate() + textthree);
    $('#bankwithdrawdate').val(wdate.toISOString().slice(0,10));

});
</script>

<?php include_once 'includes/footer.php'; ?>