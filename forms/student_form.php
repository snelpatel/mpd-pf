<fieldset>
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
        <input name="date_of_birth" value="<?php echo $edit ? $customer['date_of_birth'] : ''; ?>"  placeholder="Birth date" class="form-control"  type="date" required="required">
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
          <input name="duedate" value="<?php echo $edit ? $customer['duedate'] : ''; ?>"  placeholder="Due date" class="form-control"  type="date" required="required">
    </div> 
    
    <div class="form-group">
        <label for="days">Days *</label>
        <input type="text" name="days" value="<?php echo $edit ? $customer['days'] : ''; ?>" placeholder="Days" class="form-control" required="required" id="city">
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
          <input name="balanceduedate" value="<?php echo $edit ? $customer['balanceduedate'] : ''; ?>"  placeholder="Balance Due date" class="form-control"  type="date" required="required">
    </div> 

    <div class="form-group">
        <label for="balance">Balance *</label>
            <input name="balance" value="<?php echo $edit ? $customer['balance'] : ''; ?>" placeholder="Balance" class="form-control"  type="text" id="balance">
    </div> 

    <div class="form-group">
        <label>Bank Withdraw Date *</label>
        <input name="bankwithdrawdate" value="<?php echo $edit ? $customer['bankwithdrawdate'] : ''; ?>"  placeholder="Bank Withdraw Date" class="form-control"  type="date" required="required">
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
                <option value=" " >Mode of Bank Deposit</option>
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
</fieldset>