<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Student Loan - Administrator</title>

        <!-- Bootstrap Core CSS -->
        <link  rel="stylesheet" href="css/bootstrap.min.css"/>

        <!-- MetisMenu CSS -->
        <link href="js/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
 


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/jquery.min.js" ></script>
        <script type="text/javascript" src="js/tableExport.js"></script>
        <script type="text/javascript" src="js/jquery.base64.js"></script>
        <script type="text/javascript" src="jspdf/libs/sprintf.js"></script>
        <script type="text/javascript" src="jspdf/jspdf.js"></script>
        <script type="text/javascript" src="jspdf/libs/base64.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jspdf.debug.js"></script>
        <script type='text/javascript'>
         $(document).ready(function(){
         $('#modalContactForm').on('click', '.btn-info', function(e){
         var vwdramount = $('#wdramount').val();
         var vwdrchequeno = $('#wdrchequeno').val();
         var vwdrdate = $('#wdrdate').val();
         var vwdrsid = $('#wdrsid').val();
         var vwdrpint = $('#wdrintpending').val()
         if(vwdrpint > 0)
         {
            var msg= "Cannot Withdraw From Student's Account. Interest is Pending.";
            alert(msg);
         }
                $.post("withdrawdone.php", //Required URL of the page on server
                   { // Data Sending With Request To Server
                      wdramount:vwdramount,
                      wdrchequeno:vwdrchequeno,
                      wdrdate:vwdrdate,
                      wdrsid:vwdrsid,
                      wdrpint:vwdrpint,
                   },
                function(response,status){ // Required Callback Function
                 $("#result").html("<h4>Account Withdrawn And Balance Updated Successfully!<h4>");//"response" receives - whatever written in echo of above PHP script.
              });
         $('#modalContactForm').modal('hide');
       });
       });
      </script>

      <script type='text/javascript'>
         $(document).ready(function(){
         $('#modalContactForm1').on('click', '.btn-info', function(e){
         var vbaldonedate = $('#baldonedate').val();
         var vbaldonesid = $('#baldonesid').val();
         var vbaldoneamt = $('#baldoneamt').val();
         
                $.post("balancedone.php", //Required URL of the page on server
                   { // Data Sending With Request To Server
                      baldonedate:vbaldonedate,
                      baldonesid:vbaldonesid,
                      baldoneamt:vbaldoneamt,
                   },
                function(response,status){ // Required Callback Function
                 $("#result1").html("<h4>Balance Done In Account and In Process!<h4>");//"response" receives - whatever written in echo of above PHP script.
              });
         $('#modalContactForm1').modal('hide');
       });
       });
      </script>

      <script type='text/javascript'>
         $(document).ready(function(){
         $('#modalContactForm2').on('click', '.btn-info', function(e){
         var vpduedate = $('#pduedate').val();
         var vpduesid = $('#pduesid').val();
         
                $.post("principledue.php", //Required URL of the page on server
                   { // Data Sending With Request To Server
                      pduedate:vpduedate,
                      pduesid:vpduesid,
                   },
                function(response,status){ // Required Callback Function
                 $("#result2").html("<h4>Principle Due in Account!<h4>");//"response" receives - whatever written in echo of above PHP script.
              });
         $('#modalContactForm2').modal('hide');
       });
       });
      </script>

      <script type='text/javascript'>
         $(document).ready(function(){
         $('#modalContactForm3').on('click', '.btn-info', function(e){
         var vbankname = $('#bankname').val();
         var vbankacno = $('#bankacno').val();
         var vbanksid = $('#banksid').val();
         
                $.post("bankdetails.php", //Required URL of the page on server
                   { // Data Sending With Request To Server
                      bankname:vbankname,
                      bankacno:vbankacno,
                      banksid:vbanksid,
                   },
                function(response,status){ // Required Callback Function
                 $("#result3").html("<h4>Bank Details Updated!<h4>");//"response" receives - whatever written in echo of above PHP script.
              });
         $('#modalContactForm3').modal('hide');
       });
       });
      </script>
            
    </head>

    <body>  

        <div id="wrapper">

            <!-- Navigation -->
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ) : ?>
                <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images\logo1.png"></a>
                    </div>
                    <!-- /.navbar-header -->

                    
                    <!-- /.navbar-top-links -->

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu" style="margin-bottom: 0">
                                <li>
                                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                                </li>

                                <li <?php echo (CURRENT_PAGE =="customers.php" || CURRENT_PAGE=="add_customer.php") ? 'class="active"' : '' ; ?>>
                                    <a href="#"><i class="fa fa-user-circle fa-fw"></i> Students<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                        <a href="webcam.php"><i class="fa fa-camera fa-fw"></i>Capture Photo</a>    
                                        </li>
                                        <li>
                                        <a href="add_student.php"><i class="fa fa-plus fa-fw"></i>New Student Profile</a>    
                                        </li>
                                        <li>                                        
                                        <a href="addpayment.php"><i class="fa fa-plus fa-fw"></i>Student Bank Details</a>
                                        </li>                                        
                                        <li>                                        
                                            <a href="customers.php"><i class="fa fa-list fa-fw"></i>Loans</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li>
                                    <a href="admin_users.php"><i class="fa fa-users fa-fw"></i> Employees</a>
                                </li>
                                <li>
                                    <a href="reportstype.php"><i class="fa fa-bar-chart fa-fw"></i> Reports</a>
                                </li>
                                <li>
                                    <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>
            <?php endif; ?>
            <!-- The End of the Header -->