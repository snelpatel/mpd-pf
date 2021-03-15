<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='Administrator'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: customers.php');
        exit;

	}
    $id = $del_id;

    $db = getDbInstance();
    $db->where('id', $id);
    $status = $db->delete('financial');
    
    if ($status) 
    {
        $_SESSION['info'] = "Financial Details Deleted Successfully!";
        header('location: financial.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete financial details";
    	header('location: financial.php');
        exit;

    }
    
}