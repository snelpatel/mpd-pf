<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


//Only super admin is allowed to access this page
if ($_SESSION['admin_type'] !== 'Administrator') {
    // show permission denied message
    header('HTTP/1.1 401 Unauthorized', true, 401);
    
    exit("401 Unauthorized");
}
//$db = new db();


//$rptfromdate = date('Y-m-d H:i:s', $_POST['fromdate']);
//$rpttodate = date('Y-m-d H:i:s', $_POST['todate']);

//echo $_POST['fromdate'];
//echo $_POST['todate'];
//echo $rptfromdate;
//echo $rpttodate;

//$result = $db->selectrptdate($_POST['fromdate'],$_POST['todate']);


//$query2="SELECT * FROM customers where created_at between '".$_POST['fromdate']."' and '".$_POST['todate']."'";
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'studentloan';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
//echo 'Connected successfully<br>';
$sql = "SELECT * FROM customers where created_at between '".$_POST['fromdate']."' and '".$_POST['todate']."'";
$result = mysqli_query($conn, $sql);

//if (mysqli_num_rows($result) > 0) {
//while($row = mysqli_fetch_assoc($result)) {
 //     echo "Name: " . $row["id"]. "<br>";
//}
//} else {
//   echo "0 results";
//}
//mysqli_close($conn);
//$createdatdate = date('Y-m-d+ H:i:s');
include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Financial Details Report</h1>
        </div>
        <div class="col-lg-6" style="">
          <div class="page-action-links text-right">
              <a href="#" onclick="$('#tblfinreport').tableExport({type:'excel',escape:'false'});">
                <button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Export to Excel </button>
              </a>
               &nbsp; 
              
                <button class="btn btn-success" onclick="javascript:convertToPDF();"><span class="glyphicon glyphicon-plus"></span> Export to PDF </button>
              
          </div>
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <hr>

            <div id="tblfinreport1">
            <table id="tblfinreport" width="100%" style="font-size:10px;" class="table table-striped">
                <colgroup>
                    <col width="5%">
                        <col width="25%">
                            <col width="12%">
                                <col width="8%">
                                    <col width="5%">
                                        <col width="12%">
                                            <col width="7%">
                                                <col width="9%">
                                                    <col width="7%">
                                                        <col width="10%">

                </colgroup>
                <thead>
                    <tr class='warning'>
                        <th>ID#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>ROI</th>
                        <th>Due Date</th>
                        <th>Intrest</th>
                        <th>Advance</th>
                        <th>Due</th>
                        <th>Withdrawal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td><?php echo $row['id'] ?></td>
                  <td><?php echo htmlspecialchars($row['f_name']." ".$row['m_name']." ".$row['l_name']); ?></td>
                  <td><?php echo htmlspecialchars($row['phone']) ?></td>
                  <td><?php echo htmlspecialchars($row['amount']) ?> </td>
                    <td><?php echo htmlspecialchars($row['roi']) ?> </td>
                    <td><?php echo htmlspecialchars($row['duedate']) ?> </td>
                    <td><?php echo htmlspecialchars($row['intrest']) ?> </td>
                    <td><?php echo htmlspecialchars($row['advancepaid']) ?> </td>
                    <td><?php echo htmlspecialchars($row['balance']) ?> </td>
                    <td><?php echo htmlspecialchars($row['bankwithdrawdate']) ?> </td>                 
                  </tr>
            <?php }
                  } else {
                        echo "No Records Found!";
                          }
            mysqli_close($conn); ?>
                </tbody>
            </table>
            </div>


</div>
<!--Main container end-->
<?php include_once './includes/footer.php'; ?>
<script type="text/javascript">
        function convertToPDF() {
            var pdf = new jsPDF('l', 'pt', 'letter');
            var totalPagesExp = "{total_pages_count_string}";
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            
            source = $('#tblfinreport1')[0];

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 622
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html                
                pdf.save('FinianceReport.pdf');
            }
            , margins);
        }
    </script>

