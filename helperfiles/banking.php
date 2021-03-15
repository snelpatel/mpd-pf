<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div>
            <h1 class="page-header">Student Bank Details</h1>
        </div>        
    </div>
        <?php include('./includes/flash_messages.php') ?>
    
    
        <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="paywithdraw.php" method="POST">
            <label for="input_search">Student ID #</label>
            <input type="text" name="studentid" value="" placeholder="Student ID Number" class="form-control" id="studentid">            
            <input type="submit" value="Search Details" class="btn btn-primary">

        </form>        
    </div>
<!--    Pagination links-->
</div>
<!--Main container end-->
<?php include_once './includes/footer.php'; ?>

