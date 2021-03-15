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
    $data_to_store['created_at'] = date('Y-m-d H:i:s');
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
    //scanned new passport copy upload begins here
    
    $name= $_FILES['passportnews']['name'];
    $position= strpos($name, "."); 
    $fileextension= substr($name, $position + 1);
    $filename = time() . $_SERVER['REMOTE_ADDR'] . $fileextension; 
    $target = BASE_PATH.'\\uploads\\';     
    $fileTarget = $target.$filename;    
    $tempFileName = $_FILES["passportnews"]["tmp_name"];    
    $result = move_uploaded_file($tempFileName,$fileTarget);
      
    if(!$result)
    { 
      $error = "Could not  save new passport file as $filename!";     
      exit(); 
    }
    //scanned new passport copy upload ends here


    //main insert script begins here.
    $sql = "INSERT INTO customers(f_name, passportnews)
    VALUES('". $_POST['f_name'] . "','". $filename . "')";
    

    if ($conn->query($sql) === TRUE) 
    {
        //echo "New record created successfully";
        $_SESSION['success'] = "Student Details Added Successfully!";
        header('location: customers.php');
        exit();
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    //main insert ends here.

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
    <form class="form" action="" method="post"  id="customer_form1" enctype="multipart/form-data">
       <?php  include_once('./forms/customer_form1.php'); ?>
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

<?php include_once 'includes/footer.php'; ?>