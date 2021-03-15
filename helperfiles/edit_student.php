<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $data_to_update['updated_at'] = date('Y-m-d');
    $db = getDbInstance();
    $db->where('id',$customer_id);
    $stat = $db->update('customers', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Student Details Updated Successfully!";
        //Redirect to the listing page,
        header('location: customers.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $customer_id);
    //Get data to pre-populate the form.
    $customer = $db->getOne("customers");
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Student Details</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

        <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">      
        <div class="form-group">
            <table>
            <tr>
                <td></td>
            </tr>
            <tr>
            <td width="20%" style="padding-right: 10px"></td>
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