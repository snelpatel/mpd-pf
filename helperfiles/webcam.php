<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';
require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Student's Photo Via Webcam</h2>
        </div>        
</div>
    <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">      
      <div class="form-group">
      <table>
    <tr>
        <td width="20%" style="padding-right: 10px"></td>
        <td width="20%" style="padding-right: 10px"><video id="video" width="320" height="240" autoplay></video></td>
        <td width="20%" style="padding-right: 10px"><input type="button" id="snap" value="Take Photo >>" /></td>
        <td width="20%" style="padding-right: 10px"><canvas id="canvas" width="320" height="240"></canvas></td>
        <td width="20%" style="padding-right: 10px"></td>
        </tr>
    </table>
    
        
    </div>
</form>
  
</div>



<script language="JavaScript">
		// Grab elements, create settings, etc.
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        //video.src = window.URL.createObjectURL(stream);
        video.srcObject = stream;
        video.play();
    });
}

/* Legacy code below: getUserMedia 
else if(navigator.getUserMedia) { // Standard
    navigator.getUserMedia({ video: true }, function(stream) {
        video.src = stream;
        video.play();
    }, errBack);
} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
    navigator.webkitGetUserMedia({ video: true }, function(stream){
        video.src = window.webkitURL.createObjectURL(stream);
        video.play();
    }, errBack);
} else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
    navigator.mozGetUserMedia({ video: true }, function(stream){
        video.srcObject = stream;
        video.play();
    }, errBack);
}
*/

// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
	context.drawImage(video, 0, 0, 320, 240);
});
</script>



<?php include_once 'includes/footer.php'; ?>