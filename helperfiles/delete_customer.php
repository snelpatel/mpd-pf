<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
//$del_id = filter_input(INPUT_POST, 'del_id');
$del_id = filter_input(INPUT_GET, 'del_id', FILTER_VALIDATE_INT);
if ($del_id) 
{

	if($_SESSION['admin_type']!='Administrator'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: customers.php');
        exit;

	}
    $customer_id = $del_id;

    $db = getDbInstance();
    $db->where('id', $customer_id);
    $status = $db->delete('customers');
    
    if ($status) 
    {
        $_SESSION['info'] = "Student Details Deleted Successfully!";
        header('location: customers.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete sustomer details";
    	header('location: customers.php');
        exit;

    }
    
}